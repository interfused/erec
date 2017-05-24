<?php
global $post, $wpdb;

$type     = get_the_job_type();
$location = get_the_job_location();
$company  = get_the_company_name();
$logo = get_the_company_logo();
if ( !empty($logo) ) {
	$companyLogo = $logo;
} else {
	$companyLogo = get_stylesheet_directory_uri().'/img/maritime.png';
}
$permalink = get_the_job_permalink();


$cityId = get_post_meta(get_the_ID(), '_job_city', true);
$regionId = get_post_meta(get_the_ID(), '_job_state', true);

$cityTable = $wpdb->prefix.'cities';
$stateTable = $wpdb->prefix.'region';

$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

$er_JobMeta = get_post_meta( get_the_ID() );
$tmp=$er_JobMeta['_job_pay_hourly'][0];
$tmp2=$er_JobMeta['_job_pay_yearly'][0];									
/*
echo "\n";
echo "<h2>";*/
// Job type
/*if ( $type ) {
    echo esc_html( $type->name ) . ' - ';
}*/

// Job title
// echo esc_html( $post->post_title ) . "</h2>";

// Location and company
/*if ( $location ) {
    printf( __( 'Location: %s', 'wp-job-manager-alerts' ) . "\n", esc_html( strip_tags( $location ) ) );
	echo "<br>";
}*/

/*
if ( $company ) {
    printf( __( 'Company: %s', 'wp-job-manager-alerts' ) . "\n", esc_html( strip_tags( $company ) ) );
}
*/


// Permalink
/*printf( __( 'View Details: %s', 'wp-job-manager-alerts' ) . "\n", get_the_job_permalink() );*/

?>

<tr>
	<td width="20"></td>
	<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="ffffff" style="border-top:1px solid #ededed;">
			<tr><td height="20"></td></tr>
			<tr>
				<td width="35"></td>
				<td width="56"><img width="100px" src="<?php echo $companyLogo; ?>"></td>
				<td width="35"></td>
				<td>
					<p style="font-size:13px;color:#585858;margin:0px;font-weight:normal;line-height: 22px;">
						JOB SOURCE: COMPANY
						<br>
						<span style="font-size:14px;color:#a12641;margin:0px;font-weight:bold;">
							<?php echo $company; ?>
						</span>
						<br>
						<a href="<?php echo $permalink; ?>" style="color:#a12641; text-decoration:none; font-style:italic;"><?php echo $post->post_title; ?></a>  
						<br>
						<?php
						echo (($city->name)) ? $city->name : 'Anywhere'; 
						echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $state->name; 
						?>
						<br> 
						<span style="font-size:13px;font-weight:bold;color:#333333;">
							<?php
							if($tmp != 'n/a'){
								echo '$ '.$tmp. '/Hour';
							}
							if($tmp != 'n/a' && $tmp2 != 'n/a'){
								echo ' / ';
							}

							if($tmp2 != 'n/a'){
								echo '$ '.$tmp2. '/Year';
							}

							if($tmp == 'n/a' && $tmp2 == 'n/a'){
								echo 'DOE';
							}
							?>
						</span>
					</p>
				</td>
				<td align="right" style="vertical-align:top;font-size:13px;color:#333333;font-style: italic;font-weight:bold;">
					<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ''; ?>
				</td>
			</tr>
			<tr><td height="20"></td></tr>
		</table>
	</td>
	<td width="20"></td>
</tr>