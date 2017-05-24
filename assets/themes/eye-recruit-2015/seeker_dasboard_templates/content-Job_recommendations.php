<?php
/**
 * The default template for displaying content. Used for seeker tips
 * @package Jobify
 * @since Jobify 1.0
 */
?>
<ul class="new_postlist">
<?php 
	$args = array("post_type"=>'job_listing',"post_status"=>'publish','orderby' => 'id','order' => 'DESC',"posts_per_page"=> 3);
	$the_queries = new Wp_query($args);
	
	if($the_queries->have_posts()){
		while($the_queries->have_posts()){ 
			$the_queries->the_post();
			$jobid = get_the_ID();
			$postdata = get_post($jobid);
			$post_title  = $postdata->post_title;

			global $wpdb;
			$cityId = get_post_meta($jobid, '_job_city', true);
			$regionId = get_post_meta($jobid, '_job_state', true);

			$cityTable = $wpdb->prefix.'cities';
			$stateTable = $wpdb->prefix.'region';
			
			$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
			$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

			
			?>
		
		<li>
			<span>
				<a href="<?php the_permalink(); ?>"><?php echo $post_title;  ?></a> <br>
				<?php 
				//echo get_post_meta($jobid,'_job_location',true); 
				echo (($city->name)) ? $city->name : 'Anywhere'; 
				echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $state->name; 
				?>
			</span>
			<p>Ref# <?php echo get_the_ID($jobid); ?><strong> <?php the_job_type($jobid); ?></strong></p>
		</li>
		
		<?php
		}
		
	}

	wp_reset_postdata();
?>
	
</ul>