<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="main">
 * @package Jobify
 * @since Jobify 1.0
 */
//NEED TO DO SERVER CHECKS
$_SESSION['restrictView'] = er_candidate_restricted_view_check() ;

?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="initial-scale=1">
<!--[if lt IE 9]>

<script src="<?php echo get_template_directory_uri(); ?>/js/source/vendor/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
<!--<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/custom.js" type="text/javascript"></script> -->
<?php 
//https://wp-types.com/documentation/user-guides/displaying-wordpress-custom-fields/
//https://wp-types.com/documentation/functions/

echo types_render_field("header-scripts", array("raw"=>"true"));

?> 

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
<div id="main" class="site-main">
