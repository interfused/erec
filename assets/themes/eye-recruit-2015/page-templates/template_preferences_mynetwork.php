<?php
/**
 * Template Name: Preferences my network page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
				<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<?php
				$current_user_id = get_current_user_id();
				$referenced_name = get_user_meta($current_user_id , 'rfname', true);
				$referenced_email = get_user_meta($current_user_id , 'rfemail', true); 
				$referenced_date = get_user_meta($current_user_id , 'rfdate', true); 
				?>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>My Network</h3>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id;?></span>
					</div>
					<div id="inv_frn_n_coll">
						<div class="search_bar">
							<!-- <div class="pull-right">
								<a href="javascript:void(0);">Change View</a>
								<div class="input-group">
							      <input type="text" class="form-control" placeholder="Search">
							      <span class="input-group-btn">
							        <button class="btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
							      </span>
							    </div>
							</div> -->
							<p>These are the <span>
							<?php
							if( !empty($referenced_name) && !empty($referenced_email) ) { 
								$exploded_referenced_name = explode(',', $referenced_name);
								$no_of_refs = count($exploded_referenced_name);
							 	echo $no_of_refs; 
							}
							else{
								echo "0";
							}	?></span> references in my network.</p>
							<div class="clearfix"></div>
						</div>
						<div class="network_list indent">
							<div class="row">
								<?php 
									if( !empty($referenced_name) && !empty($referenced_email) ) { 
										$exploded_referenced_name = explode(',', $referenced_name);
										$exploded_referenced_email = explode(',', $referenced_email); 

										if (!empty($referenced_date)) {
											$exploded_referenced_date = explode(',', $referenced_date); 
										}
										else{
											$exploded_referenced_date = array();
										}

										$lastUpdate  = get_user_meta( $current_user_id, 'mynetwork_lastupdate', true);
										$exploded_gettimelastupdate = explode(',', $lastUpdate );
										foreach( $exploded_referenced_name as $ref_name_key => $ref_name ) { 
											if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
												$getuser = get_user_by('email', $exploded_referenced_email[$ref_name_key]);
												$fname = $getuser->first_name;
												$usename = $fname.' '.$getuser->last_name;
												$displayname = $getuser->display_name;
												$name = (($fname))? $usename : $displayname;
												$acceDate =  date("m/d/Y", strtotime($getuser->user_registered) );
												$BEST_INDUSTRY = get_cimyFieldValue($getuser->ID, 'BEST_INDUSTRY');

												$sector = ( trim($BEST_INDUSTRY) )? $BEST_INDUSTRY : '--';
											}
											else{ 
												$name = $ref_name;
												$acceDate = '--';
												$sector = '--';
											} 

											if ( isset($exploded_referenced_date[$ref_name_key]) ) {
												$inviteddate = $exploded_referenced_date[$ref_name_key];
												$inviteddate = date('m/d/Y', $inviteddate);
											}
											else{
												$inviteddate = '--';
											}

											?>
											<div class="col-sm-6">
												<article>
													<h4><?php echo $name; ?></h4>
													<div class="network-images">
														<?php 
														if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
															$getuser = get_user_by('email', $exploded_referenced_email[$ref_name_key]);
															$userID = $getuser->ID;

															$followAttr = 'class="message_now" count="'.$ref_name_key.'" rel="'.$userID.'" refname="'.$name.'" refemail="'.$exploded_referenced_email[$ref_name_key].'"';
															$followtext = 'MESSAGE NOW';


															if ( isset($exploded_referenced_date[$ref_name_key]) ) {
																$regitime = new DateTime($getuser->user_registered);
																$changestrtotoime = date( 'Y-m-d H:i:s', $exploded_referenced_date[$ref_name_key]);
																$requtime = new DateTime($changestrtotoime);

																if ( $regitime >= $requtime) {
																	echo '<span class="badge">This <br>Just In</span>';
																}
															}
															echo do_shortcode('[ica_avatar uid="'.$userID.'"]');
															echo "<span class='join_rec_id' countkey='".$ref_name_key."' fid='".$userID."'>Recruit ID: ".$userID."</span>";
														}
														else{ 
															$followAttr = 'class="follow_up" count="'.$ref_name_key.'" refname="'.$name.'" refemail="'.$exploded_referenced_email[$ref_name_key].'"';
															$followtext = 'FOLLOW UP';
															?>
															<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" class="img-responsive">
														<?php } ?>
													</div>
													<div class="article_content">
														<ul class="network_list_info">
															<li class="cu_wordwrap"><span>Sector: </span> <?php echo $sector; ?></li>
															<li class="cu_wordwrap"><span>Invited: </span> <?php echo $inviteddate; ?></li>
															<li class="cu_wordwrap"><span>Accepted: </span> <?php echo $acceDate; ?> </li>
															<li>
																<span>Status: </span>
																<?php 
																	if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
																		echo "<strong>In Network</strong>";
																	}else{ ?>
																		<strong>Pending</strong><?php
																	}

																?>	
															</li>
														</ul>
													</div>
													<div class="clearfix"></div>
													<div class="article_footer my_network">
														<a href="javascript:void(0);" <?php echo $followAttr; ?> ><?php echo $followtext; ?></a>
														<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
													</div>
												</article>
											</div><?php 
										} 
									} 
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
				
		</div> --><!-- #content -->
		<!--
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div> --><!-- #primary -->

	<?php endwhile; ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('#inv_frn_n_coll').on('click', '.message_now', function() {
				var _this = jQuery(this);
				var ct = _this.attr('count');
				var uid = jQuery('span[countkey="'+ct+'"]').attr('fid');
				jQuery('#msgnowform').attr('uid', uid);
				jQuery('#messagenow').modal('show');
			});

			jQuery('#sendmsgnow').on('click', function() {
				var _this = jQuery(this);
				var user_id = jQuery('#msgnowform').attr('uid');
				_this.text('Please Wait...').attr('disabled','disabled');
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					data: {
						action: 'my_network_msg_now',
						'user_id': user_id,
					},
					success: function(res){
						_this.text('Send Message').removeAttr('disabled');
						jQuery('#messagenow').modal('hide');
						swal({
							title:	"Send",
							text: "<span class='text-center'>Successfully send a message!</span>", 
							type: "success",
							html: true,
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				});
			});

			jQuery("#inv_frn_n_coll").on('click', '.delete_anchor', function(){
				var _this = jQuery(this);
				var friend_n_coll_id = jQuery(this).attr('buttonid');
				var arrCout = jQuery('span').attr('arrCout');

				var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
				swal({
				  imageUrl: img,
				  title: "warning",
				  text: "You are about to permanently DELETE this contact from your Professional Network. Once you select continue, this can not be undone.",
				  showCancelButton: true,
				  confirmButtonClass: "btn-default btn-sm",
				  confirmButtonText: "Continue Delete",
				  cancelButtonText: "Cancel",
				  cancelButtonClass: "btn-primary btn-sm cancelbutton",
				  closeOnConfirm: false,
				  closeOnCancel: false,
				  customClass: 'daner_sweet'
				},
				function(isConfirm){
					if (isConfirm) {
						jQuery.ajax({
							type : 'POST',
							url : '<?php echo admin_url('admin-ajax.php'); ?>',
							data : {
								action : 'delete_name_email',
								current_user_id : '<?php echo $current_user_id; ?>',
								friend_n_coll_id : friend_n_coll_id
							},
							success : function(r) {
							    jQuery('#inv_frn_n_coll').html(r);
							}
						});
					  	swal({
							title: "Deleted!", 
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					} else {
					    swal({
					   		title:	"Cancelled",
					   		type: "error",
						   	confirmButtonClass: "btn-primary btn-sm",
					   });
					   _this.prop('checked',false);
					}
				});
			});

			jQuery('#inv_frn_n_coll').on('click', '.follow_up', function() {
				jQuery('#user_nme').val(jQuery(this).attr('refname'));
				jQuery('#user_emailadd').val(jQuery(this).attr('refemail'));
				jQuery('#followupmsg').modal('show');
			});

			jQuery('#sendfollowupmsg').on('click', function() {
				var _this = jQuery(this);
				var user_nme = jQuery('#user_nme').val();
				var user_emailadd = jQuery('#user_emailadd').val();
				_this.text('Please Wait...').attr('disabled','disabled');
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					data: {
						action: 'my_network_follow_up_msg',
						'user_nme': user_nme,
						'user_emailadd': user_emailadd,
					},
					success: function(res){
						_this.text('Send').removeAttr('disabled');
						jQuery('#followupmsg').modal('hide');
						swal({
							title:	"Send",
							text: "<span class='text-center'>Successfully send a follow up message!</span>", 
							type: "success",
							html: true,
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				});
			});
		});
	</script>
<?php get_footer('preferences'); ?>
<?php
$userdata = get_userdata($current_user_id);
$sendername = $userdata->first_name.' '.$userdata->last_name;
$cell_phone = get_user_meta($current_user_id, 'cell_phone', true);
?>
<div class="modal fade" id="followupmsg" tabindex="-1" role="dialog" aria-labelledby="followupmsgLabel">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center" role="document">
			<div class="modal-content default-form">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
					<h3>Follow Up</h3>
					<div class="clearfix"></div>
					<form  method="post" class="wpcf7-form form-horizontal" novalidate="novalidate">
						<div class="tell-us-your-story">
							<div class="form-group indent">
								<div class="col-sm-12">
									<input id="user_nme" class="form-control" name="user_nme" placeholder="Name" readonly="">
								</div>
							</div>

							<div class="form-group indent">
								<div class="col-sm-12">
									<input id="user_emailadd" class="form-control" name="user_emailadd" placeholder="Email" readonly="">
								</div>
							</div>

							<div class="form-group indent">
								<div class="col-sm-12">
									<textarea id="user_msg" class="regular-text code form-control" cols="40" rows="15" name="user_msg" readonly="">
Hello < >,

I sent you a message to take a look into a career management platform that I thought you would like.  I did not receive a notice that you followed the link and had joined me there.  Please take a minute to follow this link so you will become associated with my profile. I think it will widen your employment opportunities and at minimum, will give you a professional way to store your support documentation and forward it to someone you are interested in working for in the future. 

Sincerely,

<?php echo $sendername; ?>  </textarea>
								</div>
								<p></p>
							</div>
							<div class="form-group indent">
								<div class="col-sm-12">
								<button type="button" value="Send" id="sendfollowupmsg" class="btn btn-success btn-sm">Send</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="messagenow" tabindex="-1" role="dialog" aria-labelledby="messagenowLabel">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center" role="document">
			<div class="modal-content default-form">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
					<h3>We have provided a quick way to get you back on your way!</h3>
					<div class="clearfix"></div>
					<form  method="post" class="wpcf7-form form-horizontal" id="msgnowform" uid="" novalidate="novalidate">
						<div class="tell-us-your-story">
							<div class="form-group indent">
								<div class="col-sm-12">
									<p id="user_msgnow" class="regular-text code form-control">
Hello < >!  <br><br>

I hope you are doing well.  I am following up with you because I previously sent you an invitation to join my network within EyeRecruit.com.  I wanted to take second to send you another message to remind you that my invitation is still pending and I would be honored if you would join me.  Here is the link again.  If you have any questions please feel free to reach out and give me a call to discuss it personally, my current telephone number is <?php echo $cell_phone; ?>. <br><br>

<span>Join my network now!</span><br><br>
<?php echo $sendername; ?>  </p>
								</div>
								<p></p>
							</div>
							<div class="text-center">
								<button type="button" id="sendmsgnow" class="btn btn-primary btn-sm">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>