<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<!-- DEV NOTES : TO BE CHECKED/DELETED AS UNNECCESSARY ALONG WITH WIDGET -->
<!-- <p>Here is where the notes would be put after the results are in from the survey. It has limited space on the front page but can be give more where all the survey results are kept.</p>
<h6>Do you trust public opinion ?</h6> -->
	<!-- <div class="text-center">
		<img src="<?php echo site_url();  ?>/assets/uploads/2016/09/graph.png">
	</div> -->
<?php //echo do_shortcode('[poll id="3" type="result"]'); ?>

	<?php
	if(is_active_sidebar('question_survey_result')){
		dynamic_sidebar('question_survey_result');
	}
	?>