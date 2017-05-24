<?php
$selectMultipleMsg='You can select multiple locations by clicking the box above.';
?>
<form method="post" class="job-manager-form">
	<fieldset>
		<label for="alert_name"><?php _e( 'Give your Alert a name', 'wp-job-manager-alerts' ); ?></label>
		<div class="field">
			<input type="text" name="alert_name" value="<?php echo esc_attr( $alert_name ); ?>" id="alert_name" class="input-text" placeholder="Name" />
		</div>
	</fieldset>

	<!-- <fieldset>
		<label for="alert_keyword"><?php _e( 'Keyword', 'wp-job-manager-alerts' ); ?></label>
		<div class="field">
			<input type="text" name="alert_keyword" value="<?php echo esc_attr( $alert_keyword ); ?>" id="alert_keyword" class="input-text" placeholder="<?php _e( 'Optionally add a keyword to match jobs against', 'wp-job-manager-alerts' ); ?>" />
		</div>
	</fieldset> -->

	<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
		<fieldset>
			<label for="alert_cats"><?php _e( 'What Category would you like to focus on?', 'wp-job-manager-alerts' ); ?></label>
			<div class="field">
				<?php
					wp_enqueue_script( 'wp-job-manager-term-multiselect' );

					job_manager_dropdown_categories( array(
						'taxonomy'     => 'job_listing_category',
						'hierarchical' => 1,
						'name'         => 'alert_cats',
						'orderby'      => 'name',
						'selected'     => $alert_cats,
						'hide_empty'   => false,
						'placeholder'  => __( 'Select a Category', 'wp-job-manager' )
					) );
				?>
                <small><?php echo $selectMultipleMsg; ?></small>
			</div>
		</fieldset>
	<?php endif; ?>

	<?php /*if ( wp_count_terms( 'job_listing_tag' ) > 0 ) : ?>
		<fieldset>
			<label for="alert_tags"><?php _e( 'Tags', 'wp-job-manager-alerts' ); ?></label>
			<div class="field">
				<?php
					wp_enqueue_script( 'wp-job-manager-term-multiselect' );

					job_manager_dropdown_categories( array(
						'taxonomy'     => 'job_listing_tag',
						'hierarchical' => 0,
						'name'         => 'alert_tags',
						'orderby'      => 'name',
						'selected'     => $alert_tags,
						'hide_empty'   => false,
						'placeholder'  => __( 'Any tag', 'wp-job-manager-alerts' )
					) );
				?>
                <small><?php echo $selectMultipleMsg; ?></small>
			</div>
		</fieldset>
	<?php endif;*/ ?>

	<fieldset>
		<label for="alert_job_type"><?php _e( 'What Type of Job Are you looking for?', 'wp-job-manager-alerts' ); ?></label>
		<div class="field">
			<select name="alert_job_type[]" data-placeholder="<?php _e( 'Select Job Type', 'wp-job-manager-alerts' ); ?>" id="alert_job_type" multiple="multiple" class="job-manager-chosen-select">
				<?php
					$terms = get_job_listing_types();
					foreach ( $terms as $term )
						echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( in_array( $term->slug, $alert_job_type ), true, false ) . '>' . esc_html( $term->name ) . '</option>';
				?>
			</select>
            <small><?php echo $selectMultipleMsg; ?></small>
		</div>
	</fieldset>

	<fieldset>
		<label for="alert_frequency"><?php _e( 'How often would you like to be alerted?', 'wp-job-manager-alerts' ); ?></label>
		<div class="field">
			<select name="alert_frequency" id="alert_frequency">
				<?php foreach ( WP_Job_Manager_Alerts_Notifier::get_alert_schedules() as $key => $schedule ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $alert_frequency, $key ); ?>><?php echo esc_html( $schedule['display'] ); ?></option>
				<?php endforeach; ?>
			</select>
            <small>How often would you like your career matches to be sent?</small>
		</div>
	</fieldset>
	<p>
		<?php wp_nonce_field( 'job_manager_alert_actions' ); ?>
		<input type="hidden" name="alert_id" value="<?php echo absint( $alert_id ); ?>" />
		<input type="submit" name="submit-job-alert" value="<?php _e( 'Save alert', 'wp-job-manager-alerts' ); ?>" />
	</p>
</form>
