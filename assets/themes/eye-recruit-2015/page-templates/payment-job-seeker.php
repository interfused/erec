<?php
/**
 * Template Name: Job Seeker Payment
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */

get_header(); ?>
<style>
#content #formContentWrapper{ visibility:hidden;}
</style>
	<?php while ( have_posts() ) : the_post(); ?>
<?php
//$tmpMeta=get_post_meta(get_the_ID());
//print_r($tmpMeta);
$the_title=get_the_title();
$modTitle= types_render_field("revised-product-service-name", array("raw"=>"true"));
if($modTitle){
	$the_title = $modTitle;
}
?>
	<header class="page-header">
		<h1 class="page-title"><?php echo $the_title; ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="formStyle2 paddedTop-2x">
                
                <div id="toparea" class="row paddedTop paddedBottom">
                <div class="col-xs-3">
                <?php
				///// MAIN HERO IMAGE
				$html = types_render_field("main-image", array("arg1"=>"val1"));
				echo $html;
				?>
                
                </div>
                <?php
					$guaranteeImgExists=types_render_field("guarantee-image", array("arg1"=>"val1"));
					if($guaranteeImgExists){
						$displayClass='col-sm-7';
					}else{
						$displayClass='col-sm-9';
					}
				?>
                <div class="<?php echo $displayClass; ?>">
                 <?php
				///// MAIN HERO IMAGE
				$html = types_render_field("main-benefits-description", array("arg1"=>"val1"));
				echo $html;
				?>
                </div>
                <?php if($guaranteeImgExists){
					?>
                <div class="col-sm-2">
                 <?php
				///// MAIN HERO IMAGE
				$html = types_render_field("guarantee-image", array("arg1"=>"val1"));
				echo $html;
				?>
                </div>
                <?php } ?>
                </div>
                
                
                <div class="row ">
                <div id="formContentWrapper" class="col-md-8 padded"><?php the_content();?></div>
                <div id="side1" class="col-md-4">
                <div id="what_you_get" class="row">
                <div class="columns padded">
                 <?php
				///// MAIN HERO IMAGE
				$html = types_render_field("whats-included", array("arg1"=>"val1"));
				echo $html;
				?>
                
                </div>
                </div>
                
                <div class="row">
                <div class="splitColorDiv "><span></span></div>
                </div>
                
                <div id="trust1" class="row">
                <div class="columns padded">
                <ul id="grayTrust" class="small-block-grid-2 ">
