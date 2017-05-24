<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<?php 
$user_id = $_REQUEST['recruitID']; 
$current_user_id = get_current_user_id();
// $user_id  = 165;
$userdata = get_userdata($user_id);
$saveredactedcandidates = get_user_meta($current_user_id, 'saveredactedcandidates', true);
if ( !empty($saveredactedcandidates) ) {
	$getprevalArr = explode(',', $saveredactedcandidates);
	
	if ( in_array($user_id, $getprevalArr) ) {
		$savecanText = 'Saved';
		$savecanClass = '';
	}
	else{
		$savecanClass = 'save_candidate';
		$savecanText = 'Save Candidate';
	}
}
else{
	$savecanClass = 'save_candidate';
	$savecanText = 'Save Candidate';
}
?>
<div class="sidebar right_sidebar">
	<div class="light_box status_indicatr">
		<div class="sidebar_title" id="quickCategory">
			<h4>Status Indicator</h4>
		</div>
		<ul>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Although there are many factors those affects why candidates become locked, many fall into this category due to family obligations and restrictions or perhaps because of the allure of hefty retention bonuses. Regardless of their reasons, locked candidates are highly unlikely to be open to discussions."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Locked</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Recruiters also will want to avoid most arrived candidates, as they are likely to feel they have achieved a level of career fulfillment that cannot be found anywhere else. While they may occasionally demonstrate curiosity about job opportunities, the arrived are almost untouchable."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Arrived</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="These candidates are performing well in their current roles but they may be looking for a bigger and better job with more responsibilities or more staff to manage. Although they are often appreciated within their company, they may want to be promoted more quickly than their company can promise."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Ambitious</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Accomplished candidates are solid performers who are comfortable in their role and have no real incentive to move on, but they may be tempted to pick up their heads and look around from time to time. The trick for recruiters is to determine which accomplished candidates have somehow found themselves in a backlog at their company and which are just average, ho-hum performers."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Accomplished</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Whether it is due to a conflict with their boss or changing priorities from new owners, these candidates are incredibly frustrated with their current situation, but are often still loyal and working hard in their role. Although they may be unhappy where they are, they are still not actively looking for new opportunities. "><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Frustrated</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="These candidates can see the writing on the wall — they are anticipating a layoff, loss of an account, or the sale of the company. Yet, they appear fully employed and many are still passive candidates. The fated with dated skills and low performance ratings are to be avoided."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Fated</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Superstar recruiters recognize that even the unemployed are not a homogenous group. There may be any number of reasons why candidates drop out of the workforce — for instance, to care for an ailing parent, or because of an outsourcing of their division’s functions. Although the most motivated to be hired, they also may be low performers with skills in low demand."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Unemployed</span></label></div></li>
			<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="At the opposite end of the spectrum from locked candidates are the unstable — the individuals who have jumped from job to job once a year (or even more often). With this many red flags, most of the unstable should be avoided, though there may always be a needle in the haystack."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Unstable</span></label></div></li>
			</ul>
        <p class="last_modify"><span data-toggle="tooltip" data-placement="top" title="John Dangle changed it">Last Modified :</span>Thursday, October 2nd 2016</p>
	</div>

	<a href="#" class="btn btn-primary btn-block">View Candidates Network</a>

	<div class="quick_interaction new_quick_interaction">
		<div class="sidebar_title" id="quickCategory">
			<h4>Quick Interaction</h4>
		</div>
		<ul class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Access the Full Profile</a></li>
		  <li role="presentation"><a href="mailto:<?php echo $userdata->user_email; ?>" >Ask a Question</a></li>
		  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule a Time to Talk</a></li>
		  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Request a Meeting</a></li>
		  <li role="presentation"><a href="javascript:void(0);">Follow Career</a></li>
		  <li role="presentation" class="<?php echo $savecanClass; ?>"><a href="javascript:void(0);" id="redactedSaveCandidate" recruitID="<?php echo $user_id; ?>"><?php echo $savecanText; ?></a></li>
		  <li role="presentation"><a href="javascript:void(0);">Set a Reminder</a></li>
		  <li role="presentation"><a href="mailto:<?php echo $userdata->user_email; ?>">Send a Message</a></li>
		</ul>
	</div>

	<a href="#" class="btn btn-primary btn-block">Report a Violation</a>

	<div class="light_box sasp_list">
		<div class="sidebar_title">
			<h4>Saved Employers</h4>
		</div>
		<ul>
			<li>
				<h6>ABC Security</h6>
				<span>Miami, FL.</span>
				<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
			</li>
			<li>
				<h6>Omaha Security</h6>
				<span>Fort Lauderdale, FL.</span>
				<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
			</li>
			<li>
				<h6>Allied Martin Investigations</h6>
				<span>Orlando, FL.</span>
				<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
			</li>
		</ul>
		<div class="text-right">
			<a href="javascript:void(0)">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<div class="light_box sasp_list">
		<div class="sidebar_title">
			<h4>Application Submited</h4>
		</div>
		<?php get_template_part('Recuiter/content', 'application_submitted'); ?>
	</div>
	<div class="light_box sasp_list">
		<div class="sidebar_title">
			<h4>Saved Job Postings</h4>
		</div>
		<?php get_template_part('Recuiter/content', 'saved_job_postings'); ?>
	</div>

	<a href="#" class="btn btn-primary btn-block">View Full Timeline Activity</a>

	<div class="light_box acti">
		<div class="sidebar_title">
			<h4>Activity Log</h4>
		</div>

		<?php 
		global $wpdb;
		$my_no_rows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id = '".$user_id."'"); 
		$count = count($my_no_rows);
		if($count>0){ ?>
			<?php 
			$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$user_id."' ORDER BY ID DESC LIMIT 8" );
			$current_time = current_time( 'timestamp' );
			echo "<ul>";
				foreach ($myrows as $key) { ?>
					<li>
					<?php echo $key->meta; ?>
					<?php echo date('\o\n m/d/Y \a\t g.iA', $key->datetime); ?>
					</li>
				<?php } ?>
			</ul>
			<!-- <div class="text-center">
				<a href="<?php //echo site_url();  ?>/preferences/recent-activity/?recruitID=<?php //echo $user_id; ?>" class="btn btn-default">See Complete Activity
				</a>
			</div> -->
			<?php
		}else{
			echo "No results found";
		} 
		?>
	</div>
</div>