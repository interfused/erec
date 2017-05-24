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
$saveredactedcandidates = get_user_meta($current_user_id, 'saveredactedcandidates', true);
$userdata = get_userdata($user_id);
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
	<div class="light_box recruiter_box">
		<h3>Your Recruiter</h3>
		<div class="thumbnail"><img src="<?php echo site_url(); ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive"></div>
		<p>I am here to facilitate discussions, open channels of communication, and assist you and your team in building the future.</p>
		<a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal">Contact Now</a>
	</div>

	<a href="<?php echo site_url();  ?>/employer-dashboard/" class="btn btn-primary btn-block">Return to Dashboard</a>
    
	<div class="light_box quick_interaction">
		<div class="sidebar_title" id="quickCategory">
			<h4>Quick Interaction</h4>
		</div>
		<ul>
          <li><a href="javascript:void(0);">Ask this Candidate a Question</a></li>
          <li><a href="javascript:void(0);">Request a Meeting with this Candidate</a></li>
          <li><a href="javascript:void(0);">Favorite this Candidates Profile</a></li>
          <li><a href="javascript:void(0);">Follow this Candidates Career</a></li>
          <li><a href="javascript:void(0);">Print this Candidates Profile</a></li>
          <li><a href="javascript:void(0);">Set Yourself a Reminder Alert</a></li>
          <li><a href="javascript:void(0);">Block this Candidates Profile</a></li>
        </ul>
		<!-- <ul class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Ask a Question <i class="fa fa-question-circle" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="javascript:void(0);">Schedule a Time to Talk <i class="fa fa-phone" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="javascript:void(0);">Request a Meeting <i class="fa fa-users" aria-hidden="true"></i></a></li>
		</ul>
		<ol class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Follow Career <i class="fa fa-share" aria-hidden="true"></i></a></li>
		  <li role="presentation" class="<?php //echo $savecanClass; ?>"><a href="javascript:void(0);"  id="redactedSaveCandidate" recruitID="<?php //echo $user_id; ?>"><?php //echo $savecanText; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></a></li>
		</ol> -->
		<!-- <ul class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Access the Full Profile <i class="fa fa-share" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="mailto:<?php //echo $userdata->user_email; ?>">Ask a Question <i class="fa fa-question-circle" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule a Time to Talk <i class="fa fa-phone" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Request a Meeting <i class="fa fa-users" aria-hidden="true"></i></a></li>
		</ul>
		<ol class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Follow Career <i class="fa fa-share" aria-hidden="true"></i></a></li>
		  <li role="presentation" class="<?php //echo $savecanClass; ?>"><a href="javascript:void(0);" id="redactedSaveCandidate" recruitID="<?php //echo $user_id; ?>"><?php //echo $savecanText; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></a></li>
		</ol>
		<ul class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="javascript:void(0);">Set a Reminder <i class="fa fa-clock-o" aria-hidden="true"></i></a></li>
		  <li role="presentation"><a href="mailto:<?php //echo $userdata->user_email; ?>">Send a Message <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
		</ul> -->
	</div>

	<a href="#" class="btn btn-primary btn-block">Report a Violation</a>
    <a href="#" class="btn btn-primary btn-block">Suggest Improvement</a>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/leftside_ad.jpg" class="img-responsive">

	<!-- <div class="light_box team_members">
		<div class="sidebar_title">
			<span class="title_icon team_icon"></span>
			<h4>Team Interactions <i>(3)</i></h4>
		</div>
		<ul class="row">
			<li class="col-xs-3 col-sm-3 col-md-6">
				<div class="thumbnail">
					<span class="online_dot"></span>
					<img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/team_member1.jpg" class="img-responsive" alt="team_member1">
				</div>
			</li>
			<li class="col-xs-3 col-sm-3 col-md-6">
				<div class="thumbnail">
					<img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/team_member2.jpg" class="img-responsive" alt="team_member2">
				</div>
			</li>
			<li class="col-xs-3 col-sm-3 col-md-6">
				<div class="thumbnail">
					<span class="online_dot"></span>
					<img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/team_member3.jpg" class="img-responsive" alt="team_member3">
				</div>
			</li>
			<li class="col-xs-3 col-sm-3 col-md-6">
				<div class="thumbnail invite_bx">
					<i class="fa fa-users"></i>
					<a href="javascript:void(0);">Invite <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
				</div>
			</li>
			</ul>
        <p class="text-right"><a href="javascript:void(0);">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></p>
	</div> -->

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
			$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$user_id."' ORDER BY ID DESC LIMIT 12" );
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
				<a href="<?php //echo site_url();  ?>/preferences/recent-activity/?recruitID=<?php echo $user_id; ?>" class="btn btn-default">See Complete Activity
				</a>
			</div> -->
			<?php
		}else{
			echo "No results found";
		} 
		?>
	</div>
</div>