<!-- <li class=" text-center"><i class="fa fa-4x fa-certificate"></i>30 Day
Money Back
Guarantee</li> -->
<li class=" text-center"><i class="fa fa-4x fa-shield"></i>EyeRecruit
Protects Your
Privacy</li>
<li class=" text-center"><i class="fa fa-4x fa-lock"></i>Your
Information
is Secure</li>
</ul>
                </div>
                </div>
                <div id="trust2" class="padded row" >
                
                <div class="col-md-6 text-center"><i class="fa fa-cc-visa fa-2x"></i> <i class="fa fa-cc-mastercard fa-2x"></i> <i class="fa fa-cc-discover fa-2x"></i> <i class="fa fa-cc-amex fa-2x"></i></div>
                <!--
                <div class="medium-2 columns text-center"><i class="fa fa-lock fa-4x"></i></div>
          -->      
                <div class="col-md-6 columns text-center">
                
                
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/trust/rapidssl.png" alt="secured by rapid SSL" class="ssl"/>
                </div>
                
                </div>
                
                </div>
                
                </div>
                </div>
                
                </article>
			 
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<style>
.moonray-form-element-separator-legend{
	font-family: "Rokkitt",serif !important;
	
  font-size: 22px;
  margin: 22px 0;
text-transform:uppercase;
font-weight:800;
}
.moonray-form-state-error{border:2px solid #f00 !important; background:#f6fbd8 !important;}
.moonray-form-error-message{display:none !important;}
/* input[data-required=true]{background:#f6fbd8 !important;} */
.moonray-form-element-sub-text{font-size:.8rem !important;}
.errMsgDiv{font-size:.6rem; font-weight:bold; color:#f00;}
.moonray-form-element-wrapper,#ccContainer,#cvcContainer{padding-bottom:1rem !important;}
.moonray-form-input-type-hidden{padding-bottom:0 !important;}
input#email{display:none;}
</style>

<script>
jQuery(window).load(function(e) {
	jQuery("#content #formContentWrapper").css('visibility','visible');
	jQuery("#formContentWrapper link").remove();
    var tgt1 = jQuery('input[name=firstname]').closest('div');
	var tgt2 = jQuery('input[name=lastname]').closest('div');
	tgt1.addClass('col-md-6').attr('id','firstnameContainer');
	tgt2.addClass('col-md-6').attr('id','lastnameContainer');
	jQuery('#firstnameContainer,#lastnameContainer').wrapAll('<div class="row">'); 
	
	
	tgt1 = jQuery('input[name=email]').closest('div');
	tgt2 = jQuery('input[name=f1398]').closest('div');
	
	if(tgt2){
		tgt1.addClass('col-md-6').attr('id','emailContainer');
	tgt2.addClass('col-md-6').attr('id','phoneContainer');
	jQuery('#emailContainer,#phoneContainer').wrapAll('<div class="row">'); 
	}
	/* city state */
	tgt1 = jQuery('input[name=billing_city]').closest('div');
	tgt2 = jQuery('select[name=billing_state]').closest('div');
	
	 
		tgt1.addClass('col-md-6').attr('id','cityContainer');
	tgt2.addClass('col-md-6').attr('id','stateContainer');
	jQuery('#cityContainer,#stateContainer').wrapAll('<div class="row">'); 
	
	 /* zip */
	
	tgt1 = jQuery('input[name=billing_zip]').closest('div');
	tgt2 = jQuery('select[name=billing_country]').closest('div');
	
		tgt1.addClass('col-md-6').attr('id','zipContainer');
	tgt2.addClass('col-md-6').attr('id','countryContainer');
	jQuery('#zipContainer,#countryContainer').wrapAll('<div class="row">'); 

/* cc cvc */	
 tgt1 = jQuery('input[name=payment_number]').closest('div');
	tgt1.attr('class','col-md-9').attr('id','ccContainer');
 tgt2 = jQuery('input[name=payment_code]').closest('div');
	tgt2.attr('class','col-md-3').attr('id','cvcContainer');
 jQuery("#ccContainer,#cvcContainer").wrapAll('<div class="row">');
 
/* exp and cvc  */	
	
	
	jQuery('.moonray-form-input-type-payment-exp-month, .moonray-form-input-type-payment-exp-year').wrapAll('<div class="row">');
	
	
	jQuery('.moonray-form-input-type-payment-exp-month').addClass('col-md-8').removeClass('moonray-form-input-type-payment-exp-month');
	
	jQuery('.moonray-form-input-type-payment-exp-year').addClass('col-md-4').removeClass('moonray-form-input-type-payment-exp-year');
	
	
	 jQuery('select[name=payment_expire_year]').closest('div').find('label').remove();
})
</script>

<script>
/*** BIND DOM CHAGE ***/


jQuery('form :input').bind('DOMSubtreeModified', function(){
  jQuery("div.moonray-form-error-message").remove();
   
   var tgtDiv=jQuery(this).closest('div');
   
   if(jQuery(this).hasClass('moonray-form-state-error')){
   // console.log(jQuery(this).attr('id')+" has error");
	
	var errMsg='Please enter this required field.';
	if(jQuery(this).attr('data-message')){
		errMsg=jQuery(this).attr('data-message');
	}
	
	if(tgtDiv.find('.errMsgDiv').length ){
		var found=true;
		
	}else{
		tgtDiv.append('<div class="errMsgDiv">'+errMsg+'</div>');
	}
	
   }else{
	   tgtDiv.find('.errMsgDiv').remove();
   }
   
});

jQuery('input[type=submit]').on('click',function(){
	alreadAnimated=false;
	jQuery("html, body").animate({ scrollTop: jQuery('.moonray-form-state-error').eq(0).closest('div').offset().top  }, 500,function(){
		//animation complete
		jQuery('.moonray-form-state-error')[0].focus();
		});
	});

</script>

<?php get_footer(); ?>