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
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="initial-scale=1">
<?php wp_head(); ?>
<?php 

echo types_render_field("header-scripts", array("raw"=>"true"));

?> 

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="site-branding">
				<?php $header_image = get_header_image(); ?>
				<h1 class="site-title">
				<?php if ( ! empty( $header_image ) ) : ?>
				<img src="<?php echo $header_image ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
					<?php endif; ?>
					<span><?php bloginfo( 'name' ); ?></span>
				</h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>
			<nav id="site-navigation" class="site-primary-navigation slide-left">
				<a href="#" class="primary-menu-toggle"><i class="icon-cancel-circled"></i> <span><?php _e( 'Close', 'jobify' ); ?></span></a>
				<?php get_search_form(); ?>
					<?php
					/*
					PULL PROPER MENU
					*/
					if(is_user_logged_in()){
					//echo 'PULL PRPOER NAV FOR SEEKER/EMPLOYER/ADMIN';
					global $current_user, $wpdb;
					$role = $wpdb->prefix . 'capabilities';
					$current_user->role = array_keys($current_user->$role);
					$role = $current_user->role[0];
					//echo $role;
					if($role=='candidate'){

						wp_nav_menu( array( 'menu' => 'seekers', 'menu_class' => 'nav-menu-primary' ) );
					}elseif($role=='employer'){

						wp_nav_menu( array( 'menu' => 'employers', 'menu_class' => 'nav-menu-primary' ) );
					}else{
				
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu-primary' ) ); }

					}else{

					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu-primary' ) );
					
					?>
					<!-- <span><a href="<?php //echo site_url();   ?>/login/">Login</a></span> -->

					<?php }
					?>
				</nav>
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<a href="#" class="primary-menu-toggle in-header"><i class="icon-menu"></i></a>
					<?php endif; ?>
		</div>
	</header><!-- #masthead -->
    <section id="erSiteContent">
<div id="main" class="site-main">
