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
https://github.com/scottcheng/cropit
*/
//get current user email
//get gravatar
//set custom avatar if uploaded
//set upload directory

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'plugins_loaded', array( 'interfused_custom_avatar', 'init' ));
/**** TODO 
1. Get Image as src base 64 encoded to allow for usage of other javascript related transfomrations

pica javascript

****/


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
		// Set Plugin Path
        $this->pluginPath = dirname(__FILE__);
     
        // Set Plugin URL
        $this->pluginUrl = WP_PLUGIN_URL . '/interfused-custom-avatars';
		
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
		//wp_enqueue_script('ica-form-script1', $this->pluginUrl.'/js/jquery.cropit.js','','',true);
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

jQuery(".cropit-image-input").click(function(){
	console.log("crop it test");
	});

</script>
        <?php
		return ob_get_clean();
	}
	
}

$interfused_custom_avatar = new Interfused_Custom_Avatar();
