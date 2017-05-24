<div id="job_listing-<?php the_ID(); ?>" <?php job_listing_class(); ?> <?php echo apply_filters( 'jobify_listing_data', '' ); ?>>
	<div class="jobsearch_list">
		<div class="thumbnail">
			<?php
			$logo = get_the_company_logo();
			if(is_user_logged_in()){
				if ( !empty($logo) ) { ?>
					<img src="<?php echo $logo; ?>" class="img-responsive">
				<?php } else{ ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/eyerecruit_squire.jpg" class="img-responsive">
				<?php } 
			}else{
				?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rgister_member.jpg" class="img-responsive">
                <?php
			}
			?>
		</div>
		<div class="post_btns">
			<div class="postbtns_inner">
				<h6><?php printf( __( 'Posted %s ago', 'jobify' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></h6>
				<span class="label label-default">Follow Company</span>
				<span class="label job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></span>
				
				<?php 
				if ( is_user_logged_in() ) {
					$WPJM_Updater = new WP_Job_Manager_Bookmarks();
					if ( !$WPJM_Updater->is_bookmarked(get_the_ID()) ){
						echo '<a href="javascript:void(0);" class="btn btn-default btn-sm custSaveBookmark" postid="'.get_the_ID().'">Save Job</a>';
					}
					else{
						echo '<a class="btn btn-primary btn-sm" href="'.site_url().'/preferences/saved-jobs-of-interest/">Saved</a>';
					}
				}
				?>
				<a href="javascript:void(0);" class="btn btn-default btn-sm forwardThisjob" jobid="<?php echo get_the_ID(); ?>">Forward</a>
			</div>
		</div>
		<div class="searchresult_cont">
			<a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<?php
			$comName = get_the_company_name();
			if(!is_user_logged_in()){
				?>
                <span>Company info available to members.</span>
              <?php		
			}else{
				if (!empty($comName)) {
					echo '<span><a href="javascript:void(0);" >'.$comName.'</a></span>';
				}
			}
			?>
			<span>
			<?php 
			global $wpdb;
			$cityId = get_post_meta(get_the_ID(), '_job_city', true);
			$regionId = get_post_meta(get_the_ID(), '_job_state', true);

			$cityTable = $wpdb->prefix.'cities';
			$stateTable = $wpdb->prefix.'region';
			
			$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
			$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

			echo (($city->name)) ? $city->name : 'Anywhere'; 
			echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $state->name; 
			?>
			</span>
			<p id="getdesc<?php echo get_the_ID(); ?>" >
				<?php 
				$content = strip_tags(get_the_content() ); 
				$content = (strlen($content) > 160) ? substr($content,0,152).'...' : $content;
				echo $content;
				?>
			</p>
			
			<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary btn-sm">Quick View <i class="fa fa-angle-double-right"></i></a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready( function() {
		var id = '<?php echo get_the_ID(); ?>';
		jQuery('#searchSec').show();
		if ( jQuery('#job_listing-'+id).hasClass('job_position_featured') ) {
			jQuery('.after_featuredpost').remove();
			jQuery('<div class="section_title after_featuredpost"><h3>Latest Job Postings</h3></div>').insertAfter('#job_listing-'+id);
			jQuery('.after_featuredpost').hide();
		}
		else{
			jQuery('.after_featuredpost').show();
		}
		if( jQuery('.job_listing').hasClass('job_position_featured') ) {
			jQuery('.notFeatured').html('Featured');
		}
		else{
			jQuery('.notFeatured').html('Latest Job Postings');
			jQuery('.after_featuredpost').remove();
		}
		var currID = '<?php echo get_the_ID(); ?>';
		jQuery('#job_listing-'+currID+' .job-manager-applications-applied-notice').insertAfter("#getdesc"+currID);
		jQuery(".job-manager-applications-applied-notice").addClass("label job-type full-timerr");
	});
</script>
<style type="text/css">
	a[href^="https://maps.google.com/maps"], a[href^="http://maps.google.com/maps"]{display:none !important}
	.gmnoprint a, .gmnoprint span, .gm-style-cc a { display:none; }
	.gm-style-cc{ display:none}
</style>
