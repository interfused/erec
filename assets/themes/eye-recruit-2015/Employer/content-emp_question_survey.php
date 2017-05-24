<?php
/**
 * The default template for displaying content. Used for Last Monthly Survey
 * @package Jobify
 * @since Jobify 1.0
 */
?>
	<!-- <div class="sidebar_title">
		<span class="title_icon challenge_icon"></span>
		<h5>What is the biggest challenge you are facing today in your Career?</h5>
	</div>
	<div class="chlng_options"> 
		<div class="radio"> 
			<label> 
				<input type="radio" checked="" value="option1" id="challengeRadio1" name="challengeRadio"><span>Not being paid enough</span>
			</label> 
		</div>
		<div class="radio"> 
			<label> 
				<input type="radio" checked="" value="option1" id="challengeRadio2" name="challengeRadio"><span>No chance for advancement</span>
			</label> 
		</div>
		<div class="radio"> 
			<label> 
				<input type="radio" checked="" value="option1" id="challengeRadio3" name="challengeRadio"><span>Over qualified / bored</span>
			</label> 
		</div>
		<div class="radio"> 
			<label> 
				<input type="radio" checked="" value="option1" id="challengeRadio4" name="challengeRadio"><span>I am not sure</span>
			</label> 
		</div>
	</div>
	<div class="text-center">
		<a href="#" class="btn btn-primary">Submit</a>
	</div> -->

	<?php
			if(is_active_sidebar('question_survey')){
				dynamic_sidebar('question_survey');
			}
?>