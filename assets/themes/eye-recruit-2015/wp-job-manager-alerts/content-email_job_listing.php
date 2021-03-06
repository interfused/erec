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
$compensation_hourly=$er_JobMeta['_job_pay_hourly'][0];
$compensation_yearly=$er_JobMeta['_job_pay_yearly'][0];									
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
				<td width="56"><a href="<?php echo $permalink; ?>"><img width="100px" src="<?php echo $companyLogo; ?>" style="border:none;"></a></td>
				<td width="35"></td>
				<td>
					<p style="font-size:13px;color:#585858;margin:0px;font-weight:normal;line-height: 22px;">
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
							if($compensation_hourly != 'n/a'){
								echo  $compensation_hourly ;
							}
							if($compensation_hourly != 'n/a' && $compensation_yearly != 'n/a'){
								echo ' / ';
							}

							if($compensation_yearly != 'n/a'){
								echo '$ '.$compensation_yearly. '/Year';
							}

							if($compensation_hourly == 'n/a' && $compensation_yearly == 'n/a'){
								echo 'Depends on experience';
							}
							?>
						</span>
					</p>
				</td>
				<td align="right" style="vertical-align:top;font-size:13px;color:#333333;">
					<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="ffffff">
                        <tr>
                          <td width="20"></td>
                          <td align="right"><a href="<?php echo $permalink; ?>" style="display:inline-block;background: #a12641;color: #ffffff;font-size: 14px;padding: 13px 30px;text-decoration: none;border-radius: 25px;"><font color="ffffff">View details</font></a></td>
                          <td width="20"></td>
                        </tr>
                      </table>
				</td>
			</tr>
			<tr><td height="20"></td></tr>
		</table>
	</td>
	<td width="20"></td>
</tr>