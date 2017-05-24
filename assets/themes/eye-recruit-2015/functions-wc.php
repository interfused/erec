<?php
///WOOCOMMERCE FUNCTIONS
//https://docs.woocommerce.com/document/conditional-tags/

function singularWcPageCheck(){
	///woocommerce single product page check
if(is_product()){
	echo 'This is a singular product page';
}
}

function getSingleProductCategory(){
	//returns the first product category for a product
global $post;
 $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
  if ( $product_cats && ! is_wp_error ( $product_cats ) ){
  	 $single_cat = array_shift( $product_cats );
	//return '{replace category here }';
	return $single_cat->name;
  }else{
  	return 'NO CATEGORY';
  }

}
/**
 * Set a custom add to cart URL to redirect to.  We want to direct users to checkout skipping cart page
 * @return string
 */
function custom_add_to_cart_redirect() { 
    return '/checkout'; 
}
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );
/*
*REMOVE WOOCOMMERCE BREADCRUMB 
*/
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

// Change number or products per row to 3
// Override theme default specification for product # per row
function loop_columns() {
return 3; // 5 products per row
}
add_filter('loop_shop_columns', 'loop_columns', 999);

///return time value attribute
function er_show_product_timeval(){
	global $product;
	
$res = get_post_meta($product->id);
$tmp_arr = unserialize($res['_product_attributes'][0]);
///timeval exists
if($tmp_arr['time-value']['value']){
	echo '<p class="timeVal text-center">'.$tmp_arr['time-value']['value'].'</p>';
}

}
add_action('woocommerce_after_shop_loop_item_title','er_show_product_timeval',15);
/* 
* ADD SHORT DESCRIPTION TO ARCHIVE PAGE 
* place it above the add to cart button
*/
function er_excerpt_in_product_archives() {
	echo '<div class="shortDesc">';
    the_excerpt();  
	echo '</div>';  
}
add_action( 'woocommerce_after_shop_loop_item', 'er_excerpt_in_product_archives', 1 );

/****
modify checkout form (before)
****/
function er_preCheckoutFormSetup(){
	$htmlStr = '<div class="row"><div class="col-md-8">';
	echo $htmlStr;
}
add_action( 'woocommerce_before_checkout_form', 'er_preCheckoutFormSetup', 1 );

/****
modify checkout form (after)
****/
function er_postCheckoutFormSetup(){
	$htmlStr = '</div>';
	//sidebar
	$htmlStr .= '<div class="col-md-4"><div class="special_box"><img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/security_pro_img.jpg" alt="securityImages" ></div></div>';
	echo $htmlStr;
}
add_action( 'woocommerce_after_checkout_form', 'er_postCheckoutFormSetup', 1 );

/****
* ALLOW HTML IN CATEGORY DESCRIPTIONS
***/
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

// Change add to cart text on archives depending on product type
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Take me to their site!', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'VIEW THE GOOD STUFF', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Choose Option', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Choose Variations', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
	
}