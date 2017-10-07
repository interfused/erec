<?PHP
/*
Plugin Name: Contact Form 7 Publish Post
Plugin URI: http://corlax.com/
Description: Publish post with contact form 7
Author: Corlax Team
Version: 1.0
Author URI: http://corlax.net/
*/

//define path
define("CF_PUBLISH_POST_URL", WP_PLUGIN_URL . "/cf-publish-post");
define("CF_PUBLISH_POST_PATH", WP_PLUGIN_DIR . "/cf-publish-post");

global $custom_field_db_version;
$custom_field_db_version = '1.1'; // version changed from 1.0 to 1.1

function cf_publish_post_custom_field_install()
{
    global $wpdb;
    global $custom_field_db_version;
    
    $table_name = $wpdb->prefix . 'cf_publish_post'; // do not forget about tables prefix
    
    // sql to create your table
    // NOTICE that:
    // 1. each field MUST be in separate line
    // 2. There must be two spaces between PRIMARY KEY and its name
    //    Like this: PRIMARY KEY[space][space](id)
    // otherwise dbDelta will not work
    $sql = "CREATE TABLE " . $table_name . " (
      id int(11) NOT NULL AUTO_INCREMENT,
      customfield VARCHAR(200) NOT NULL,
      customlabel VARCHAR(200) NOT NULL,
      PRIMARY KEY  (id)
    );";
    
    // we do not execute sql directly
    // we are calling dbDelta which cant migrate database
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // save current database version for later use (on upgrade)
    add_option('custom_field_db_version', $custom_field_db_version);
    
    /**
     * [OPTIONAL] Example of updating to 1.1 version
     *
     * If you develop new version of plugin
     * just increment $custom_field_db_version variable
     * and add following block of code
     *
     * must be repeated for each new version
     * in version 1.1 we change email field
     * to contain 200 chars rather 100 in version 1.0
     * and again we are not executing sql
     * we are using dbDelta to migrate table changes
     */
    $installed_ver = get_option('custom_field_db_version');
    if ($installed_ver != $custom_field_db_version) {
        $sql = "CREATE TABLE " . $table_name . " (
          id int(11) NOT NULL AUTO_INCREMENT,
      customfield VARCHAR(200) NOT NULL,
      customlabel VARCHAR(200) NOT NULL,
	  type VARCHAR(200) NOT NULL,
          PRIMARY KEY  (id)
        );";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // notice that we are updating option, rather than adding it
        update_option('custom_field_db_version', $custom_field_db_version);
    }
}

register_activation_hook(__FILE__, 'cf_publish_post_custom_field_install');


/**
 * register_activation_hook implementation
 *
 * [OPTIONAL]
 * additional implementation of register_activation_hook
 * to insert some dummy data
 */


/**
 * Trick to update plugin database, see docs
 */
function cf_publish_post_custom_field_update_db_check()
{
    global $custom_field_db_version;
    if (get_site_option('custom_field_db_version') != $custom_field_db_version) {
        cf_publish_post_custom_field_install();
    }
}

add_action('plugins_loaded', 'cf_publish_post_custom_field_update_db_check');


//create plugin page

add_action('admin_menu', 'cf_publish_post_menu');

function cf_publish_post_menu()
{
    // Check that the user is allowed to update options
    
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    //create new top-level menu
    
    add_menu_page('CF Publish Post Settings', 'CF Publish Post', 'administrator', 'cf-publish-post', 'cf_publish_post_settings_page', plugins_url('/images/icon.png', __FILE__));
    
    //call register settings function
    
    add_action('admin_init', 'register_cf_publish_post_settings');
    add_action('admin_enqueue_scripts', 'cf_publish_post_custom_admin_css');
}

function register_cf_publish_post_settings()
{
    //register our settings
	register_setting('cf-publish-post-settings-group', 'posttype');
	register_setting('cf-publish-post-settings-group', 'autopublish');
	register_setting('cf-publish-post-settings-group', 'contactform');
	register_setting('cf-publish-post-settings-group', 'posttitle');
	register_setting('cf-publish-post-settings-group', 'postdiscription');
	register_setting('cf-publish-post-settings-group', 'cfposttags');
	register_setting('cf-publish-post-settings-group', 'postauthor');
	register_setting('cf-publish-post-settings-group', 'cfuploadimage');
	register_setting('cf-publish-post-settings-group', 'cfppposttags');
	
	
}

