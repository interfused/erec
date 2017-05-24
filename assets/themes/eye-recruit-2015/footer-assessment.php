<?php
/**
 * The template for displaying the  seeker dashboard footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>
</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="copyright">
				<div class="container">
					<div class="site-info">
						<?php echo apply_filters( 'jobify_footer_copyright', sprintf( __( '&copy; %1$s EYE RECRUIT INC &mdash; All Rights Reserved', 'jobify' ), date( 'Y' ), get_bloginfo( 'name' ) ) ); ?>
					</div><!-- .site-info -->

					<a href="javascript:void(0);" class="btt"><i class="icon-up-circled"></i></a>

					<?php
						if ( has_nav_menu( 'footer-social' ) ) :
							$social = wp_nav_menu( array(
								'theme_location'  => 'footer-social',
								'container_class' => 'footer-social',
								'items_wrap'      => '%3$s',
								'depth'           => 1,
								'echo'            => false,
								'link_before'     => '<span class="screen-reader-text">',
								'link_after'      => '</span>',
							) );

							echo strip_tags( $social, '<a><div><span>' );
						endif;
					?>
				</div>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->
	<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery("li#login2-modal a").attr("href", "<?php echo site_url(); ?>/login/");
	});

	</script>
	<?php wp_footer(); ?>
</body>
</html>