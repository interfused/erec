<div class="wrap">
      </h2>
      <div class="metabox-holder">
<?php
                    function admin_tabs($tabs, $current=NULL){
    if(is_null($current)){
        if(isset($_GET['tab'])){
            $current = $_GET['tab'];
        }
    }
    $content = '';
    $content .= '<h2 class="nav-tab-wrapper">';
    foreach($tabs as $location => $tabname){
        if($current == $location){
            $class = ' nav-tab-active';
        } else{
            $class = '';    
        }
        $content .= '<a class="nav-tab'.$class.'" href="?page=cf-publish-post&tab='.$location.'">'.$tabname.'</a>';
    }
    $content .= '</h2>';
        return $content;
}

    $my_plugin_tabs = array(    'cf-publish-post-setting' => 'Setting',
    'cf-publish-post-custom-field' => 'Custom Field',
     );

     echo admin_tabs($my_plugin_tabs);
?>
 <?php settings_errors(); ?>
     
     <div id="mm-panel-overview" class="postbox">
		 <div class="toggle default-hidden">
			<div id="mm-panel-options-wp-store">
                  <form method="post" action="options.php">
						 <p><b>labale Name:</b></p>
                                <?php              
			                    settings_fields('cf-publish-post-settings-group'); 
			                    register_cf_publish_post_settings('cf-publish-post-settings-group');
								$posttype = get_option('posttype'); 
								$autopublish = get_option('autopublish');
								$contactform  = get_option('contactform');
								$posttitle = get_option('posttitle');
								$postdiscription = get_option('postdiscription');
								$postauthor = get_option('postauthor'); 
								$cfposttags = get_option('cfposttags');
								$posttags = get_option('cfppposttags'); 
								$cfuploadimage = get_option('cfuploadimage');
								?>
								           <table class="form-table">
<p> Please write name here from contact form7 in front of desire setting : </p>
                                <tr valign="top">
                    <th scope="row">Post Title:</th>
                    <td><input type="text" name="posttitle" value="<?php echo get_option('posttitle'); ?>" /></td>
               
                </tr>

             <tr valign="top">
                    <th scope="row">Post Discription:</th>
                    <td><input type="text" name="postdiscription" value="<?php echo get_option('postdiscription'); ?>" /></td>
                </tr>
                
              <tr valign="top">
                    <th scope="row">Post tag:</th>
                    <td><input type="text" name="cfposttags" value="<?php echo get_option('cfposttags'); ?>" /></td>
                </tr>
                
                 <tr valign="top">
                    <th scope="row">Post Author:</th>
                    <td><input type="text" name="postauthor" value="<?php echo get_option('postauthor'); ?>" /></td>
                </tr>
                    
                   <tr valign="top">
                    <th scope="row">Upload Image:</th>
                    <td><input type="text" name="cfuploadimage" value="<?php echo get_option('cfuploadimage'); ?>" /><br/>
                    <span>use for featured image leave blank if you don't want to use this function.</span>
                    </td>
                    
                </tr>
                                       
                </table>
                <table class="form-table">
                   <br/>   <br/> 
                 <b>  Select Post Type : </b>
<tr valign="top">
                        <th scope="row">Post Type:</th>
                    <td><select name="posttype"> 
					<?php 
$post_types=get_post_types('','names'); 
foreach ($post_types as $post_type ) {
	?><option <?php if ($posttype == $post_type) echo 'selected="selected"'; ?> value="<?php echo $post_type; ?>"><?php echo $post_type; ?></option> <?php
 
}
?>
</select></td>
                </tr>
   
                    <tr valign="top">
                        <th scope="row">Post tags:</th>
                    <td><select name="cfppposttags"> 
                <?php 
$taxonomies=get_taxonomies('','names'); 
foreach ($taxonomies as $taxonomy ) { ?>

<option <?php if ($posttags == $taxonomy) echo 'selected="selected"'; ?> value="<?php echo $taxonomy; ?>"><?php echo $taxonomy; ?></option> <?php
 
}
?>
</select></td>
                </tr>
                              
                
                 <tr valign="top">
                    <th scope="row">Auto Publish?:</th>
                    <td><select name="autopublish">
										<option <?php if ($autopublish == 'publish') echo 'selected="selected"'; ?> value="publish"><?php _e('Publish'); ?></option>
										<option <?php if ($autopublish == 'pending') echo 'selected="selected"'; ?> value="pending"><?php _e('Pending'); ?></option>
									</select></td>
                </tr>                       
                  
 <tr valign="top">
                        <th scope="row">contact form 7 name:</th>
                    <td><select name="contactform"> 
					<?php 
						   global $wpdb;
 
 $query = "SELECT * FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'";
 $posts = $wpdb->get_results($query, OBJECT);
 
 if($posts) {
  global $post;
  foreach ($posts as $post) {
   setup_postdata($post); {
	   $ptitle = the_title("","", false);
?><option <?php if ($contactform == $ptitle) echo 'selected="selected"'; ?> value="<?php the_title(); ?>"> <?php the_title(); ?></option> <?php
 
} } }
?>
</select></td>
                </tr>
                 
                 </table>
                     
			<?php submit_button(); ?>
            </form>
							</div>
                            
					      </div>
 
                   </div>
            </div>