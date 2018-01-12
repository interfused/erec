<?php
/*
Plugin Name: Interfused Custom Avatars 
Description: This helps users create and manage their user avatars.
 * Author: Interfused
 * Author URI: http://www.interfused-inc.com/
 * Version: 1.0
*/
/*
LEVERAGES 
http://www.croppic.net/
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'plugins_loaded', array( 'interfused_custom_avatar', 'init' ));

class Interfused_Custom_Avatar{
	
	private $userID;
	private $uploadDirectory;
	protected $pluginPath;
    protected $pluginUrl;
 	
	public static function init() {
        $class = __CLASS__;
        new $class;
    }
	
    public function __construct(){
        $this->userID = get_current_user_id();
		// Set Plugin Path
        $this->pluginPath = dirname(__FILE__);

        // Set Plugin URL
        $this->pluginUrl = WP_PLUGIN_URL . '/interfused-custom-avatars';
        //check upload directory for user content
        $this->uploadDir = WP_CONTENT_DIR.'/uploads/usr/uid_'.$userID;
        if(!is_dir($this->uploadDir)){
            $oldmask = umask(0);
            mkdir($this->uploadDir, 0777, false);
            umask($oldmask);
        }
        add_shortcode('ifused_avatar_form', array($this, 'profilePhotoForm'));
        add_shortcode('ifused_avatar', array($this, 'getGravatar'));
    }
	
	public function getGravatar(){
		$current_user = wp_get_current_user();
		if( get_avatar( $current_user->user_email ) ){
			return get_avatar( $current_user->user_email );
		}else{
			return 'no gravatar exists';
		}
	}
	
	public function profilePhotoForm(){
		wp_enqueue_style('ica-form-style', $this->pluginUrl.'/css/custom-avatar-style.css');
		wp_enqueue_script('ica-form-script1', $this->pluginUrl.'/js/croppic.js','','',true);
		//wp_enqueue_script('ica-form-script2', $this->pluginUrl.'/js/ica.js','','',true);
		
		ob_start();
		?>
       <div class="image-editor">
      <input type="file" class="cropit-image-input">
      <div class="cropit-preview"></div>
      <div class="image-size-label">
        Resize image
      </div>
      <input type="range" class="cropit-image-zoom-input">
      <button class="rotate-ccw">Rotate counterclockwise</button>
      <button class="rotate-cw">Rotate clockwise</button>

      <button class="export">Export</button>
    </div>
<script>
function getBase64Image(img) {
    // Create an empty canvas element
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    // Copy the image contents to the canvas
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);

    // Get the data-URL formatted image
    // Firefox supports PNG and JPEG. You could check img.src to
    // guess the original format, but be aware the using "image/jpg"
    // will re-encode the image.
    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}


</script>
        <?php
		return ob_get_clean();
	}
	
}
function ica_avatar_upload($atts){
    $atts = shortcode_atts( array(
        'uid' => get_current_user_id()
    ), $atts, 'ica_avatar_upload' );

  $pluginUrl = WP_PLUGIN_URL . '/interfused-custom-avatars';
  wp_enqueue_style('ica-form-style', $pluginUrl.'/css/croppic.css');
  wp_enqueue_script('ica-form-script1', $pluginUrl.'/js/croppic.js','','',true);
  $ica_finalUploadDir=WP_CONTENT_DIR.'/uploads/usr/uid_'.$atts['uid'];
  $ica_finalUploadDirUri=content_url( '/uploads/usr/uid_'.$atts['uid'] );
  //plugin_dir_path( __FILE__ )
  $initialAvatar = '';
  $extensions_arr=['.jpeg','.png','.gif'];

    for($i=0;$i<count($extensions_arr);$i++){
        $ica_finalUploadDir=WP_CONTENT_DIR.'/uploads/usr/uid_'.$atts['uid'];
        $ica_finalUploadDirUri=content_url( '/uploads/usr/uid_'.$atts['uid'] );

        $ica_filename = 'avatar_'. $atts['uid'] .$extensions_arr[$i];
        $htmlStr .= '<br>file exists check for: '.$fileUri;
        if(file_exists ( $ica_finalUploadDir .'/' . $ica_filename )){
            $initialAvatar = $ica_finalUploadDirUri .'/' . $ica_filename;
            break;
        }
    }
        //return default image
    
  ob_start();
  ?>
  <div id="croppic"></div>
  <div class="ica_avatar_upload">
    <?php echo do_shortcode('[ica_avatar]');?>
    <span class="btn btn-primary" id="cropContainerHeaderButton">Upload</span>
  </div>

  <script>
  var ica_cropOptions = {
    uploadUrl:  "<?php echo $pluginUrl;?>/img_save_to_file.php",
    cropData:{
          "finalUploadDir":"<?php echo $ica_finalUploadDir;?>",
          "finalUploadDirUri":"<?php echo $ica_finalUploadDirUri;?>",
          "dummyData2":"asdas",
          "final_filename":"avatar_<?php echo $atts['uid'];?>"
        },
    cropUrl:"<?php echo $pluginUrl;?>/img_crop_to_file.php",
    customUploadButtonId:'cropContainerHeaderButton',
    modal:true,
    processInline:true,
    loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
    onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
    onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
    onImgDrag: function(){ console.log('onImgDrag') },
    onImgZoom: function(){ console.log('onImgZoom') },
    onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
    onAfterImgCrop:function(){ 
        console.log("onAfterImgCrop dir: <?php echo $ica_finalUploadDir;?> with final URL: <?php echo $ica_finalUploadDirUri;?>") ;
        console.dir(response);
        console.log('final url is: '+response.url);
        jQuery("img.ica_avatar").attr('src',response.url);
        
    },
    onReset:function(){ console.log('onReset') },
    onError:function(errormessage){ console.log('onError:'+errormessage) }
  }

  jQuery(document).ready(function(){
    var cropperHeader = new Croppic('croppic',ica_cropOptions);

  });

  </script>
  <?php
  return ob_get_clean();
}
add_shortcode('ica_avatar_upload','ica_avatar_upload');

function ica_avatar($atts){
    $atts = shortcode_atts( array(
        'uid' => get_current_user_id()
    ), $atts, 'ica_avatar' );

//    return get_current_user_id();
    $extensions_arr=['.jpeg','.png','.gif'];

    for($i=0;$i<count($extensions_arr);$i++){
        $ica_finalUploadDir=WP_CONTENT_DIR.'/uploads/usr/uid_'.$atts['uid'];
        $ica_finalUploadDirUri=content_url( '/uploads/usr/uid_'.$atts['uid'] );

        $ica_filename = 'avatar_'. $atts['uid'] .$extensions_arr[$i];
        $htmlStr .= '<br>file exists check for: '.$fileUri;
        if(file_exists ( $ica_finalUploadDir .'/' . $ica_filename )){
            return '<img src="'.$ica_finalUploadDirUri .'/' . $ica_filename.'" alt="avatar" class="ica_avatar">';
            break;
        }
    }
        //return default image
    return '<img src="'.WP_PLUGIN_URL . '/interfused-custom-avatars/img/placeholder.png" alt="avatar" class="ica_avatar">';
}

add_shortcode('ica_avatar','ica_avatar');

//add_filter('get_avatar', array($this, 'ica_get_avatar_filter'), 99, 5);

function ica_get_avatar_filter($avatar, $id_or_email="", $size="", $default="", $alt="") {
   // global $avatar_default, $ica_upload_url, $ica_upload_dir,$wp_user_avatar_thumbnail_w,$wp_user_avatar_thumbnail_h, $mustache_admin, $mustache_avatar, $mustache_medium, $mustache_original, $mustache_thumbnail, $post, $ica_avatar_default, $ica_disable_gravatar, $ica_functions,$avatar_custom_wp_user_avatar_url;
  // User has Interfused Custom Avatar
  //$avatar = str_replace('gravatar_default','',$avatar);
  
    $avatar = '<img src="/assets/uploads/usr/uid_273/avatar_273.jpeg?d=1500523286" alt="avatar" class="ica_avatar">';
  
  /*
    if(is_object($id_or_email)) {
      if(!empty($id_or_email->comment_author_email)) {
        $avatar = get_wp_user_avatar($id_or_email, $size, $default, $alt);
      } else {
        $avatar = get_wp_user_avatar('unknown@gravatar.com', $size, $default, $alt);
      }
    } else {
      if(has_wp_user_avatar($id_or_email)) {
        $avatar = get_wp_user_avatar($id_or_email, $size, $default, $alt);
      // User has Gravatar and Gravatar is not disabled
      } elseif((bool) $ica_disable_gravatar != 1 && $ica_functions->ica_has_gravatar($id_or_email)) {
        $avatar = $avatar;
      // User doesn't have WPUA or Gravatar and Default Avatar is wp_user_avatar, show custom Default Avatar
      } elseif($avatar_default == 'wp_user_avatar' || $avatar_default == 'wp_user_avatar_custom_url' ) {
        // Show custom Default Avatar
        if( !empty($avatar_custom_wp_user_avatar_url) ){
      
      $default = $avatar_custom_wp_user_avatar_url;  
      $dimensions = ' width="'.$size.'" height="'.$size.'"';
      
    }else{
      $avatar_default = 'wp_user_avatar'; 
    }
    if( $avatar_default == 'wp_user_avatar'  ){
      if(!empty($ica_avatar_default) && $ica_functions->ica_attachment_is_image($ica_avatar_default)) {
        // Get image
        $ica_avatar_default_image = $ica_functions->ica_get_attachment_image_src($ica_avatar_default, array($size,$size));
        // Image src
        $default = $ica_avatar_default_image[0];
        // Add dimensions if numeric size
        $dimensions = ' width="'.$ica_avatar_default_image[1].'" height="'.$ica_avatar_default_image[2].'"';
      } else if( @file_exists($ica_upload_dir.$ica_avatar_default) ) {
         $default = $ica_upload_url.$ica_avatar_default;
         $dimensions = ' width="'.$size.'" height="'.$size.'"';
        }else {
        // Get mustache image based on numeric size comparison
        if($size > get_option('medium_size_w')) {
        $default = $mustache_original;
        } elseif($size <= get_option('medium_size_w') && $size > get_option('thumbnail_size_w')) {
        $default = $mustache_medium;
        } elseif($size <= get_option('thumbnail_size_w') && $size > 96) {
        $default = $mustache_thumbnail;
        } elseif($size <= 96 && $size > 32) {
        $default = $mustache_avatar;
        } elseif($size <= 32) {
        $default = $mustache_admin;
        }
        // Add dimensions if numeric size
        $dimensions = ' width="'.$size.'" height="'.$size.'"';
      }
    } 
        // Construct the img tag
        $avatar = '<img src="'.$default.'"'.$dimensions.' alt="'.$alt.'" class="avatar avatar-'.$size.' wp-user-avatar wp-user-avatar-'.$size.' photo avatar-default" />';
      }
    }
    */
    /**
     * Filter get_avatar filter
     * @since 1.9
     * @param string $avatar
     * @param int|string $id_or_email
     * @param int|string $size
     * @param string $default
     * @param string $alt
     */
    return apply_filters('ica_get_avatar_filter', $avatar, $id_or_email, $size, $default, $alt);
  }

//instantiate class
$interfused_custom_avatar = new Interfused_Custom_Avatar();
