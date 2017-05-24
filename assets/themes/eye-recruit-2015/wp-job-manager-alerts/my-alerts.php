<div id="job-manager-alerts">
	<p><?php printf( __( 'Your job alerts are shown in the table below and will be emailed to %s.', 'wp-job-manager-alerts' ), $user->user_email ); ?></p>
	<table class="job-manager-alerts">
		<thead>
			<tr>
				<th><?php _e( 'Alert Name', 'wp-job-manager-alerts' ); ?></th>
				<?php //_e( 'Keywords', 'wp-job-manager-alerts' ); ?>
				<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
					<th><?php _e( 'Categories', 'wp-job-manager-alerts' ); ?></th>
				<?php endif; ?>
				<?php if ( taxonomy_exists( 'job_listing_type' ) ) : ?>
					<th><?php _e( 'Job Type', 'wp-job-manager-alerts' ); ?></th>
				<?php endif; ?>
				<th><?php _e( 'Frequency', 'wp-job-manager-alerts' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<a href="<?php echo remove_query_arg( 'updated', add_query_arg( 'action', 'add_alert' ) ); ?>"><?php _e( 'Add alert', 'wp-job-manager-alerts' ); ?></a>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ( $alerts as $alert ) : ?>
				<tr class="alert-<?php echo $alert->post_status === 'draft' ? 'disabled' : 'enabled'; ?>">
					<td>
						<?php echo esc_html( $alert->post_title ); ?>
						<ul class="job-alert-actions">
							<?php
								$actions = apply_filters( 'job_manager_alert_actions', array(
									/*'view' => array(
										'label' => __( 'Results', 'wp-job-manager-alerts' ),
										'nonce' => false
									),*/
									'email' => array(
										'label' => __( 'Send&nbsp;Now', 'wp-job-manager-alerts' ),
										'nonce' => true
									),
									'edit' => array(
										'label' => __( 'Edit', 'wp-job-manager-alerts' ),
										'nonce' => false
									),
									'toggle_status' => array(
										'label' => $alert->post_status == 'draft' ? __( 'Enable', 'wp-job-manager-alerts' ) : __( 'Disable', 'wp-job-manager-alerts' ),
										'nonce' => true
									),
									'delete' => array(
										'label' => __( 'Delete', 'wp-job-manager-alerts' ),
										'nonce' => true
									)
								), $alert );

								foreach ( $actions as $action => $value ) {
									$action_url = remove_query_arg( 'updated', add_query_arg( array( 'action' => $action, 'alert_id' => $alert->ID ) ) );

		
									$actionid = 'id="'.$action.'_'.$alert->ID.'"';
	

									if ( $value['nonce'] )
										$action_url = wp_nonce_url( $action_url, 'job_manager_alert_actions' );

									echo '<li><a href="' . $action_url . '" class="job-alerts-action-' . $action . '" '.$actionid.'>' . $value['label'] . '</a></li>';
								}
							?>
						</ul>
					</td>

					<!-- <td class="alert_keyword"><?php
						/*if ( $value = get_post_meta( $alert->ID, 'alert_keyword', true ) )
							echo esc_html( $value );
						else
							echo '&ndash;';*/
					?></td> -->

					<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
						<td class="alert_category"><?php
							$terms = wp_get_post_terms( $alert->ID, 'job_listing_category', array( 'fields' => 'names' ) );
							echo $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
						?></td>
					<?php endif; ?>

					<?php if ( taxonomy_exists( 'job_listing_type' ) ) : ?>
						<td class="alert_tag"><?php
							$terms = wp_get_post_terms( $alert->ID, 'job_listing_type', array( 'fields' => 'names' ) );
							echo $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
						?></td>
					<?php endif; ?>
					
					<td class="alert_frequency"><?php
						$schedules = WP_Job_Manager_Alerts_Notifier::get_alert_schedules();
						$freq      = get_post_meta( $alert->ID, 'alert_frequency', true );

						if ( ! empty( $schedules[ $freq ] ) ) {
							echo esc_html( $schedules[ $freq ]['display'] );
						}

						echo '<small>' . sprintf( __( 'Next: %s at %s', 'wp-job-manager-alerts' ), date_i18n( get_option( 'date_format' ), wp_next_scheduled( 'job-manager-alert', array( $alert->ID ) ) ),  date_i18n( get_option( 'time_format' ), wp_next_scheduled( 'job-manager-alert', array( $alert->ID ) ) ) ) . '</small>';
					?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>


<script type="text/javascript">
	jQuery(document).ready( function() {
		var wloc = window.location.href; 
		var par = wloc.split('?');
		history.replaceState("", "", par[0]);
	});
</script>

<?php /*if ( (isset($_REQUEST['disable']))  && ($_REQUEST['disable'] == 'true') ) {
	$my_post = array(
	  'ID'           => $_REQUEST['alert_id'],
	  'post_status'   => 'draft',
	);
	wp_update_post( $my_post );

	echo "string";
} */ ?>
