<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>
	<div class="entry-summary">
		<?php
		global $wpdb;
		$userid = get_current_user_id();
		$tablename = $wpdb->prefix.'fullstripe_payments';
		$fortablename = $wpdb->prefix.'fullstripe_payment_forms';
		if ( isset($_GET['serviceType']) && !empty($_GET['serviceType']) ) {
			$getpreoption = $wpdb->get_row("SELECT * FROM $tablename WHERE formname = '".$_GET['serviceType']."' AND userid = '".$userid."' order by paymentID desc limit 1"); //WHERE formname IN $optionarr
			if ( !empty($getpreoption->formname) ) {
				$getformtitle = $wpdb->get_row("SELECT * FROM $fortablename WHERE name = '".$getpreoption->formname."' ");
				$formtitle = $getformtitle->formTitle;
			}
			else{
				$formtitle = 'Support service';
			}

			$resumeplanArr = array( 'the-entry-level-package', 'the-professional-package', 'the-executive-package');
			if ( in_array($_GET['serviceType'], $resumeplanArr) ) {
				$formtitle = 'Resume '.$formtitle;
			}
		}
		else{
			$formtitle = 'Support service';
		}

		?>
		<?php echo  str_replace('[plan_name]', $formtitle,  get_the_content()); ?>
	</div>
</article><!-- #post -->
