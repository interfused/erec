<?php
/**
 * Video Widget
 *
 * @since Jobify 1.0
 */
class Jobify_Widget_Video extends Jobify_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'jobify_widget_video';
		$this->widget_description = __( 'Display a video via oEmbed with a title and description.', 'jobify' );
		$this->widget_id          = 'jobify_widget_video';
		$this->widget_name        = __( 'Jobify - Home: Video', 'jobify' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( 'Basic Listing', 'jobify' ),
				'label' => __( 'Title:', 'jobify' )
			),
			'description' => array(
				'type'  => 'textarea',
				'rows'  => 8,
				'std'   => '',
				'label' => __( 'Description:', 'jobify' ),
			),
			'video' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Video URL:', 'jobify' )
			),
			'animations' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Enable jQuery animations', 'jobify' )
			),
		);
		$this->control_ops = array(
			'width'  => 400
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) )
			return;

		global $wp_embed;

		ob_start();

		extract( $args );

		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$description = $instance[ 'description' ];
		$video       = esc_url( $instance[ 'video' ] );

		echo $before_widget;
		?>

		<div class="container">
			<div class="video-description">
				<?php if ( $title ) echo $before_title . $title . $after_title; ?>

				<?php if ( $description ) : ?>
					<p class="homepage-widget-description"><?php echo wpautop( $description ); ?></p>
				<?php endif; ?>
			</div>

			<div class="video-preview <?php echo $instance[ 'animations' ] ? 'animated' : 'static'; ?>">
				<?php echo $wp_embed->run_shortcode( '[embed]' . $video . '[/embed]' ); ?>

				<div class="homejob_btns tool_btn_info">
				<?php  if(is_user_logged_in()){   ?>
				<div class="tool_boxx">
					  <a href="<?php  echo site_url(); ?>/employers/post-a-job/" class="btn btn-success">Click Here to Post<span>10 Free Jobs!</span></a>
					  <div class="tooltio_deta">
					  		<p>For a limited time we are offering new users the chance to post their first 10 open positions on our job board absolutely FREE!.</p>
					  		<p>We facilitate interactions to make sure great candidates can find and communicate with great opportunities. Everyone, including our industry, has been following the heard and advertising open positions for the same way for a long time, too long.</p>
					  		<p>From nailing paper to post, to printing it in the local newspaper, to posting it online, the process hasn't really changed.. until now.</p>
					  		<p>The postings isn't as important as the results you get from it. Start to see what your getting differently, click the link to begin.</p>
					  </div>
				</div>
				  <?php }else{ ?>
				  <div class="tool_boxx">
					   <a href="javascript:void(0);" data-toggle="modal" data-target="#absolutely_free" class="btn btn-success">Click Here to Post<span>10 Free Jobs!</span></a>
					   <div class="tooltio_deta">
					   		<p>For a limited time we are offering new users the chance to post their first 10 open positions on our job board absolutely FREE!.</p>
					   		<p>We facilitate interactions to make sure great candidates can find and communicate with great opportunities. Everyone, including our industry, has been following the heard and advertising open positions for the same way for a long time, too long.</p>
					   		<p>From nailing paper to post, to printing it in the local newspaper, to posting it online, the process hasn't really changed.. until now.</p>
					   		<p>The postings isn't as important as the results you get from it. Start to see what your getting differently, click the link to begin.</p>
					   </div>
				  </div>
				   <?php } ?>
				  <a href="<?php  echo site_url(); ?>/job-seekers/find-a-job/" class="btn btn-success">Click Here Visit The<span>Job Board</span></a>
				</div>
			</div>
		</div>

		<?php
		echo $after_widget;

		$content = apply_filters( 'jobify_widget_video', ob_get_clean(), $instance, $args );

		echo $content;

		$this->cache_widget( $args, $content );
	}
}
