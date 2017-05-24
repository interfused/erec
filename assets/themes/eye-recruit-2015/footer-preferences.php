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
<div class="modal fade want_logout" id="logoutcon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
                    <h3>Are you sure want to logout?</h3>
                    <div class="clearfix"></div>
                    <div class="btn_center">
	                    <a class="btn btn-primary" data-dismiss="modal" aria-label="Close" href="javascript:void(0);">No, Resume Session</a>
	                    <a class="btn btn-primary" data-target="#logoutcon" href="<?php echo wp_logout_url(); ?>">Yes, Continue with log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.unlogout').on('click', function(){
		jQuery('#logoutcon').modal('show');
	}); 
});    	

</script>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="copyright">
				<div class="container">
					<div class="site-info">
						<?php echo apply_filters( 'jobify_footer_copyright', sprintf( __( '&copy; %1$s EYE RECRUIT INC &mdash; All Rights Reserved', 'jobify' ), date( 'Y' ), get_bloginfo( 'name' ) ) ); ?>
					</div><!-- .site-info -->

					<a href="#" class="btt"><i class="icon-up-circled"></i></a>

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