include('lib/custom-filed-functions.php');

function cf_publish_post_settings_page()
{
    $wp_cf_publish_post_post     = isset($_GET['tab']) ? $_GET['tab'] : 'cf-publish-post-setting';
    $wp_store_presentation_post = isset($_GET['tab']) ? $_GET['tab'] : 'cf-publish-post-custom-field';
    if ($wp_cf_publish_post_post == 'cf-publish-post-setting') {
        include('lib/setting.php');
    } elseif ($wp_store_presentation_post == 'cf-publish-post-custom-field') {
        include('lib/custom-field.php');
    }
}

function cf_publish_post_custom_admin_css()
{
    global $pagenow;
    
    wp_enqueue_style('cf_style_admin', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/css/admin.css', false, 1.0, 'all');
}

function guest_author_names( $name ) {
global $post;
$author = get_post_meta( $post->ID, 'guest-author', true );
if ( $author )
$name = $author;

return $name;
}

function my_wpcf7_save($cfdata) {	
	
	$submission = WPCF7_Submission::get_instance();
    $formdata = $submission->get_posted_data();
	$formupload = $submission->uploaded_files();
    $formtitle = $cfdata->title;
    $contactform = get_option('contactform'); 
	if ( $formtitle ==  $contactform) {
 
		// access data from the submitted form
		$formfield = $formdata['fieldname'];
 
		// create a new post
		
	$posttype = get_option('posttype'); 
	$autopublish = get_option('autopublish');
	$posttitle = get_option('posttitle');
	$postdiscription = get_option('postdiscription');
	$postauthor = get_option('postauthor');
	$cfposttags = get_option('cfposttags'); 
	$posttags = get_option('cfppposttags'); 
	$cfuploadimage = get_option('cfuploadimage');	
	$tags = array($formdata[$cfposttags]);
	
	
	$newpost = array( 
		'post-type' => $posttype,
		'guest-author' => $formdata[$postauthor],
		'post_title' => $formdata[$posttitle],
		'post_content' => $formdata[$postdiscription],
		'post_author' => $current_user->ID,
		'post_status' => $autopublish
	);
 
 		$newpostid = wp_insert_post($newpost);
		
//upload image		

	//code for upload image
	if(!empty($cfuploadimage)) {
    $image_name = $formdata[$cfuploadimage];
	$image_location = $formupload[$cfuploadimage]; 
	
	$content = file_get_contents($image_location);
	$wud = wp_upload_dir(); 
	$upload = wp_upload_bits( $image_name, '', $content);
	$chemin_final = $upload['url'];
	$filename= $upload['file'];
	require_once(ABSPATH . 'wp-admin/includes/admin.php');
	$wp_filetype = wp_check_filetype(basename($filename), null );
			$attachment = array(

		 'post_mime_type' => $wp_filetype['type'],

		 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),

		 'post_content' => '',

		 'post_status' => 'inherit'

	  );
	$attach_id = wp_insert_attachment( $attachment, $filename, $newpostid);

	require_once(ABSPATH . 'wp-admin/includes/image.php');

	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );

	wp_update_attachment_metadata( $attach_id, $attach_data );

	update_post_meta($newpostid, "_thumbnail_id", $attach_id);
	
	}
		
	update_post_meta($newpostid, 'guest-author', $_POST[$postname]);
	   
    wp_set_post_terms( $newpostid, $tags, $posttags);
	   
	global $wpdb;
	$table_name = $wpdb->prefix . 'cf_publish_post'; // do not forget about tables prefix
    $result = $wpdb->get_results ( "SELECT * FROM ".$table_name."" );
    foreach ( $result as $print )   {
		// add meta data for the new post
		add_post_meta($newpostid, $print->customfield, $formdata[$print->customlabel]);
	}
	
	}
 
}

add_action('wpcf7_before_send_mail', 'my_wpcf7_save',1);

?>