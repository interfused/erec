	<?php if ( $packages || $user_packages ) :
							$checked = 1;
							?>
					<!-- <header class="pricing_header">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<a href="<?php  //echo site_url(); ?>"><img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/pricing_logo.png" class="img-responsive" alt="pricing_logo"></a>
							</div>
							<div class="col-md-7 col-sm-8"><h2>NO RISK.  NO HIDDEN FEES.  NO MINIMUMS.</h2></div>
						</div>
					</header> -->
					<div class="employer_pricing">
						<div class="eprice_leftcol">
							<div class="question_bx">
								<h3>Have a Question ?<span>Call 855.899.9500</span></h3>
								<ul>
									<li>Direct Access to Local Job Seekers!</li>
									<li>No expensive Set Up Fees! </li>
									<li>Dedicated Customer Support! </li>
									<li>Focus on Only Qualified Talent! </li>
								</ul>
							</div>
							<ol class="sprice_detail">
								<li>Company Appears in Candidate Searches</li>
								<li>Custom Company Branded Profile <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Custom Company Branded Profile"></i></li>
								<li>Easily Connect with Industry Recruiters</li>
								<li>Standout to Potential Job Seekers</li>
								<li>Featured in Member Spotlight <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Custom Company Branded Profile"></i></li>
								<li>Exclusive Access to Our Communinty</li>
								<li>Advanced Candidate Search Function</li>
								<li>Browse & Save Profiles</li>
								<li>Search by Industry Experience Metrics</li>
								<li>Integrated Live Secure Chat Rooms</li>
								<li>Follow the Careers that Interest You</li>
								<li>Access Employment Documents Realtime</li>
								<li>Full Access to Contact Talent Directly</li>
								<li>Early access to New Features</li>
							</ol>
						</div>
						<div class="eprice_rightcol">
						<div class="row">
					
								<?php if ( $user_packages ) : ?>
								<?php foreach ( $user_packages as $key => $package ) :
									$package = wc_paid_listings_get_package( $package );
								/*?>
									<li class="user-job-package">
										<input type="radio" <?php checked( $checked, 1 ); ?> name="job_package" value="user-<?php echo $key; ?>" id="user-package-<?php echo $package->get_id(); ?>" />
										<label for="user-package-<?php echo $package->get_id(); ?>"><?php echo $package->get_title(); ?></label><br/>
										<?php
											if ( $package->get_limit() ) {
												printf( _n( '%s job posted out of %d', '%s jobs posted out of %d', $package->get_count(), 'wp-job-manager-wc-paid-listings' ), $package->get_count(), $package->get_limit() );
											} else {
												printf( _n( '%s job posted', '%s jobs posted', $package->get_count(), 'wp-job-manager-wc-paid-listings' ), $package->get_count() );
											}

											if ( $package->get_duration() ) {
												printf(  ', ' . _n( 'listed for %s day', 'listed for %s days', $package->get_duration(), 'wp-job-manager-wc-paid-listings' ), $package->get_duration() );
											}

											$checked = 0;
										?>
									</li>
								<?php*/ endforeach; ?>
							<?php endif; ?>
							<?php if ( $packages ) : ?>
								<?php foreach ( $packages as $key => $package ) :
									$product = wc_get_product( $package );
									if ( ! $product->is_type( array( 'job_package', 'job_package_subscription' ) ) || ! $product->is_purchasable() ) {
										continue;
									}
									?>
									<div class="col-xs-3">
									<div class="sprice_col">
										<div class="spricecol_box">
											<h3><?php echo $product->post->post_title; ?></h3>
											<h4>$<big><?php echo $product->subscription_price; ?></big><small>/<br>per <?php echo $product->subscription_period; ?></small></h4>
											<a href="#" class="btn btn-sm btn-warning">Try It Free</a>
											<h5>Save 75%</h5>
										</div>
										<?php echo $product->post->post_content;  ?>

											<!-- <a href="javascript:void(0);" class="btn btn-success">Get Started</a> -->
										<input type="radio" <?php checked( $checked, 1 ); $checked = 0; ?> name="job_package" value="<?php echo $product->id; ?>" id="package-<?php echo $product->id; ?>" />
										<label for="package-<?php echo $product->id; ?>"><?php echo $product->get_title(); ?></label><br/>
										<?php/* if ( ! empty( $product->post->post_excerpt ) ) : ?>
											<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
										<?php else :
											printf( _n( '%s for %s job', '%s for %s jobs', $product->get_limit(), 'wp-job-manager-wc-paid-listings' ) . ' ', $product->get_price_html(), $product->get_limit() ? $product->get_limit() : __( 'unlimited', 'wp-job-manager-wc-paid-listings' ) );
											echo $product->get_duration() ? sprintf( _n( 'listed for %s day', 'listed for %s days', $product->get_duration(), 'wp-job-manager-wc-paid-listings' ), $product->get_duration() ) : '';
										endif;*/ ?>
									</div>
								</div>
								<?php endforeach; ?>
							<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/verisign_logo.jpg" class="img-respoinsive"></div>
							<div class="col-sm-9"><h2 class="text-center">Find The Plan That Works For You.</h2></div>
						</div>
						
					</div>
			

	<?php else : ?>

	<p><?php _e( 'No packages found', 'wp-job-manager-wc-paid-listings' ); ?></p>

	<?php endif; ?>			
