<?php if ( defined( 'DOING_AJAX' ) ) : ?>
	<div class="no-jobs-found">
		<h4 class="no_job_listings_found"><?php _e( 'Whoops! Unfortunately nothing matched your search criteria.  This is often caused by applying filters and/or selections that are too restrictive. Please try again with a slightly modified search.', 'wp-job-manager' ); ?></h4>
		<p><strong>Here are some ideas that might help:</strong></p>
		<ul>
			<li>If your looking for something very specific, consider expanding your search criteria to broaden and increase your results.</li>
			<li>From those results, narrow down your focus from the specific Job Description provided by the Employer.</li>
		</ul>
		<p>Still no luck? Send us your feedback: <a href="mailto:support@EyeRecruit.com">support@EyeRecruit.com</a>.</p>
	</div><!-- no-jobs-found -->
<?php else : ?>
	<p class="no_job_listings_found"><?php _e( 'There are currently no vacancies.', 'wp-job-manager' ); ?></p>
<?php endif; ?>

<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('.notFeatured').html('No Job listing');
		jQuery('#jobpaginationDiv').html('');
	});
</script>
