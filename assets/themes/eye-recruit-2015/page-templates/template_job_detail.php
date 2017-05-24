<?php
/**
 * Template Name: Job Detail
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header(); ?>
<section class="jobdetail_page">
	<header class="jobdetail-header" role="banner">
		<div class="container">
			<a href="<?php echo site_url();  ?>/" title="Eye Recruit" rel="home" class="site-branding pull-right">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/jobdetail_logo.jpg" alt="">
			</a>
			<a href="#">View All career Opportunities</a>
		</div>
	</header>
	<div class="page-header">
		<div class="container">
			<a href="#">Send This to a Friend</a>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="sidebar">
					<div class="special_box thumbnail">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/security_officer.jpg" class="img-responsive">
					</div>
					<div class="light_box snap_shot" id="tourSnapShot">
						<div class="sidebar_title">
							<h4>Positional Information</h4>
						</div>
						<ul>
							<li><span>Company : </span>ABC Critical Services, Inc.</li>
							<li><span>Location : </span>Miami, Florida</li>
							<li><span>Salary / Wages : </span>12.00 - 16.00 per hour</li>
							<li><span>Status : </span>Full Time / Part time</li>
							<li><span>Job Category : </span>Security Officer</li>
							<li><span>Work Experience : </span>1 + year</li>
							<li><span>Education : </span>High School, GED, College, Millitary or Law Enforcement.</li>
						</ul>
					</div>
					<div class="light_box snap_shot" id="tourSnapShot">
								<div class="sidebar_title">
									<h4>Contact Information</h4>
								</div>
								<ul>
									<li><span>Company Contact : </span>
                                    <?php
									$fname = get_the_author_meta('first_name');
$lname = get_the_author_meta('last_name');
$full_name = '';

if( empty($fname)){
    $full_name = $lname;
} elseif( empty( $lname )){
    $full_name = $fname;
} else {
    //both first name and last name are present
    $full_name = "{$fname} {$lname}";
}

echo $full_name;
									?>
                                    <br>{PUT POSITIONAL INFORMATION HERE}
                                    
                                    </li>
									<li><span>Lead Recruiter : </span>Christopher Bauer</li>
								</ul>
								<a href="mailto:resumes@eyerecruit.com?subject=Interested in EyeRecruit Job: <?php the_title() ?>&body=I am intereseted in the following job located at: <?php the_permalink() ?>">Contact now</a>
							</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jobinterest_links">
					<span class="label label-success">I'm Interested</span>
					<div class="text-center">
						<a href="#">Save</a><br>
						<a href="#">Report This Job</a>
					</div>
				</div>
				<div class="about_jobcompany">
					<div class="section_title">
						<h3>About ABC critical Services, Inc.</h3>
					</div>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
					<a href="#" class="pull-right"><i class="fa fa-angle-double-left"></i> More <i class="fa fa-angle-double-right"></i></a>
				</div>
				<div class="jobdetail_list">
					<div class="section_title">
						<h3>Security Officer - <small>Bilingual (English/Spanish)</small></h3>
					</div>
					<div class="indent">
						<h4>Primary Responsibility :</h4>
						<ul>
							<li>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.</li>
							<li>I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth.</li>
							<li>The master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.</li>
							<li>It is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. </li>
							<li>Nor again is there anyone who loves or pursues or desires to obtain pain of itself.</li>
							<li>Because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
							<li>Dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </li>
						</ul>
						<h4>The Ideal Candidate :</h4>
						<ul>
							<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
							<li>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</li>
							<li>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
							<li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li>
						</ul>
						<h4><em>Must possess one or more of the following :</em></h4>
						<ul>
							<li>Nam eget purus consequat risus iaculis venenatis quis eu metus.</li>
							<li>Curabitur posuere risus eu est gravida ultrices.</li>
							<li>Donec hendrerit urna faucibus augue faucibus, id vehicula odio condimentum.</li>
							<li>Phasellus eleifend nisl eu metus pellentesque, ullamcorper iaculis dui scelerisque.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('assessment'); ?>