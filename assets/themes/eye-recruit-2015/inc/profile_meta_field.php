<?php

add_action( 'show_user_profile', 'eyerecruit_extra_profile_fields' );
add_action( 'edit_user_profile', 'eyerecruit_extra_profile_fields' );

function eyerecruit_extra_profile_fields( $user ) { 


    if ( !in_array( 'candidate', $user->roles )  ){
        ?>
        <script type="text/javascript">
        	jQuery(document).ready( function() {
        		jQuery('table[fieldSet="Basic"]').hide();
        		jQuery('h3[fieldSet="Basic"]').hide();

        		jQuery('table[fieldSet="Plus"]').hide();
        		jQuery('h3[fieldSet="Plus"]').hide();

        		jQuery('table[fieldSet="Permissions N Allowances"]').hide();
        		jQuery('h3[fieldSet="Permissions N Allowances"]').hide();
        		
        		jQuery('table[fieldSet="Communication Preferences"]').hide();
        		jQuery('h3[fieldSet="Communication Preferences"]').hide();

        		jQuery('table[fieldSet="Support Files"]').hide();
        		jQuery('h3[fieldSet="Support Files"]').hide();

        		jQuery('table[fieldSet="Premium"]').hide();
        		jQuery('h3[fieldSet="Premium"]').hide();

        		jQuery('table[fieldSet="Ultimate"]').hide();
        		jQuery('h3[fieldSet="Ultimate"]').hide();
        	});
        </script>
        <?php
    }

    if ( !in_array( 'employer', $user->roles )  ){
        ?>
        <script type="text/javascript">
        	jQuery(document).ready( function() {
        		jQuery('table[fieldSet="Employer Profile"]').hide();
        		jQuery('h3[fieldSet="Employer Profile"]').hide();
        	});
        </script>
        <?php
    }

	$rfname = get_the_author_meta( 'rfname', $user->ID ); 
	$rfemail = get_the_author_meta( 'rfemail', $user->ID ); 


	if ( in_array( 'candidate', $user->roles )  ){ ?>

		<h3>Recommend Friends & Colleagues</h3>

		<table id="userdetail_all_fields" class="form-table"> <?php

		if ( !empty( $rfname ) ) {
			
			$count_rf =  count( $rfname );
			$count = 1;

			for ( $i=0; $i <= $count_rf; $i++ ) {  

				if ( isset( $rfname[$i] ) ) {
					$name = $rfname[$i];
				}
				else{
					$name = '';
				}

				if ( isset( $rfemail[$i] ) ) {
					$email = $rfemail[$i];
				}
				else{
					$email = '';
				}

				?>
				<thead id="userdetail_pr_<?php echo $count; ?>" class="edit-main-dv">
					<tr>
						<th><label for="name">Name</label></th>
						<td>
							<input id="rfname_<?php echo $count; ?>" class="regular-text code form-control" name="rfname[]" type="text" value="<?php echo $name; ?>" >
						</td>
					</tr>

					<tr>
						<th><label for="email">Email</label></th>
						<td>
							<input id="rfemail_<?php echo $count; ?>" class="regular-text code form-control" name="rfemail[]" type="text" value="<?php echo $email; ?>" >
						</td>
					</tr>

					<?php 
					if ( $count != 1) { ?>
						<tr>
							<th class="remove_btn">
								<span class="remove_edu button-secondary" id="remove_edu_<?php echo $count; ?>" rel="<?php echo $count; ?>">remove</span>
							</th>
						</tr> <?php 
					} ?>

				</thead> <?php 
				$count++;
			} 
		}
		else{ 
			$count_rf = 1;
			?>
			<thead id="userdetail_pr_1" class="edit-main-dv">
				<tr>
					<th><label for="name">Name</label></th>
					<td>
						<input id="rfname_1" class="regular-text code form-control" name="rfname[]" type="text">
					</td>
				</tr>

				<tr>
					<th><label for="email">Email</label></th>
					<td>
						<input id="rfemail_1" class="regular-text code form-control" name="rfemail[]" type="text">
					</td>
				</tr>
			</thead> <?php
		}
		?>
		</table>

		<table>
			<tr>
				<th class="remove_btn">
				
					<button id="userdetail_add_more" count="<?php echo $count_rf; ?>" class="userdetail_add_more button-primary-toolset" type="button">Add More</button>
				</th>
			</tr>
		</table>


		<h3>List Languages and proficiency level:</h3>
		<h5 class="lang_check_error_msg" style="display:none;color:red;">Please first select language.</h5>
		<?php
		 $rating_arr = array('Beginner', 'Intermediate', 'Expert', 'Competent', 'Advanced');
		 $th_url = get_stylesheet_directory_uri().'/img/';
		 $star = 'star_b.png'
		?>

		<script type="text/javascript">
			jQuery(document).ready( function() {

				jQuery('.lang_rating').live('click', function() {
					jQuery('.lang_check_error_msg').hide();
					var rate = jQuery(this).attr('rat');
					var lang = jQuery(this).attr('lang');
					var no = jQuery(this).attr('no');
					var in_lang = jQuery('input[name="'+lang+'"]').attr('lang');
					if( jQuery('#'+in_lang).is(':checked') ){
						jQuery('.lang_check_error_msg').hide();
						for (var i = 1; i <= no; i++) {
							jQuery('img[rtno="'+lang+'_'+i+'"]').attr('src', '<?php echo $th_url."star_r.png"; ?>');
						}

						if ( no < 5 ) {
							for (var i = parseInt(no)+1; i <= 5; i++) {
								jQuery('img[rtno="'+lang+'_'+i+'"]').attr('src', '<?php echo $th_url."star_b.png"; ?>');
							}
						}
					}
					else{
						jQuery('.lang_check_error_msg').show();
					}

				});

				jQuery('.pre_rating').each( function() { 
					var mand_r = jQuery(this).val();
					var lang_rating = jQuery(this).attr('name');
					var get_no = jQuery('img[rat="'+mand_r+'"]').attr('no');
					var lang = jQuery(this).attr('lang');
					if ( jQuery('#'+lang).is(':checked') ) {
						for (var i = 1; i <= get_no; i++) {
							jQuery('img[rtno="'+lang_rating+'_'+i+'"]').attr('src', '<?php echo $th_url."star_r.png"; ?>');
						}
					}
				});

				jQuery('input[listlang="list_language"]').on('click', function() {
					
					if ( !jQuery(this).is(':checked') ) {				
						var this_id = jQuery(this).attr('id');
						var lang = jQuery('input[name="'+this_id+'_rating"]').val('');
						for (var i = 1; i <= 5; i++) {
							jQuery('img[rtno="'+this_id+'_rating_'+i+'"]').attr('src', '<?php echo $th_url."star_b.png"; ?>');
						}
						if ( jQuery(this).attr('id') == 'other' ) {
							jQuery('input[name="list_languages_text"]').val('');
						}
					}
					else{
						jQuery('.lang_check_error_msg').hide();
					}
				});

			});
		</script>

		<table>
			<tr>
				<th>
					<label><input id="mandarin" listlang="list_language" name="list_languages_mandarin" <?php if ( !empty( get_the_author_meta('list_languages_mandarin', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Mandarin"> Mandarin</label>
					<h5>Rate Now</h5>
					<?php
						$mandarin_rating = get_the_author_meta('mandarin_rating', $user->ID);
					?>
					
					<input type="hidden" class="pre_rating" lang="mandarin" name="mandarin_rating" value="<?php echo $mandarin_rating; ?>">
					
					<img class="lang_rating" lang="mandarin_rating" no="1" rtno="mandarin_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="mandarin_rating" no="2" rtno="mandarin_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="mandarin_rating" no="3" rtno="mandarin_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="mandarin_rating" no="4" rtno="mandarin_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="mandarin_rating" no="5" rtno="mandarin_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>



				<th>
					<label><input id="vietnamese" listlang="list_language" name="list_languages_vietnamese" <?php if ( !empty( get_the_author_meta('list_languages_vietnamese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Vietnamese"> Vietnamese</label>
					<h5>Rate Now</h5>
					<?php 
					$vietnamese_rating = get_the_author_meta('vietnamese_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="vietnamese" name="vietnamese_rating" value="<?php echo $vietnamese_rating; ?>">
					
					<img class="lang_rating" lang="vietnamese_rating" no="1" rtno="vietnamese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="vietnamese_rating" no="2" rtno="vietnamese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="vietnamese_rating" no="3" rtno="vietnamese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="vietnamese_rating" no="4" rtno="vietnamese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="vietnamese_rating" no="5" rtno="vietnamese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">

				</th>
			
				<th>
					<label><input id="english" listlang="list_language" name="list_languages_english" <?php if ( !empty( get_the_author_meta('list_languages_english', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="English"> English</label>
					<h5>Rate Now</h5>
					<?php 
					$english_rating = get_the_author_meta('english_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="english" name="english_rating" value="<?php echo $english_rating; ?>">
					
					<img class="lang_rating" lang="english_rating" no="1" rtno="english_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="english_rating" no="2" rtno="english_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="english_rating" no="3" rtno="english_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="english_rating" no="4" rtno="english_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="english_rating" no="5" rtno="english_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="javanese" listlang="list_language" name="list_languages_javanese" <?php if ( !empty( get_the_author_meta('list_languages_javanese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Javanese"> Javanese</label>
					<h5>Rate Now</h5>
					<?php 
					$javanese_rating = get_the_author_meta('javanese_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="javanese" name="javanese_rating" value="<?php echo $javanese_rating; ?>">
					
					<img class="lang_rating" lang="javanese_rating" no="1" rtno="javanese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="javanese_rating" no="2" rtno="javanese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="javanese_rating" no="3" rtno="javanese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="javanese_rating" no="4" rtno="javanese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="javanese_rating" no="5" rtno="javanese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="spanish" listlang="list_language" name="list_languages_spanish" <?php if ( !empty( get_the_author_meta('list_languages_spanish', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Spanish"> Spanish</label>
					<h5>Rate Now</h5>
					<?php 
					$spanish_rating = get_the_author_meta('spanish_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="spanish" name="spanish_rating" value="<?php echo $spanish_rating; ?>">
					
					<img class="lang_rating" lang="spanish_rating" no="1" rtno="spanish_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="spanish_rating" no="2" rtno="spanish_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="spanish_rating" no="3" rtno="spanish_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="spanish_rating" no="4" rtno="spanish_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="spanish_rating" no="5" rtno="spanish_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="tamil" listlang="list_language" name="list_languages_tamil" <?php if ( !empty( get_the_author_meta('list_languages_tamil', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Tamil"> Tamil</label>
					<h5>Rate Now</h5>
					<?php
					$tamil_rating = get_the_author_meta('tamil_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="tamil" name="tamil_rating" value="<?php echo $tamil_rating; ?>">
					
					<img class="lang_rating" lang="tamil_rating" no="1" rtno="tamil_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="tamil_rating" no="2" rtno="tamil_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="tamil_rating" no="3" rtno="tamil_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="tamil_rating" no="4" rtno="tamil_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="tamil_rating" no="5" rtno="tamil_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="hindi" listlang="list_language" name="list_languages_hindi" <?php if ( !empty( get_the_author_meta('list_languages_hindi', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Hindi"> Hindi</label>
					<h5>Rate Now</h5>
					<?php
					$hindi_rating = get_the_author_meta('hindi_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="hindi" name="hindi_rating" value="<?php echo $hindi_rating; ?>">
					
					<img class="lang_rating" lang="hindi_rating" no="1" rtno="hindi_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="hindi_rating" no="2" rtno="hindi_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="hindi_rating" no="3" rtno="hindi_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="hindi_rating" no="4" rtno="hindi_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="hindi_rating" no="5" rtno="hindi_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="Korean" listlang="list_language" name="list_languages_Korean" <?php if ( !empty( get_the_author_meta('list_languages_Korean', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Korean"> Korean</label>
					<h5>Rate Now</h5>
					<?php
					$Korean_rating = get_the_author_meta('Korean_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="Korean" name="Korean_rating" value="<?php echo $Korean_rating; ?>">
					
					<img class="lang_rating" lang="Korean_rating" no="1" rtno="Korean_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="Korean_rating" no="2" rtno="Korean_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="Korean_rating" no="3" rtno="Korean_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="Korean_rating" no="4" rtno="Korean_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="Korean_rating" no="5" rtno="Korean_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="russian" listlang="list_language" name="list_languages_russian" <?php if ( !empty( get_the_author_meta('list_languages_russian', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Russian"> Russian</label>
					<h5>Rate Now</h5>
					<?php
					$russian_rating = get_the_author_meta('russian_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="russian" name="russian_rating" value="<?php echo $russian_rating; ?>">
					
					<img class="lang_rating" lang="russian_rating" no="1" rtno="russian_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="russian_rating" no="2" rtno="russian_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="russian_rating" no="3" rtno="russian_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="russian_rating" no="4" rtno="russian_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="russian_rating" no="5" rtno="russian_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>

				<th>
					<label><input id="turkish" listlang="list_language" name="list_languages_turkish" <?php if ( !empty( get_the_author_meta('list_languages_turkish', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Turkish"> Turkish</label>
					<h5>Rate Now</h5>
					<?php
					$turkish_rating = get_the_author_meta('turkish_rating', $user->ID); 
					?>
					<input type="hidden" class="pre_rating" lang="turkish" name="turkish_rating" value="<?php echo $turkish_rating; ?>">
					
					<img class="lang_rating" lang="turkish_rating" no="1" rtno="turkish_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="turkish_rating" no="2" rtno="turkish_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="turkish_rating" no="3" rtno="turkish_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="turkish_rating" no="4" rtno="turkish_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="turkish_rating" no="5" rtno="turkish_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="arabic" listlang="list_language" name="list_languages_arabic" <?php if ( !empty( get_the_author_meta('list_languages_arabic', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Arabic"> Arabic</label>
					<h5>Rate Now</h5>
					<?php
					$arabic_rating = get_the_author_meta('arabic_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="arabic" name="arabic_rating" value="<?php echo $arabic_rating; ?>">
					
					<img class="lang_rating" lang="arabic_rating" no="1" rtno="arabic_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="arabic_rating" no="2" rtno="arabic_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="arabic_rating" no="3" rtno="arabic_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="arabic_rating" no="4" rtno="arabic_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="arabic_rating" no="5" rtno="arabic_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="telugu" listlang="list_language" name="list_languages_telugu" <?php if ( !empty( get_the_author_meta('list_languages_telugu', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Telugu"> Telugu</label>
					<h5>Rate Now</h5>
					<?php
					$telugu_rating = get_the_author_meta('telugu_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="telugu" name="telugu_rating" value="<?php echo $telugu_rating; ?>">
					
					<img class="lang_rating" lang="telugu_rating" no="1" rtno="telugu_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="telugu_rating" no="2" rtno="telugu_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="telugu_rating" no="3" rtno="telugu_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="telugu_rating" no="4" rtno="telugu_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="telugu_rating" no="5" rtno="telugu_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="portuguese" listlang="list_language" name="list_languages_portuguese" <?php if ( !empty( get_the_author_meta('list_languages_portuguese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Portuguese"> Portuguese</label>
					<h5>Rate Now</h5>
					<?php
					$portuguese_rating = get_the_author_meta('portuguese_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="portuguese" name="portuguese_rating" value="<?php echo $portuguese_rating; ?>">
					
					<img class="lang_rating" lang="portuguese_rating" no="1" rtno="portuguese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="portuguese_rating" no="2" rtno="portuguese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="portuguese_rating" no="3" rtno="portuguese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="portuguese_rating" no="4" rtno="portuguese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="portuguese_rating" no="5" rtno="portuguese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="marathi" listlang="list_language" name="list_languages_marathi" <?php if ( !empty( get_the_author_meta('list_languages_marathi', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Marathi"> Marathi</label>
					<h5>Rate Now</h5>
					<?php
					$marathi_rating = get_the_author_meta('marathi_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="marathi" name="marathi_rating" value="<?php echo $marathi_rating; ?>">
					
					<img class="lang_rating" lang="marathi_rating" no="1" rtno="marathi_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="marathi_rating" no="2" rtno="marathi_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="marathi_rating" no="3" rtno="marathi_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="marathi_rating" no="4" rtno="marathi_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="marathi_rating" no="5" rtno="marathi_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="bengali" listlang="list_language" name="list_languages_bengali" <?php if ( !empty( get_the_author_meta('list_languages_bengali', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Bengali"> Bengali</label>
					<h5>Rate Now</h5>
					<?php
					$bengali_rating = get_the_author_meta('bengali_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="bengali" name="bengali_rating" value="<?php echo $bengali_rating; ?>">
					
					<img class="lang_rating" lang="bengali_rating" no="1" rtno="bengali_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="bengali_rating" no="2" rtno="bengali_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="bengali_rating" no="3" rtno="bengali_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="bengali_rating" no="4" rtno="bengali_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="bengali_rating" no="5" rtno="bengali_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="italian" listlang="list_language" name="list_languages_italian" <?php if ( !empty( get_the_author_meta('list_languages_italian', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Italian"> Italian</label>
					<h5>Rate Now</h5>
					<?php
					$italian_rating = get_the_author_meta('italian_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="italian" name="italian_rating" value="<?php echo $italian_rating; ?>">
					
					<img class="lang_rating" lang="italian_rating" no="1" rtno="italian_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="italian_rating" no="2" rtno="italian_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="italian_rating" no="3" rtno="italian_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="italian_rating" no="4" rtno="italian_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="italian_rating" no="5" rtno="italian_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="french" listlang="list_language" name="list_languages_french" <?php if ( !empty( get_the_author_meta('list_languages_french', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="French"> French</label>
					<h5>Rate Now</h5>
					<?php
					$french_rating = get_the_author_meta('french_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="french" name="french_rating" value="<?php echo $french_rating; ?>">
					
					<img class="lang_rating" lang="french_rating" no="1" rtno="french_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="french_rating" no="2" rtno="french_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="french_rating" no="3" rtno="french_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="french_rating" no="4" rtno="french_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="french_rating" no="5" rtno="french_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="thai" listlang="list_language" name="list_languages_thai" <?php if ( !empty( get_the_author_meta('list_languages_thai', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Thai"> Thai</label>
					<h5>Rate Now</h5>
					<?php
					$thai_rating = get_the_author_meta('thai_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="thai" name="thai_rating" value="<?php echo $thai_rating; ?>">
					
					<img class="lang_rating" lang="thai_rating" no="1" rtno="thai_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="thai_rating" no="2" rtno="thai_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="thai_rating" no="3" rtno="thai_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="thai_rating" no="4" rtno="thai_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="thai_rating" no="5" rtno="thai_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="malay" listlang="list_language" name="list_languages_malay" <?php if ( !empty( get_the_author_meta('list_languages_malay', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Malay, Indonesian"> Malay, Indonesian</label>
					<h5>Rate Now</h5>
					<?php
					$malay_rating = get_the_author_meta('malay_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="malay" name="malay_rating" value="<?php echo $malay_rating; ?>">
					
					<img class="lang_rating" lang="malay_rating" no="1" rtno="malay_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="malay_rating" no="2" rtno="malay_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="malay_rating" no="3" rtno="malay_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="malay_rating" no="4" rtno="malay_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="malay_rating" no="5" rtno="malay_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="burmese" listlang="list_language" name="list_languages_burmese" <?php if ( !empty( get_the_author_meta('list_languages_burmese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Burmese"> Burmese</label>
					<h5>Rate Now</h5>
					<?php
					$burmese_rating = get_the_author_meta('burmese_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="burmese" name="burmese_rating" value="<?php echo $burmese_rating; ?>">
					
					<img class="lang_rating" lang="burmese_rating" no="1" rtno="burmese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="burmese_rating" no="2" rtno="burmese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="burmese_rating" no="3" rtno="burmese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="burmese_rating" no="4" rtno="burmese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="burmese_rating" no="5" rtno="burmese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="german" listlang="list_language" name="list_languages_german" <?php if ( !empty( get_the_author_meta('list_languages_german', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="German"> German</label>
					<h5>Rate Now</h5>
					<?php
					$german_rating = get_the_author_meta('german_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="german" name="german_rating" value="<?php echo $german_rating; ?>">
					
					<img class="lang_rating" lang="german_rating" no="1" rtno="german_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="german_rating" no="2" rtno="german_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="german_rating" no="3" rtno="german_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="german_rating" no="4" rtno="german_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="german_rating" no="5" rtno="german_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="cantonese" listlang="list_language" name="list_languages_cantonese" <?php if ( !empty( get_the_author_meta('list_languages_cantonese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Cantonese"> Cantonese</label>
					<h5>Rate Now</h5>
					<?php
					$cantonese_rating = get_the_author_meta('cantonese_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="cantonese" name="cantonese_rating" value="<?php echo $cantonese_rating; ?>">
					
					<img class="lang_rating" lang="cantonese_rating" no="1" rtno="cantonese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="cantonese_rating" no="2" rtno="cantonese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="cantonese_rating" no="3" rtno="cantonese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="cantonese_rating" no="4" rtno="cantonese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="cantonese_rating" no="5" rtno="cantonese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="japanese" listlang="list_language" name="list_languages_japanese" <?php if ( !empty( get_the_author_meta('list_languages_japanese', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Japanese"> Japanese</label>
					<h5>Rate Now</h5>
					<?php
					$japanese_rating = get_the_author_meta('japanese_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="japanese" name="japanese_rating" value="<?php echo $japanese_rating; ?>">
					
					<img class="lang_rating" lang="japanese_rating" no="1" rtno="japanese_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="japanese_rating" no="2" rtno="japanese_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="japanese_rating" no="3" rtno="japanese_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="japanese_rating" no="4" rtno="japanese_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="japanese_rating" no="5" rtno="japanese_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="kannada" listlang="list_language" name="list_languages_kannada" <?php if ( !empty( get_the_author_meta('list_languages_kannada', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Kannada"> Kannada</label>
					<h5>Rate Now</h5>
					<?php
					$kannada_rating = get_the_author_meta('kannada_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="kannada" name="kannada_rating" value="<?php echo $kannada_rating; ?>">
					
					<img class="lang_rating" lang="kannada_rating" no="1" rtno="kannada_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="kannada_rating" no="2" rtno="kannada_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="kannada_rating" no="3" rtno="kannada_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="kannada_rating" no="4" rtno="kannada_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="kannada_rating" no="5" rtno="kannada_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="farsi" listlang="list_language" name="list_languages_farsi" <?php if ( !empty( get_the_author_meta('list_languages_farsi', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Farsi (Persian)"> Farsi (Persian)</label>
					<h5>Rate Now</h5>
					<?php
					$farsi_rating = get_the_author_meta('farsi_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="farsi" name="farsi_rating" value="<?php echo $farsi_rating; ?>">
					
					<img class="lang_rating" lang="farsi_rating" no="1" rtno="farsi_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="farsi_rating" no="2" rtno="farsi_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="farsi_rating" no="3" rtno="farsi_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="farsi_rating" no="4" rtno="farsi_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="farsi_rating" no="5" rtno="farsi_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="gujarati" listlang="list_language" name="list_languages_gujarati" <?php if ( !empty( get_the_author_meta('list_languages_gujarati', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Gujarati"> Gujarati</label>
					<h5>Rate Now</h5>
					<?php
					$gujarati_rating = get_the_author_meta('gujarati_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="gujarati" name="gujarati_rating" value="<?php echo $gujarati_rating; ?>">
					
					<img class="lang_rating" lang="gujarati_rating" no="1" rtno="gujarati_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="gujarati_rating" no="2" rtno="gujarati_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="gujarati_rating" no="3" rtno="gujarati_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="gujarati_rating" no="4" rtno="gujarati_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="gujarati_rating" no="5" rtno="gujarati_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="urdu" listlang="list_language" name="list_languages_urdu" <?php if ( !empty( get_the_author_meta('list_languages_urdu', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Urdu"> Urdu</label>
					<h5>Rate Now</h5>
					<?php
					$urdu_rating = get_the_author_meta('urdu_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="urdu" name="urdu_rating" value="<?php echo $urdu_rating; ?>">
					
					<img class="lang_rating" lang="urdu_rating" no="1" rtno="urdu_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="urdu_rating" no="2" rtno="urdu_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="urdu_rating" no="3" rtno="urdu_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="urdu_rating" no="4" rtno="urdu_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="urdu_rating" no="5" rtno="urdu_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="polish" listlang="list_language" name="list_languages_polish" <?php if ( !empty( get_the_author_meta('list_languages_polish', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Polish"> Polish</label>
					<h5>Rate Now</h5>
					<?php
					$polish_rating = get_the_author_meta('polish_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="polish" name="polish_rating" value="<?php echo $polish_rating; ?>">
					
					<img class="lang_rating" lang="polish_rating" no="1" rtno="polish_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="polish_rating" no="2" rtno="polish_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="polish_rating" no="3" rtno="polish_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="polish_rating" no="4" rtno="polish_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="polish_rating" no="5" rtno="polish_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="punjabi" listlang="list_language" name="list_languages_punjabi" <?php if ( !empty( get_the_author_meta('list_languages_punjabi', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Punjabi"> Punjabi</label>
					<h5>Rate Now</h5>
					<?php
					$punjabi_rating = get_the_author_meta('punjabi_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="punjabi" name="punjabi_rating" value="<?php echo $punjabi_rating; ?>">
					
					<img class="lang_rating" lang="punjabi_rating" no="1" rtno="punjabi_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="punjabi_rating" no="2" rtno="punjabi_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="punjabi_rating" no="3" rtno="punjabi_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="punjabi_rating" no="4" rtno="punjabi_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="punjabi_rating" no="5" rtno="punjabi_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

				<th>
					<label><input id="wu" listlang="list_language" name="list_languages_wu" <?php if ( !empty( get_the_author_meta('list_languages_wu', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="Wu"> Wu</label>
					<h5>Rate Now</h5>
					<?php
					$wu_rating = get_the_author_meta('wu_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="wu" name="wu_rating" value="<?php echo $wu_rating; ?>">
					
					<img class="lang_rating" lang="wu_rating" no="1" rtno="wu_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="wu_rating" no="2" rtno="wu_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="wu_rating" no="3" rtno="wu_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="wu_rating" no="4" rtno="wu_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="wu_rating" no="5" rtno="wu_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>
			</tr>

			<tr>

				<th>
					<label><input id="other" listlang="list_language" name="list_languages_other" <?php if ( !empty( get_the_author_meta('list_languages_other', $user->ID) ) ) { echo "checked"; } ?> type="checkbox" value="OTHER"> OTHER</label>
				</th>
				<th>
					<?php
						$list_languages_text = get_the_author_meta('list_languages_text', $user->ID);
					?>
					<input class="form-control" type="text" value="<?php echo $list_languages_text; ?>" listlang="list_language" name="list_languages_text">
					<h5>Rate Now</h5>
					<?php
					$other_rating = get_the_author_meta('other_rating', $user->ID); ?>
					<input type="hidden" class="pre_rating" lang="other" name="other_rating" value="<?php echo $other_rating; ?>">
					
					<img class="lang_rating" lang="other_rating" no="1" rtno="other_rating_1" rat="Beginner" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="other_rating" no="2" rtno="other_rating_2" rat="Intermediate" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="other_rating" no="3" rtno="other_rating_3" rat="Expert" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="other_rating" no="4" rtno="other_rating_4" rat="Competent" src="<?php echo $th_url.$star; ?>">
					<img class="lang_rating" lang="other_rating" no="5" rtno="other_rating_5" rat="Advanced" src="<?php echo $th_url.$star; ?>">	
				</th>

			</tr>
		</table>


		<script type="text/javascript">
		    jQuery(document).ready( function(){

		    	jQuery('#docs-achievements, #acc2_body, #docs-bgchecks').hide();
		    	
		        jQuery('.userdetail_add_more').live('click', function(){

		            var ln_no = jQuery(this).attr('count');

		            var count = parseInt(ln_no)+1;

		            jQuery("#userdetail_all_fields").append('<thead class="edit-main-dv" id="userdetail_pr_'+count+'" ><tr><th><label for="name">Name</label></th><td><input type="text" name="rfname[]" id="rfname_'+count+'" class="regular-text code form-control"></td></tr><tr><th><label for="email">Email</label></th><td><input type="text" name="rfemail[]" id="rfemail_'+count+'" class="regular-text code form-control"></td></tr><tr><th class="remove_btn"><span class="remove_edu button-secondary" id="remove_edu_'+count+'" rel="'+count+'">remove</span></th></tr></thead>');

		            jQuery(this).attr('count', count);
		        });


		        jQuery('.remove_edu').live('click', function(){
		            var rel = jQuery(this).attr('rel');
		            jQuery('#userdetail_pr_'+rel).remove();
		            jQuery('#remove_edu_'+rel).remove();
		        });

		        var count_add = parseInt( jQuery('#userdetail_add_more').attr('count') ) + 1;

		        for (var j = 2; j <= count_add; j++) {

		            if ( jQuery('#rfemail_'+j).val() == '' && jQuery('#rfname_'+j).val() == '' ) {

		                jQuery('#userdetail_pr_'+j).remove();
		            }
		            
		        };

		    });

		</script>

		<?php 
	}
}



add_action( 'personal_options_update', 'eyerecruit_extra_profile_fields_save' );
add_action( 'edit_user_profile_update', 'eyerecruit_extra_profile_fields_save' );

function eyerecruit_extra_profile_fields_save( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'rfname', implode(',', $_POST['rfname'] ) );
	update_usermeta( $user_id, 'rfemail', implode(',', $_POST['rfemail'] ) );


	update_usermeta( $user_id, 'list_languages_mandarin', $_POST['list_languages_mandarin'] );
	update_usermeta( $user_id, 'list_languages_vietnamese', $_POST['list_languages_vietnamese'] );
	update_usermeta( $user_id, 'list_languages_english', $_POST['list_languages_english'] );
	update_usermeta( $user_id, 'list_languages_javanese', $_POST['list_languages_javanese'] );
	update_usermeta( $user_id, 'list_languages_spanish', $_POST['list_languages_spanish'] );
	update_usermeta( $user_id, 'list_languages_tamil', $_POST['list_languages_tamil'] );

	update_usermeta( $user_id, 'list_languages_hindi', $_POST['list_languages_hindi'] );
	update_usermeta( $user_id, 'list_languages_Korean', $_POST['list_languages_Korean'] );
	update_usermeta( $user_id, 'list_languages_russian', $_POST['list_languages_russian'] );
	update_usermeta( $user_id, 'list_languages_turkish', $_POST['list_languages_turkish'] );
	update_usermeta( $user_id, 'list_languages_arabic', $_POST['list_languages_arabic'] );
	update_usermeta( $user_id, 'list_languages_telugu', $_POST['list_languages_telugu'] );

	update_usermeta( $user_id, 'list_languages_portuguese', $_POST['list_languages_portuguese'] );
	update_usermeta( $user_id, 'list_languages_marathi', $_POST['list_languages_marathi'] );
	update_usermeta( $user_id, 'list_languages_bengali', $_POST['list_languages_bengali'] );
	update_usermeta( $user_id, 'list_languages_italian', $_POST['list_languages_italian'] );
	update_usermeta( $user_id, 'list_languages_french', $_POST['list_languages_french'] );
	update_usermeta( $user_id, 'list_languages_thai', $_POST['list_languages_thai'] );

	update_usermeta( $user_id, 'list_languages_malay', $_POST['list_languages_malay'] );
	update_usermeta( $user_id, 'list_languages_burmese', $_POST['list_languages_burmese'] );
	update_usermeta( $user_id, 'list_languages_german', $_POST['list_languages_german'] );
	update_usermeta( $user_id, 'list_languages_cantonese', $_POST['list_languages_cantonese'] );
	update_usermeta( $user_id, 'list_languages_japanese', $_POST['list_languages_japanese'] );
	update_usermeta( $user_id, 'list_languages_kannada', $_POST['list_languages_kannada'] );

	update_usermeta( $user_id, 'list_languages_farsi', $_POST['list_languages_farsi'] );
	update_usermeta( $user_id, 'list_languages_gujarati', $_POST['list_languages_gujarati'] );
	update_usermeta( $user_id, 'list_languages_urdu', $_POST['list_languages_urdu'] );
	update_usermeta( $user_id, 'list_languages_polish', $_POST['list_languages_polish'] );
	update_usermeta( $user_id, 'list_languages_punjabi', $_POST['list_languages_punjabi'] );
	update_usermeta( $user_id, 'list_languages_wu', $_POST['list_languages_wu'] );

	update_usermeta( $user_id, 'list_languages_other', $_POST['list_languages_other'] );
	update_usermeta( $user_id, 'list_languages_text', $_POST['list_languages_text'] );


	/*Save Rating*/

	update_usermeta( $user_id, 'mandarin_rating', $_POST['mandarin_rating'] );
	update_usermeta( $user_id, 'vietnamese_rating', $_POST['vietnamese_rating'] );
	update_usermeta( $user_id, 'english_rating', $_POST['english_rating'] );
	update_usermeta( $user_id, 'javanese_rating', $_POST['javanese_rating'] );
	update_usermeta( $user_id, 'spanish_rating', $_POST['spanish_rating'] );
	update_usermeta( $user_id, 'tamil_rating', $_POST['tamil_rating'] );

	update_usermeta( $user_id, 'hindi_rating', $_POST['hindi_rating'] );
	update_usermeta( $user_id, 'Korean_rating', $_POST['Korean_rating'] );
	update_usermeta( $user_id, 'russian_rating', $_POST['russian_rating'] );
	update_usermeta( $user_id, 'turkish_rating', $_POST['turkish_rating'] );
	update_usermeta( $user_id, 'arabic_rating', $_POST['arabic_rating'] );
	update_usermeta( $user_id, 'telugu_rating', $_POST['telugu_rating'] );

	update_usermeta( $user_id, 'portuguese_rating', $_POST['portuguese_rating'] );
	update_usermeta( $user_id, 'marathi_rating', $_POST['marathi_rating'] );
	update_usermeta( $user_id, 'bengali_rating', $_POST['bengali_rating'] );
	update_usermeta( $user_id, 'italian_rating', $_POST['italian_rating'] );
	update_usermeta( $user_id, 'french_rating', $_POST['french_rating'] );
	update_usermeta( $user_id, 'thai_rating', $_POST['thai_rating'] );

	update_usermeta( $user_id, 'malay_rating', $_POST['malay_rating'] );
	update_usermeta( $user_id, 'burmese_rating', $_POST['burmese_rating'] );
	update_usermeta( $user_id, 'german_rating', $_POST['german_rating'] );
	update_usermeta( $user_id, 'cantonese_rating', $_POST['cantonese_rating'] );
	update_usermeta( $user_id, 'japanese_rating', $_POST['japanese_rating'] );
	update_usermeta( $user_id, 'kannada_rating', $_POST['kannada_rating'] );

	update_usermeta( $user_id, 'farsi_rating', $_POST['farsi_rating'] );
	update_usermeta( $user_id, 'gujarati_rating', $_POST['gujarati_rating'] );
	update_usermeta( $user_id, 'urdu_rating', $_POST['urdu_rating'] );
	update_usermeta( $user_id, 'polish_rating', $_POST['polish_rating'] );
	update_usermeta( $user_id, 'punjabi_rating', $_POST['punjabi_rating'] );
	update_usermeta( $user_id, 'wu_rating', $_POST['wu_rating'] );

	update_usermeta( $user_id, 'other_rating', $_POST['other_rating'] );

}


/*..............AjAx Update jobseeker ProFile FiELDS..................*/

add_action('wp_ajax_jobseeker_profile_data_lang', 'jobseeker_profile_data_lang');
add_action('wp_ajax_nopriv_jobseeker_profile_data_lang', 'jobseeker_profile_data_lang');

function jobseeker_profile_data_lang() {

	if ( isset($_POST['user_id']) && !empty($_POST['user_id']) ) {
		
		$user_id = multi_base64_decode($_POST['user_id']);
	}
	else{
		die();
	}


	if ( isset( $_POST['form_id'] ) ) {
		$form_id = $_POST['form_id'];
	}
	else{
		die();
	}

	if ( $form_id == 'profilebuder7062' ) {
		

		update_usermeta( $user_id, 'list_languages_mandarin', $_POST['list_languages_mandarin'] );
		update_usermeta( $user_id, 'list_languages_vietnamese', $_POST['list_languages_vietnamese'] );
		update_usermeta( $user_id, 'list_languages_english', $_POST['list_languages_english'] );
		update_usermeta( $user_id, 'list_languages_javanese', $_POST['list_languages_javanese'] );
		update_usermeta( $user_id, 'list_languages_spanish', $_POST['list_languages_spanish'] );
		update_usermeta( $user_id, 'list_languages_tamil', $_POST['list_languages_tamil'] );

		update_usermeta( $user_id, 'list_languages_hindi', $_POST['list_languages_hindi'] );
		update_usermeta( $user_id, 'list_languages_Korean', $_POST['list_languages_Korean'] );
		update_usermeta( $user_id, 'list_languages_russian', $_POST['list_languages_russian'] );
		update_usermeta( $user_id, 'list_languages_turkish', $_POST['list_languages_turkish'] );
		update_usermeta( $user_id, 'list_languages_arabic', $_POST['list_languages_arabic'] );
		update_usermeta( $user_id, 'list_languages_telugu', $_POST['list_languages_telugu'] );

		update_usermeta( $user_id, 'list_languages_portuguese', $_POST['list_languages_portuguese'] );
		update_usermeta( $user_id, 'list_languages_marathi', $_POST['list_languages_marathi'] );
		update_usermeta( $user_id, 'list_languages_bengali', $_POST['list_languages_bengali'] );
		update_usermeta( $user_id, 'list_languages_italian', $_POST['list_languages_italian'] );
		update_usermeta( $user_id, 'list_languages_french', $_POST['list_languages_french'] );
		update_usermeta( $user_id, 'list_languages_thai', $_POST['list_languages_thai'] );

		update_usermeta( $user_id, 'list_languages_malay', $_POST['list_languages_malay'] );
		update_usermeta( $user_id, 'list_languages_burmese', $_POST['list_languages_burmese'] );
		update_usermeta( $user_id, 'list_languages_german', $_POST['list_languages_german'] );
		update_usermeta( $user_id, 'list_languages_cantonese', $_POST['list_languages_cantonese'] );
		update_usermeta( $user_id, 'list_languages_japanese', $_POST['list_languages_japanese'] );
		update_usermeta( $user_id, 'list_languages_kannada', $_POST['list_languages_kannada'] );

		update_usermeta( $user_id, 'list_languages_farsi', $_POST['list_languages_farsi'] );
		update_usermeta( $user_id, 'list_languages_gujarati', $_POST['list_languages_gujarati'] );
		update_usermeta( $user_id, 'list_languages_urdu', $_POST['list_languages_urdu'] );
		update_usermeta( $user_id, 'list_languages_polish', $_POST['list_languages_polish'] );
		update_usermeta( $user_id, 'list_languages_punjabi', $_POST['list_languages_punjabi'] );
		update_usermeta( $user_id, 'list_languages_wu', $_POST['list_languages_wu'] );

		update_usermeta( $user_id, 'list_languages_other', $_POST['list_languages_other'] );
		update_usermeta( $user_id, 'list_languages_text', $_POST['list_languages_text'] );


		/*Save Rating*/

		update_usermeta( $user_id, 'mandarin_rating', $_POST['mandarin_rating'] );
		update_usermeta( $user_id, 'vietnamese_rating', $_POST['vietnamese_rating'] );
		update_usermeta( $user_id, 'english_rating', $_POST['english_rating'] );
		update_usermeta( $user_id, 'javanese_rating', $_POST['javanese_rating'] );
		update_usermeta( $user_id, 'spanish_rating', $_POST['spanish_rating'] );
		update_usermeta( $user_id, 'tamil_rating', $_POST['tamil_rating'] );

		update_usermeta( $user_id, 'hindi_rating', $_POST['hindi_rating'] );
		update_usermeta( $user_id, 'Korean_rating', $_POST['Korean_rating'] );
		update_usermeta( $user_id, 'russian_rating', $_POST['russian_rating'] );
		update_usermeta( $user_id, 'turkish_rating', $_POST['turkish_rating'] );
		update_usermeta( $user_id, 'arabic_rating', $_POST['arabic_rating'] );
		update_usermeta( $user_id, 'telugu_rating', $_POST['telugu_rating'] );

		update_usermeta( $user_id, 'portuguese_rating', $_POST['portuguese_rating'] );
		update_usermeta( $user_id, 'marathi_rating', $_POST['marathi_rating'] );
		update_usermeta( $user_id, 'bengali_rating', $_POST['bengali_rating'] );
		update_usermeta( $user_id, 'italian_rating', $_POST['italian_rating'] );
		update_usermeta( $user_id, 'french_rating', $_POST['french_rating'] );
		update_usermeta( $user_id, 'thai_rating', $_POST['thai_rating'] );

		update_usermeta( $user_id, 'malay_rating', $_POST['malay_rating'] );
		update_usermeta( $user_id, 'burmese_rating', $_POST['burmese_rating'] );
		update_usermeta( $user_id, 'german_rating', $_POST['german_rating'] );
		update_usermeta( $user_id, 'cantonese_rating', $_POST['cantonese_rating'] );
		update_usermeta( $user_id, 'japanese_rating', $_POST['japanese_rating'] );
		update_usermeta( $user_id, 'kannada_rating', $_POST['kannada_rating'] );

		update_usermeta( $user_id, 'farsi_rating', $_POST['farsi_rating'] );
		update_usermeta( $user_id, 'gujarati_rating', $_POST['gujarati_rating'] );
		update_usermeta( $user_id, 'urdu_rating', $_POST['urdu_rating'] );
		update_usermeta( $user_id, 'polish_rating', $_POST['polish_rating'] );
		update_usermeta( $user_id, 'punjabi_rating', $_POST['punjabi_rating'] );
		update_usermeta( $user_id, 'wu_rating', $_POST['wu_rating'] );

		update_usermeta( $user_id, 'other_rating', $_POST['other_rating'] );

		die();
	}

	die();

}



/*..............AjAx Update jobseeker ProFile FiELDS..................*/

add_action('wp_ajax_jobseeker_profile_data', 'jobseeker_profile_data');
add_action('wp_ajax_nopriv_jobseeker_profile_data', 'jobseeker_profile_data');

function jobseeker_profile_data() {

	if ( isset($_POST['user_id']) && !empty($_POST['user_id']) ) {
		
		$user_id = multi_base64_decode($_POST['user_id']);
	}
	else{
		die();
	}


	if ( isset( $_POST['form_id'] ) ) {
		$form_id = $_POST['form_id'];
	}
	else{
		die();
	}

	if ( $form_id == 'profilebuder7055' ) {
		
		if ( isset($_POST['AGREE_TO_RESPOND']) ) {

			$AGREE_TO_RESPOND 		= $_POST['AGREE_TO_RESPOND'];
			set_cimyFieldValue($user_id, 'AGREE_TO_RESPOND', $AGREE_TO_RESPOND );
		}
		die();
	}


	if ( $form_id == 'profilebuder7056' ) {

		if ( isset($_POST['SYSTEM_AND_PROCE']) ) {
			$SYSTEM_AND_PROCE 		= $_POST['SYSTEM_AND_PROCE'];
			set_cimyFieldValue($user_id, 'SYSTEM_AND_PROCE', $SYSTEM_AND_PROCE);
		}
		die();
	}

	if ( $form_id == 'profilebuder7057' ) {
		
		if ( isset($_POST['BEST_INDUSTRY']) ) {
			$BEST_INDUSTRY 			= $_POST['BEST_INDUSTRY'];
			set_cimyFieldValue($user_id, 'BEST_INDUSTRY', $BEST_INDUSTRY);
		}
		die();
	}

	if ( $form_id == 'profilebuder7058' ) {
		
		if ( isset($_POST['HIGHEST_EDUCATION']) ) {
			$HIGHEST_EDUCATION 		= $_POST['HIGHEST_EDUCATION'];
			set_cimyFieldValue($user_id, 'HIGHEST_EDUCATION', $HIGHEST_EDUCATION);
		}
		
		if ( isset($_POST['AREA_OF_STUDY']) ) {
			$AREA_OF_STUDY 			= $_POST['AREA_OF_STUDY'];
			set_cimyFieldValue($user_id, 'AREA_OF_STUDY', $AREA_OF_STUDY);
		}
		
		if ( isset($_POST['SCHOOL_NAME']) ) {
			$SCHOOL_NAME 			= $_POST['SCHOOL_NAME'];
			set_cimyFieldValue($user_id, 'SCHOOL_NAME', $SCHOOL_NAME);
		}
		
		if ( isset($_POST['STUDY_YEAR']) ) {
			$STUDY_YEAR 			= $_POST['STUDY_YEAR'];
			set_cimyFieldValue($user_id, 'STUDY_YEAR', $STUDY_YEAR);
		}
		
		if ( isset($_POST['STUDY_MAJOR']) ) {
			$STUDY_MAJOR 			= $_POST['STUDY_MAJOR'];
			set_cimyFieldValue($user_id, 'STUDY_MAJOR', $STUDY_MAJOR);
		}
		die();
	}

	if ( $form_id == 'profilebuder7059' ) {
		
		if ( isset($_POST['TYPE_OF_OPPORTUNITY']) ) {
			$TYPE_OF_OPPORTUNITY 	= $_POST['TYPE_OF_OPPORTUNITY'];
			set_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY', implode(',', $TYPE_OF_OPPORTUNITY) );
			//set_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY', $TYPE_OF_OPPORTUNITY );
		}

		if ( isset($_POST['JOB_SEARCH_RADIUS']) ) {
			$JOB_SEARCH_RADIUS 		= $_POST['JOB_SEARCH_RADIUS'];
			set_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS', $JOB_SEARCH_RADIUS);
		}
		die();
	}

	if ( $form_id == 'profilebuder7060' ) {

		if ( isset($_POST['US_ELIGIBLE']) ) {
			$US_ELIGIBLE 			= $_POST['US_ELIGIBLE'];
			set_cimyFieldValue($user_id, 'US_ELIGIBLE', $US_ELIGIBLE);
		}

		if ( isset($_POST['SECURITY_CLEAR_YN']) ) {
			$SECURITY_CLEAR_YN 		= $_POST['SECURITY_CLEAR_YN'];
			set_cimyFieldValue($user_id, 'SECURITY_CLEAR_YN', $SECURITY_CLEAR_YN);
		}

		if ( isset($_POST['OVER_18_YN']) ) {
			$OVER_18_YN 			= $_POST['OVER_18_YN'];
			set_cimyFieldValue($user_id, 'OVER_18_YN', $OVER_18_YN);
		}
		die();
	}


	if ( $form_id == 'profilebuder7057' ) {
		
		if ( isset($_POST['INDUSTRY_YEARS']) ) {
			$INDUSTRY_YEARS 	= $_POST['INDUSTRY_YEARS'];
			set_cimyFieldValue($user_id, 'INDUSTRY_YEARS', $INDUSTRY_YEARS);
		}
		if ( isset($_POST['POSSES_DRIVER_LICENS']) ) {
			$POSSES_DRIVER_LICENS 	= $_POST['POSSES_DRIVER_LICENS'];
			set_cimyFieldValue($user_id, 'POSSES_DRIVER_LICENS', $POSSES_DRIVER_LICENS);
		}
		if ( isset($_POST['COMPENSATION_CURRENT']) ) {
			$COMPENSATION_CURRENT 	= $_POST['COMPENSATION_CURRENT'];
			set_cimyFieldValue($user_id, 'COMPENSATION_CURRENT', $COMPENSATION_CURRENT);
		}
		if ( isset($_POST['COMPENSATION_DESIRED']) ) {
			$COMPENSATION_DESIRED 	= $_POST['COMPENSATION_DESIRED'];
			set_cimyFieldValue($user_id, 'COMPENSATION_DESIRED', $COMPENSATION_DESIRED);
		}
		
		if ( isset($_POST['DRIVER_STATE']) ) {
			$DRIVER_STATE 			= $_POST['DRIVER_STATE'];
			set_cimyFieldValue($user_id, 'DRIVER_STATE', $DRIVER_STATE);
		}
		
		if ( isset($_POST['RELIABLE_TRANSPORT']) ) {
			$RELIABLE_TRANSPORT 	= $_POST['RELIABLE_TRANSPORT'];
			set_cimyFieldValue($user_id, 'RELIABLE_TRANSPORT', $RELIABLE_TRANSPORT);
		}
		
		die();
	}

	if ( $form_id == 'profilebuder7061' ) {
		
		if ( isset($_POST['FIELD_LICENSE_STATUS']) ) {
			$FIELD_LICENSE_STATUS 	= $_POST['FIELD_LICENSE_STATUS'];
			set_cimyFieldValue($user_id, 'FIELD_LICENSE_STATUS', $FIELD_LICENSE_STATUS);
		}

		if ( isset($_POST['FIELD_LICENSE_STATE']) ) {
			$FIELD_LICENSE_STATE    = $_POST['FIELD_LICENSE_STATE'];
			set_cimyFieldValue($user_id, 'FIELD_LICENSE_STATE', implode(',', $FIELD_LICENSE_STATE));
		}
		die();
	}



	if ( $form_id == 'profilebuder7063' ) {
		
		if ( isset($_POST['CUR_WORK_SITUATION']) ) {
			$CUR_WORK_SITUATION 	= $_POST['CUR_WORK_SITUATION'];
			set_cimyFieldValue($user_id, 'CUR_WORK_SITUATION', implode(',', $CUR_WORK_SITUATION) );
		}

		die();
	}

	if ( $form_id == 'profilebuder7064' ) {
		
		if ( isset($_POST['US_ARMED_FORCES']) ) {
			$US_ARMED_FORCES 		= $_POST['US_ARMED_FORCES'];
			set_cimyFieldValue($user_id, 'US_ARMED_FORCES', $US_ARMED_FORCES);
		}
		if ( isset($_POST['US_ARMED_FORCES_OPTION']) ) {
			$US_ARMED_FORCES_OPTION 		= $_POST['US_ARMED_FORCES_OPTION'];
			set_cimyFieldValue($user_id, 'US_ARMED_FORCES_OPTI', $US_ARMED_FORCES_OPTION);
		}

		if ( isset($_POST['LOCAL_LAW_FORCE_YN']) ) {
			$LOCAL_LAW_FORCE_YN 	= $_POST['LOCAL_LAW_FORCE_YN'];
			set_cimyFieldValue($user_id, 'LOCAL_LAW_FORCE_YN', $LOCAL_LAW_FORCE_YN);
		}
		die();
	}

	if ( $form_id == 'profilebuder7066' ) {
		
		if ( isset($_POST['FEDERAL_NVESTIGATIV']) ) {
			$FEDERAL_NVESTIGATIV 	= $_POST['FEDERAL_NVESTIGATIV'];
			set_cimyFieldValue($user_id, 'FEDERAL_NVESTIGATIV', $FEDERAL_NVESTIGATIV);
		}
		
		if ( isset($_POST['US_LAW_ENFORCE_STATU']) ) {
			$US_LAW_ENFORCE_STATU 	= $_POST['US_LAW_ENFORCE_STATU'];
			set_cimyFieldValue($user_id, 'US_LAW_ENFORCE_STATU', $US_LAW_ENFORCE_STATU);
		}
		if ( isset( $_POST['US_LAW_ENFORCE_OTHER'] ) ) {
			$US_LAW_ENFORCE_OTHER = $_POST['US_LAW_ENFORCE_OTHER'];
			set_cimyFieldValue($user_id, 'US_LAW_ENFORCE_OTHER', $US_LAW_ENFORCE_OTHER);
		}
		die();
	}

	if ( $form_id == 'profilebuder7067' ) {

		if ( isset($_POST['MAJOR_METROPOLITAN']) ) {
			$MAJOR_METROPOLITAN 	= $_POST['MAJOR_METROPOLITAN'];
			set_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN', $MAJOR_METROPOLITAN);
		}

		if ( isset($_POST['MAJOR_METROPOLITAN_O']) ) {
			$MAJOR_METROPOLITAN_O 	= $_POST['MAJOR_METROPOLITAN_O'];
			set_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN_O', $MAJOR_METROPOLITAN_O);
		}

		die();
	}

	if ( $form_id == 'profilebuder7070' ) {

		if ( isset($_POST['rfname']) && !empty($_POST['rfname'])) {
			$rfname 				= $_POST['rfname'];
			update_user_meta($user_id, 'rfname', implode(',', $rfname));
		}

		if ( isset($_POST['rfemail']) && !empty($_POST['rfemail'])) {
			$rfemail 				= $_POST['rfemail'];
			update_user_meta($user_id, 'rfemail', implode(',', $rfemail));

			$currtime = time();
			$count = count($rfemail);
			$timearr = array();
			for ($i=1; $i <= $count; $i++) { 
				$timearr[] = $currtime;
			}
			$mynetwork_lastupdate_arr = implode(',', $timearr);
			update_user_meta($user_id , 'mynetwork_lastupdate', $mynetwork_lastupdate_arr);
		}
		die();
	}


	if ( $form_id == 'profilebuder7071' ) {
		

		$userdata = get_userdata($user_id);

		$name = $userdata->first_name.' '.$userdata->last_name;
		$email = $userdata->user_email;
		
		$AGREE_TO_RESPOND 			= get_cimyFieldValue($user_id, 'AGREE_TO_RESPOND');
		$AGREE_TO_RESPOND 			= ( !empty( $AGREE_TO_RESPOND ) ) ? $AGREE_TO_RESPOND : 'none';

		$SYSTEM_AND_PROCE 			= get_cimyFieldValue($user_id, 'SYSTEM_AND_PROCE');
		$SYSTEM_AND_PROCE 			= ( !empty( $SYSTEM_AND_PROCE ) ) ? $SYSTEM_AND_PROCE : 'none';

		$BEST_INDUSTRY 				= get_cimyFieldValue($user_id, 'BEST_INDUSTRY');
		$BEST_INDUSTRY 				= ( !empty( $BEST_INDUSTRY ) ) ? $BEST_INDUSTRY : 'none';


		$HIGHEST_EDUCATION 			= get_cimyFieldValue($user_id, 'HIGHEST_EDUCATION');
		if( !empty( $HIGHEST_EDUCATION ) ) {
			$other_option = array('Associates Degree', 'Bachelors Degree', 'Masters Degree', 'Doctorate Degree / PhD.');
			if ( in_array($HIGHEST_EDUCATION, $other_option) ) {
				
				$AREA_OF_STUDY 				= get_cimyFieldValue($user_id, 'AREA_OF_STUDY');
				$AREA_OF_STUDY 				= ( !empty( $AREA_OF_STUDY ) ) ? $AREA_OF_STUDY : 'none';

				$SCHOOL_NAME 				= get_cimyFieldValue($user_id, 'SCHOOL_NAME');
				$SCHOOL_NAME 				= ( !empty( $SCHOOL_NAME ) ) ? $SCHOOL_NAME : 'none';

				$STUDY_YEAR 			    = get_cimyFieldValue($user_id, 'STUDY_YEAR');
				$STUDY_YEAR 				= ( !empty( $STUDY_YEAR ) ) ? $STUDY_YEAR : 'none';

				$STUDY_MAJOR 			    = get_cimyFieldValue($user_id, 'STUDY_MAJOR');
				$STUDY_MAJOR 				= ( !empty( $STUDY_MAJOR ) ) ? $STUDY_MAJOR : 'none';

				$HIGHEST_EDUCATION = $HIGHEST_EDUCATION.'<br>Area of study : '.$AREA_OF_STUDY.'<br>School Name : '.$SCHOOL_NAME.'<br>Year : '.$STUDY_YEAR.'<br>Major : '.$STUDY_MAJOR;
				
			}
			else{
				$HIGHEST_EDUCATION = $HIGHEST_EDUCATION;
			}
		}
		else{
			$HIGHEST_EDUCATION = 'none';
		}



		
		$TYPE_OF_OPPORTUNITY 		= get_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY');
		$TYPE_OF_OPPORTUNITY 		= ( !empty( $TYPE_OF_OPPORTUNITY ) ) ? $TYPE_OF_OPPORTUNITY : 'none';

		$JOB_SEARCH_RADIUS 			= get_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS');
		$JOB_SEARCH_RADIUS 			= ( !empty( $JOB_SEARCH_RADIUS ) ) ? $JOB_SEARCH_RADIUS : 'none';

		$US_ELIGIBLE 			    = get_cimyFieldValue($user_id, 'US_ELIGIBLE');
		$US_ELIGIBLE 				= ( !empty( $US_ELIGIBLE ) ) ? $US_ELIGIBLE : 'none';

		$SECURITY_CLEAR_YN 			= get_cimyFieldValue($user_id, 'SECURITY_CLEAR_YN');
		$SECURITY_CLEAR_YN 			= ( !empty( $SECURITY_CLEAR_YN ) ) ? $SECURITY_CLEAR_YN : 'none';

		$OVER_18_YN 			    = get_cimyFieldValue($user_id, 'OVER_18_YN');
		$OVER_18_YN 				= ( !empty( $OVER_18_YN ) ) ? $OVER_18_YN : 'none';

		$POSSES_DRIVER_LICENS 		= get_cimyFieldValue($user_id, 'POSSES_DRIVER_LICENS');
		$POSSES_DRIVER_LICENS 		= ( !empty( $POSSES_DRIVER_LICENS ) ) ? $POSSES_DRIVER_LICENS : 'none';

		$DRIVER_STATE 			    = get_cimyFieldValue($user_id, 'DRIVER_STATE');
		$DRIVER_STATE 				= ( !empty( $DRIVER_STATE ) ) ? $DRIVER_STATE : 'none';

		$RELIABLE_TRANSPORT 		= get_cimyFieldValue($user_id, 'RELIABLE_TRANSPORT');
		$RELIABLE_TRANSPORT 		= ( !empty( $RELIABLE_TRANSPORT ) ) ? $RELIABLE_TRANSPORT : 'none';

		$FIELD_LICENSE_STATUS 		= get_cimyFieldValue($user_id, 'FIELD_LICENSE_STATUS');
		$FIELD_LICENSE_STATUS 		= ( !empty( $FIELD_LICENSE_STATUS ) ) ? $FIELD_LICENSE_STATUS : 'none';

		$FIELD_LICENSE_STATE 		= get_cimyFieldValue($user_id, 'FIELD_LICENSE_STATE');
		$FIELD_LICENSE_STATE 		= ( !empty( $FIELD_LICENSE_STATE ) ) ? $FIELD_LICENSE_STATE : 'none';

	
		/*.........Languages..........*/

		$language_array = array('mandarin','vietnamese','english','javanese','spanish','tamil','hindi','Korean','russian','turkish','arabic','telugu','portuguese','marathi','bengali','italian','french','thai','malay','burmese','german','cantonese','japanese','kannada','farsi','gujarati','urdu','polish','punjabi','wu','other');

		foreach ($language_array as $lang) {
			
			$list_language = get_user_meta( $user_id, 'list_languages_'.$lang, true );
			$rating = get_user_meta( $user_id, $lang.'_rating', true );

			if ( !empty( $list_language ) ) {

				if ( !empty( $rating ) ) {
					
					if ( $list_language == 'OTHER' ) {
						$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
						$list_languages[] = $list_language.' : '. $list_languages_text .' ( '.$rating.' ) ';
					}
					else{
						$list_languages[] = $list_language.' ( '.$rating.' ) ';
					}
				}
				else{
					if ( $list_language == 'OTHER' ) {
						$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
						$list_languages[] = $list_language.' : '. $list_languages_text;
					}
					else{
						$list_languages[] = $list_language;
					}
				}
			}
		}

		if ( !empty($list_languages) ) {
			
			$LANGUAGES_SPOKEN = implode('<br>', $list_languages);
		}
		else{
			$LANGUAGES_SPOKEN = 'none';
		}


		$CUR_WORK_SITUATION 		= get_cimyFieldValue($user_id, 'CUR_WORK_SITUATION');
		$CUR_WORK_SITUATION 		= ( !empty( $CUR_WORK_SITUATION ) ) ? $CUR_WORK_SITUATION : 'none';

		$US_ARMED_FORCES 			= get_cimyFieldValue($user_id, 'US_ARMED_FORCES');
		if ( !empty( $US_ARMED_FORCES ) ) {
			if ( $US_ARMED_FORCES == 'Yes' ) {
				
				$US_ARMED_FORCES_OPTION 			= get_cimyFieldValue($user_id, 'US_ARMED_FORCES_OPTI');
				if ( !empty( $US_ARMED_FORCES_OPTION ) ) {

					$US_ARMED_FORCES 		= $US_ARMED_FORCES.' ( '.$US_ARMED_FORCES_OPTION.' ) ';
				}
				else{
					$US_ARMED_FORCES 		= $US_ARMED_FORCES;
				}
			}
			else{
				$US_ARMED_FORCES 		= $US_ARMED_FORCES;
			}
		}
		else{

			$US_ARMED_FORCES 		= 'none';
		}

		$LOCAL_LAW_FORCE_YN 		= get_cimyFieldValue($user_id, 'LOCAL_LAW_FORCE_YN');
		$LOCAL_LAW_FORCE_YN 		= ( !empty( $LOCAL_LAW_FORCE_YN ) ) ? $LOCAL_LAW_FORCE_YN : 'none';

		$FEDERAL_NVESTIGATIV 		= get_cimyFieldValue($user_id, 'FEDERAL_NVESTIGATIV');

		if ( !empty( $FEDERAL_NVESTIGATIV ) ) {
			
			if ( $FEDERAL_NVESTIGATIV == 'Yes' ) {
			
				$US_LAW_ENFORCE_STATU 		= get_cimyFieldValue($user_id, 'US_LAW_ENFORCE_STATU');

				if ( !empty( $US_LAW_ENFORCE_STATU ) ) {

					if ( $US_LAW_ENFORCE_STATU == 'OTHER' ) {
						$US_LAW_ENFORCE_OTHER 		= get_cimyFieldValue($user_id, 'US_LAW_ENFORCE_OTHER');
						if ( !empty( $US_LAW_ENFORCE_OTHER ) ) {
							$US_LAW_ENFORCE_STATU = $US_LAW_ENFORCE_STATU.' ( '.$US_LAW_ENFORCE_OTHER. ' ) ';
						}
						else{

							$US_LAW_ENFORCE_STATU = $US_LAW_ENFORCE_STATU;
						}

					}
				}
				else{
					$US_LAW_ENFORCE_STATU = 'none';
				}

				$FEDERAL_NVESTIGATIV = $US_LAW_ENFORCE_STATU;
			}
			else{
				$FEDERAL_NVESTIGATIV = $FEDERAL_NVESTIGATIV;
			}
		}
		else{
			 $FEDERAL_NVESTIGATIV = 'none';
		}

		$MAJOR_METROPOLITAN 		= get_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN');

		if ( !empty( $MAJOR_METROPOLITAN ) ) {
			$MAJOR_METROPOLITAN_O 		= get_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN_O');
			if ( !empty( $MAJOR_METROPOLITAN_O ) ) {
				$MAJOR_METROPOLITAN = $MAJOR_METROPOLITAN.' ( '.$MAJOR_METROPOLITAN_O.' ) ';
			}
			else{
				$MAJOR_METROPOLITAN = $MAJOR_METROPOLITAN;
			}
		}
		else{

			$MAJOR_METROPOLITAN = 'none';
		}

		$CURRENT_RESUME 		= get_cimyFieldValue($user_id, 'CURRENT_RESUME');
		$CURRENT_RESUME 		= ( !empty( $CURRENT_RESUME ) ) ? '<a href="'.$CURRENT_RESUME.'">Resume</a>' : 'none';

		
		$rfname = get_user_meta($user_id, 'rfname');
		$rfemail =  get_user_meta($user_id, 'rfemail');
		
		if( !empty( $rfname ) && isset( $rfname[0] ) ) {

			$rfname_arr = $rfname[0];
			$rfemail_arr = $rfemail[0];

			$emp_rfname = array_filter($rfname_arr );
			$emp_rfemail = array_filter($rfemail_arr );
			
			if ( !empty($emp_rfname) || !empty($emp_rfemail) ) {


				$count_rf = count($rfname_arr);

				for ($i=0; $i < $count_rf; $i++) { 
					
					if ( !empty($rfname_arr[$i]) && !empty($rfemail_arr[$i]) ) {
						$rfc_arr[] = $rfname_arr[$i].' ( '. $rfemail_arr[$i] .' )';
					}
				}

				$rfc = implode( '<br>', $rfc_arr);

			}
			else{
				$rfc = 'none';
			}
		}
		else{
			$rfc = 'none';
		}

		$view_profile =  site_url('/wp-admin/admin.php?page=eyerecruit_user_profile&user='.$user_id);

		$approve = site_url('/wp-admin/users.php?page=new-user-approve-admin&user='.$user_id.'&status=approve&_wpnonce=5a32097b5a');

		$reject = site_url('/wp-admin/users.php?page=new-user-approve-admin&user='.$user_id.'&status=deny&_wpnonce=5a32097b5a');
		
		$pro_message = 

		'<table style="border-top: 1px solid #cccccc; border-left: 1px solid #cccccc;" border="0" width="100%" cellspacing="0" cellpadding="10" align="center" data-mce-style="border-top: 1px solid #cccccc; border-left: 1px solid #cccccc;" class="mce-item-table" data-mce-selected="1">
			<tbody>
				
				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Name
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$name.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Email
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						<a href="mailto:'.$email.'">'.$email.'</a>
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Agree to respond to the questions
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$AGREE_TO_RESPOND.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Currently actively or passively looking for a job or career change
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$SYSTEM_AND_PROCE.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Industry that best reflects your work experience
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$BEST_INDUSTRY.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Highest level of education
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$HIGHEST_EDUCATION.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Type of opportunity
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$TYPE_OF_OPPORTUNITY.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Desired Working Radius
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$JOB_SEARCH_RADIUS.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Eligible and legally authorized to work in the United States
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$US_ELIGIBLE.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Security Clearance
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$SECURITY_CLEAR_YN.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						18 Years of age or older
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$OVER_18_YN.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Possess a valid State issued Drivers License
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$POSSES_DRIVER_LICENS.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						State issued
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$DRIVER_STATE.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Reliable transportation for local travel
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$RELIABLE_TRANSPORT.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Currently licensed in the field of Investigation or Security
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$FIELD_LICENSE_STATUS.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						From which State(s)
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$FIELD_LICENSE_STATE.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Languages and proficiency level
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$LANGUAGES_SPOKEN.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Current employment situation
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$CUR_WORK_SITUATION.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Active or Retired United States Armed Forces
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$US_ARMED_FORCES.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Active State of Local Law Enforcement
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$LOCAL_LAW_FORCE_YN.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Employed by a Federal Investigative or Law Enforcement Agency
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$FEDERAL_NVESTIGATIV.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Closest major metropolitan city 
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$MAJOR_METROPOLITAN.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Resume
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$CURRENT_RESUME.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Recommend Friends & Colleagues
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						'.$rfc.'
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						View Profile
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						<a href="'.$view_profile.'">View Profile</a>
					</td>
				</tr>

				<tr>
					<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						Action
					</th>
					<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
						<a href="'.$approve.'">Accept</a> OR <a href="'.$reject.'">Reject</a>
					</td>
				</tr>
			</tbody>
		</table>';

		/*$get_option_arr 			= get_option('jobseeker_profile_builder');
		$subject 					= $get_option_arr['jobseekerprofilebuilder_subject'];
		$setting_options 			= get_option('xtreem_options_smtp');
		$to 				= $setting_options['tomail'];

		$shordcode_to_rep 	= array('[site-url]','[jobseeker_first_name]','[jobseeker_last_name]','[jobseeker]');
		$replace_with 		= array(site_url(),$userdata->first_name,$userdata->last_name,$pro_message );
		$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['jobseekerprofilebuilder_mail_template']);
				
		$headers = "MIME-Version: 1.0" . "\r\n";
    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		wp_mail($to, $subject, $message, $headers);
    	*/


		/*$wpdb->update( 
			$wpdb->prefix.'users', 
			array( 
				'user_pass' => md5( $new_pass ), 
				'user_activation_key' => '' 
			), 
			array('ID' => $user_id), 
			array( '%s', '%s'), 
			array( '%d' ) 
		);*/

	/*	update_user_meta( $user_id, 'pw_user_approve_password_reset', time() );

		$admin_approval_array = get_option('admin_approval');
        if ( isset( $admin_approval_array['adminapprove_subject'] ) ) {
            $subject =  $admin_approval_array['adminapprove_subject'];
        }
        else{
			$subject = 'Registration Approved';
        }

        $userName = $userdata->first_name.' '.$userdata->last_name;

        $message = 'You have been approved to access Eye Recruit<br> Username: <a href="mailto:'.$user_email.'" target="_blank">'.$user_email.'</a><br> Password: '.$new_pass.'<br> <a href="'.site_url("/login/").'" target="_blank">Click here to login</a>';
        if ( isset( $admin_approval_array['adminapprove_mail_template'] ) ) {
            $mal_temp =  $admin_approval_array['adminapprove_mail_template'];
            $shortcode_arry = array('[user_name]', '[registration_approved_msg]');
            $repl_shortcode_arry = array($userName, $message);
            $message = str_replace($shortcode_arry, $repl_shortcode_arry, $mal_temp);
        }
        else{
            $message = '';
        }

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		wp_mail( $user_email, $subject, $message, $headers );
		update_user_meta( $userdata->ID, 'pw_user_status', 'approved' );*/


		/*$new_pass = wp_generate_password( 12, false );

		wp_set_password($new_pass, $user_id) ;*/
		
		update_user_meta($user_id, 'pw_user_status', 'approved');
		wp_set_current_user($user_id, $userdata->user_login);
		wp_set_auth_cookie($user_id);
		do_action('wp_login', $userdata->user_login);

		echo "mail send";
	}

	die();
}





add_action('wp_ajax_cvf_upload_files', 'cvf_upload_files');
add_action('wp_ajax_nopriv_cvf_upload_files', 'cvf_upload_files'); // Allow front-end submission

function cvf_upload_files(){

	if ( isset($_POST['user_id']) && !empty($_POST['user_id']) ) {
		
		$user_id = multi_base64_decode($_POST['user_id']);
	}
	else{
		die();
	}

	$user = get_userdata($user_id);
    global $wpdb;
    $valid_formats = array("pdf", "jpg", "jpeg", "png");
    $max_file_size = 2000000;
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['basedir'].'/resume/';
    if (!file_exists( $path.date('Y/m/d') ) ) {
	    mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    	foreach ( $_FILES['files']['name'] as $f => $name ) {
    		$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
		    if ( $_FILES['files']['error'][$f] == 0 ) {
		        if ( $_FILES['files']['size'][$f] > $max_file_size ) {
		            $upload_message[] = 'File size is too large!';
		            continue;
		        } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
		            $upload_message[] = 'Allow only pdf, jpg, jpeg and png format.';
		            continue;
		        } 
		        else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
					    $actual_name = $original_name.$i;
				    	$name = $actual_name.".".$extension;
					    $i++;
					}
    				$basename = basename($name);
			        if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
			            $filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
			            $file = '/resume/'.date('Y/m/d').'/'.$basename;
			        	$wpdb->insert(
			        		$wpdb->prefix.'jobseeker_resume',
			        		array(
			        			'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'resume'
			        		),
			        		array('%d','%s','%s','%s','%s', '%s', '%s')
			        	);
			        	set_cimyFieldValue($user_id, 'CURRENT_RESUME', $filefullpath);

						$candidate_name = $user->first_name.' '.$user->last_name;

						$reargs = array(
							'author__in' => array($user_id),
							'post_type'   => 'resume',
							'post_status' => 'publish'
						);

						$the_query = new WP_Query( $reargs );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								update_post_meta(get_the_ID(), '_resume_file', $filefullpath);
								update_post_meta(get_the_ID(), '_candidate_name', $candidate_name);
							}
							wp_reset_postdata();
						} else {
				        	$data = array(
								'post_title'     => $candidate_name,
								'post_type'      => 'resume',
								'comment_status' => 'closed',
								'post_password'  => '',
								'post_author'    => $user_id,
								'post_status' => 'publish'
							);

							$resume_id = wp_insert_post( $data );
							update_post_meta($resume_id, '_resume_file', $filefullpath);
							update_post_meta($resume_id, '_candidate_name', $candidate_name);
						}
			        	$upload_message[] = '<p class="success">Successfully added.</p>';
			        }
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){       
            printf( __('%s'), $msg );
        }
    endif;
    die();
}

// Random code generator used for file names.
function cvf_td_generate_random_code($length=10) {
 
   $string = '';
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
 
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 
}


/*..........send_mail_to_fr-Ajax Action.................*/

add_action('wp_ajax_send_mail_to_fr', 'send_mail_to_fr');
add_action('wp_ajax_nopriv_send_mail_to_fr', 'send_mail_to_fr');

function send_mail_to_fr(){
	if ( isset($_POST['femail']) && !empty($_POST['femail']) ) {
		
		$fname_Arr = $_POST['fname'];
		$femail_Arr = $_POST['femail'];

		$count = count($femail_Arr);

		$recommend_friends_mail = get_option('recommend_friends_mail');


		if ( isset( $recommend_friends_mail['recommend_friends_mail_template'] ) && !empty( $recommend_friends_mail['recommend_friends_mail_template'] ) ){
		 	$message =  $recommend_friends_mail['recommend_friends_mail_template']; 
		}
		else{
		 	$message ='Test';
		}


		if ( isset( $recommend_friends_mail['recommend_friends_subject'] ) && !empty( $recommend_friends_mail['recommend_friends_subject'] ) ){
		 	$subject =  $recommend_friends_mail['recommend_friends_subject'];
		}
		else{
		 	$subject ='Eye Recruit';
		} 

		$headers = "MIME-Version: 1.0" . "\r\n";
    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		

		for ($i=0; $i <= $count; $i++) { 

			$fname = $fname_Arr[$i];
			$femail = $femail_Arr[$i];

			$message = str_replace('[name]', $fname, $message); 


			if ( ( !empty( $femail ) ) && ( !filter_var($femail, FILTER_VALIDATE_EMAIL) === false ) ) {
				wp_mail( $femail, $subject, $message, $headers);
			}
		}

		die();
	}
	die();
}


function multi_base64_encode($value){
	return base64_encode( base64_encode( base64_encode($value) ) );
}

function multi_base64_decode($value){
	return base64_decode( base64_decode( base64_decode($value) ) );
}



/*........Job search field...............*/


add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_salary_field' );
function filter_by_salary_field() { ?>
   	<div style="display:none;">
   		<div class="countrycityfieldappend">

		    <div class="col-sm-3">
		        <div class="form-group has-feedback countryfieldappend">
		            <?php 
		            global $wpdb;
		            $counTable = $wpdb->prefix.'country';
		            $selectCoun = $wpdb->get_results("SELECT * FROM $counTable ORDER BY order_by DESC");
		            $job_country = $_GET['job_country'];
		            ?>
		            <select class="form-control selectpicker custom-job-manager-filter" name="job_country" id="job_country" data-live-search="true">
		              <option value="">Select your country</option>
	              		<!-- <option value="all">Select all</option> -->
		               <?php foreach ($selectCoun as $value) { ?>
		                    <option value="<?php echo $value->countryId; ?>" ><?php echo ucfirst($value->name); ?></option>
		                <?php } ?>
		            </select>
		        	<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
		        </div>
		    </div>

		    <div class="col-sm-3">
		        <div class="form-group has-feedback">
		            <select class="form-control selectpicker custom-job-manager-filter" name="job_state" id="job_state" data-live-search="true">
		             	<option value=""> Select your state</option>
				        <?php
			        	if ( isset($_REQUEST['job_country']) && !empty($_REQUEST['job_country']) ) {
							$job_country_id = $_REQUEST['job_country'];
							$stateTable = $wpdb->prefix.'region';
							$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = '".$job_country_id."' ORDER BY name ASC");
		              		//echo '<option value="all">Select all</option>';
							foreach ($selectState as $value) { ?>
		                    	<option value="<?php echo $value->regionId; ?>" ><?php echo ucfirst($value->name); ?></option> <?php 
			                } 
						}
				        ?>
		            </select>
		        	<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
		        </div>
		    </div>
		    <div class="col-sm-3">
		        <div class="form-group has-feedback">
		            <select class="form-control selectpicker custom-job-manager-filter" name="job_city" id="job_city" data-live-search="true">
		              <option value=""> Select your city</option>
		               <?php
			        	if ( isset($_REQUEST['job_state']) && !empty($_REQUEST['job_state']) ) {
							$job_state_id = $_REQUEST['job_state'];
							$cityTable = $wpdb->prefix.'cities';
							$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = '".$job_state_id."' ORDER BY name ASC");
		              		//echo '<option value="all">Select all</option>';
							foreach ($selectCity as $value) { ?>
		                    	<option value="<?php echo $value->cityId; ?>" ><?php echo ucfirst($value->name); ?></option> <?php 
			                } 
						}
				        ?>
		            </select>
		        	<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
		        </div>
		    </div>
		</div>

		<input type="hidden" class="des_filter" name="job_distance" value="<?php echo $_GET['job_distance']; ?>">
		
		<ul class="quick_links_cat">
	    <?php
			$args = array(
				'hide_empty' => false,
			    'taxonomy' => 'job_listing_category',
			    'orderby'  => 'ID'
			);
			foreach (get_categories( $args ) as $key ) { ?>
				<li id="<?php echo $key->slug; ?>"><div class="checkbox"><label><input type="checkbox" name="filter_category[]" value="<?php echo $key->term_id; ?>" class="custom-job-manager-filter" ><span><?php echo $key->name; ?></span></label></div></li>
		   <?php } ?>
	    </ul>

	    <ul class="quick_links_listing_type by_type">
	    <?php
			$args = array(
				'hide_empty' => false,
			    'taxonomy' => 'job_listing_type',
			    'orderby'  => 'ID'
			);
			foreach (get_categories( $args ) as $key ) { ?>
				<li id="<?php echo $key->slug; ?>"><div class="checkbox"><label><input type="checkbox" name="job_listing_type[]" value="<?php echo $key->term_id; ?>" class="custom-job-manager-filter" ><span><?php echo $key->name; ?><i class="job-type <?php echo $key->slug; ?>"></i></span></label></div></li>
		   <?php } ?>
	    </ul>

	    <ul class="quick_link_compa">
	  	<?php 
	  	
	  	$comArr = array('under40k' => 'Under $40,000', '40k-50k' => '$40,000 - $50,000', '50k-60k' => '$50,000 - $60,000', '60k-70k' => '$60,000 - $70,000', '70k-80k' => '$70,000 - $80,000', '80k-90k' => '$80,000 - $90,000', '90k-100k' => '$90,000 - $100,000', '100k-125k' => '$100,000 - $125,000', '125k-150k' => '$125,000 - $150,000', '150k-250k' => '$150,000 - $250,000', 'over500k' => 'Over $500,000 annually');
	  	foreach ($comArr as $key => $value ) { ?>
			<li id="<?php echo $key->slug; ?>"><div class="checkbox"><label><input type="checkbox" name="filter_by_compan_type[]" value="<?php echo $key; ?>" class="custom-job-manager-filter" ><span><?php echo $value; ?></span></label></div></li>
	   <?php 
	   
	  
	   } ?>
	   </ul>

	   <ul class="quick_link_distance">
	  	<?php 
     
	  	$comArr = array('5' => 'within 5 miles', '10' => 'within 10 miles', '20' => 'within 20 miles', '30' => 'within 30 miles', '40'=>'within 40 miles','50'=>'within 50 miles','75'=>'within 75 miles','100'=>'within 100 miles');
	      $numCount= count($comArr);

	  	foreach ($comArr as $key => $value ) { ?>
			<li id="<?php echo $key->slug; ?>"><div class="checkbox"><label><input type="checkbox" name="filter_by_job_distance[]" value="<?php echo $key; ?>" class="custom-job-manager-filter" ><span><?php echo $value; ?></span></label></div></li>
	   <?php 
	   } ?>
	   </ul>


   </div>
   <script type="text/javascript">
		   	//distance
		jQuery('ul.quick_link_distance').each(function(){
		  var LiN = jQuery(this).find('li').length;
		  if( LiN > 4){    
		    jQuery('li', this).eq(3).nextAll().hide().addClass('toggleable');
		    jQuery(this).append('<a class="more">More...</a>');    
		  }
		});
		jQuery('ul.quick_link_distance').on('click','.more', function(){
		  if( jQuery(this).hasClass('less') ){    
		    jQuery(this).text('More...').removeClass('less');    
		  }else{
		    jQuery(this).text('Less...').addClass('less'); 
		  }
		  jQuery(this).siblings('li.toggleable').slideToggle();
		}); 
       //category
		jQuery('ul.quick_links_cat').each(function(){
		  var LiN = jQuery(this).find('li').length;
		  if( LiN > 7){    
		    jQuery('li', this).eq(6).nextAll().hide().addClass('toggleable');
		    jQuery(this).append('<a class="more">More...</a>');    
		  }
		});
		jQuery('ul.quick_links_cat').on('click','.more', function(){
		  if( jQuery(this).hasClass('less') ){    
		    jQuery(this).text('More...').removeClass('less');    
		  }else{
		    jQuery(this).text('Less...').addClass('less'); 
		  }
		  jQuery(this).siblings('li.toggleable').slideToggle();
		}); 
		//job type
		jQuery('ul.quick_links_listing_type').each(function(){
		  var LiN = jQuery(this).find('li').length;
		  if( LiN > 2){    
		    jQuery('li', this).eq(1).nextAll().hide().addClass('toggleable');
		    jQuery(this).append('<a class="more">More...</a>');    
		  }
		});
		jQuery('ul.quick_links_listing_type').on('click','.more', function(){
		  if( jQuery(this).hasClass('less') ){    
		    jQuery(this).text('More...').removeClass('less');    
		  }else{
		    jQuery(this).text('Less...').addClass('less'); 
		  }
		  jQuery(this).siblings('li.toggleable').slideToggle();
		}); 
		//compensation
		jQuery('ul.quick_link_compa').each(function(){
		  var LiN = jQuery(this).find('li').length;
		  if( LiN > 5){    
		    jQuery('li', this).eq(4).nextAll().hide().addClass('toggleable');
		    jQuery(this).append('<a class="more">More...</a>');    
		  }
		});
		jQuery('ul.quick_link_compa').on('click','.more', function(){
		  if( jQuery(this).hasClass('less') ){    
		    jQuery(this).text('More...').removeClass('less');    
		  }else{
		    jQuery(this).text('Less...').addClass('less'); 
		  }
		  jQuery(this).siblings('li.toggleable').slideToggle();
		}); 
   </script>
	<script type="text/javascript">
		jQuery(document).ready( function() {

			var filter_category = '<?php echo $_GET["filter_category"]; ?>';
			jQuery('input[value="'+filter_category+'"]').click();

			var job_listing_type = '<?php echo $_GET["job_listing_type"]; ?>';
			jQuery('input[value="'+job_listing_type+'"]').click();
			

			var job_country = '<?php echo $_GET["job_country"]; ?>';
			jQuery('select[name="job_country"] option[value="'+job_country+'"]').attr('selected', 'selected');
			jQuery('select[name="job_country"] option[value="'+job_country+'"]').click();

			var job_state = '<?php echo $_GET["job_state"]; ?>';
			jQuery('select[name="job_state"] option[value="'+job_state+'"]').attr('selected', 'selected');
			jQuery('select[name="job_state"] option[value="'+job_state+'"]').click();

			var job_city = '<?php echo $_GET["job_city"]; ?>';
			jQuery('select[name="job_city"] option[value="'+job_city+'"]').attr('selected', 'selected');
			jQuery('select[name="job_city"] option[value="'+job_city+'"]').click();

			jQuery('.quick_links_cat').insertAfter('#quickCategory');
			jQuery('.quick_links_listing_type').insertAfter('#quickListingtype');
			jQuery('.quick_link_compa').insertAfter('#quickCompansation');
			jQuery('.quick_link_distance').insertAfter('#quickjobDistance');

			jQuery('ul #contract-short').insertAfter('#full-time');
			jQuery('ul #contract-long').insertAfter('#full-time');
			jQuery('ul #part-time').insertAfter('#full-time');
		});
		var wloc = window.location.href; 
		var par = wloc.split('?');
		history.replaceState("", "", par[0]);
	</script>
   <?php
}

/**
 * This code gets your posted field and modifies the job search query
 */
add_filter( 'job_manager_get_listings', 'filter_by_salary_field_query_args', 10, 2 );
function filter_by_salary_field_query_args( $query_args, $args ) {
    if ( isset( $_POST['form_data'] ) ) {
        parse_str( $_POST['form_data'], $form_data );
        // If this is set, we are filtering by salary

	    if ( ! empty( $form_data['search_regionx'] ) ) {
	        $query_args['tax_query'][] = array(
				'taxonomy' => 'job_listing_region',
				'field'    => 'term_id',
				'terms'    => $form_data['search_regionx'],
				'operator' => 'IN',
			);
	    }

	    if ( ! empty( $form_data['filter_category'] ) ) {
	        $query_args['tax_query'][] = array(
				'taxonomy' => 'job_listing_category',
				'field'    => 'term_id',
				'terms'    => $form_data['filter_category'],
				'operator' => 'IN',
			);
	    }

	    if ( ! empty( $form_data['job_listing_type'] ) ) {
	        $query_args['tax_query'][] = array(
				'taxonomy' => 'job_listing_type',
				'field'    => 'term_id',
				'terms'    => $form_data['job_listing_type'],
				'operator' => 'IN',
			);
	    }


	    if ( ! empty( $form_data['job_distance'] ) ) {
			$selected_range = sanitize_text_field( $form_data['job_distance'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_distance',
				'value'    => $selected_range,
				'compare' => '=',
			);
		}

		if ( (!empty($form_data['job_country'])) && ($form_data['job_country'] != 'all') ) {
			$selected_country = sanitize_text_field( $form_data['job_country'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_country',
				'value'    => $selected_country,
				'compare' => '=',
			);
		}

		if ( (!empty( $form_data['job_state'])) && ($form_data['job_state'] != 'all') ) {
			$selected_state = sanitize_text_field( $form_data['job_state'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_state',
				'value'    => $selected_state,
				'compare' => '=',
			);
		}


	    if ( (!empty( $form_data['job_city'])) && ($form_data['job_city'] != 'all') ) {
			$selected_city = sanitize_text_field( $form_data['job_city'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_city',
				'value'    => $selected_city,
				'compare' => '=',
			);
		}

		  if ( (!empty( $form_data['job_postcode'])) ) {
			$job_postcode = sanitize_text_field( $form_data['job_postcode'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_postcode',
				'value'    => $job_postcode,
				'compare' => '=',
			);
		}

	    if ( ! empty( $form_data['filter_by_compan_type'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_compan_type'] );
			$query_args['meta_query'][] = array(
				'key' => '_job_pay_yearly',
				'value'    => $form_data['filter_by_compan_type'],
				'compare' => 'IN',
			);
		}

		if ( ! empty( $form_data['filter_by_job_distance'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_job_distance'] );
			//print_r($form_data['filter_by_job_distance']); die;
			/*if (in_array("100", $form_data['filter_by_job_distance'])) {

				$datas = array('0' => 5,'1' => 10,'2' => 20 ,'3' => 30,'4'=> 40 ,'5' => 50 ,'6' => 75 ,'7' => 100);
			}elseif(in_array("75", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10,'2' => 20 ,'3' => 30,'4'=> 40 ,'5' => 50 ,'6' => 75);

			}
			elseif(in_array("50", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10,'2' => 20 ,'3' => 30,'4'=> 40 ,'5' => 50);

			}
			elseif(in_array("40", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10,'2' => 20 ,'3' => 30,'4'=> 40);

			}
			elseif(in_array("30", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10,'2' => 20 ,'3' => 30);

			}
			elseif(in_array("20", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10,'2' => 20);

			}
			elseif(in_array("10", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5,'1' => 10);

			}
			elseif(in_array("5", $form_data['filter_by_job_distance'])){

				$datas = array('0' => 5);

			}else{

				$datas = $form_data['filter_by_job_distance'];
			}*/
			
			$query_args['meta_query'][] = array(
				'key' => '_job_distance',
				'value'    => $form_data['filter_by_job_distance'],
				'compare' => 'IN',
			);
		}

		add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
    }
    return $query_args;
}


add_action('pmpro_membership_level_after_other_settings', 'add_customfield_pmp');
function add_customfield_pmp(){ 
	
	wp_enqueue_script('jquery');
	wp_enqueue_media();

	global $wpdb;
	$table_prefix = $wpdb->prefix.'pmpro_membership_levelmeta';
	?>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row" valign="top"><label for="confirmation">Image:</label></th>
				<td>
					<?php $levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$_GET['edit']."' AND meta_key = 'plan_image' " ); ?>
					<input type="text" name="image_url" id="image_url" class="regular-text" value="<?php echo $levelmeta->meta_value; ?>">
    				<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
				</td>
			</tr>

			<tr>
				<th scope="row" valign="top"><label for="confirmation">Other Description:</label></th>
				<td>
					<?php 
					$editor_arg = array('textarea_rows' => 5);
					$levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$_GET['edit']."' AND meta_key = 'other_desc' " );
					wp_editor( $levelmeta->meta_value, 'description_sidebar', $editor_arg); 
					?>
				</td>
			</tr> 

			<tr>
				<th scope="row" valign="top"><label for="confirmation">Level Type:</label></th>
				<td>
					<?php 
					$leveltypemeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$_GET['edit']."' AND meta_key = 'selectusertype' " );
					$lt = $leveltypemeta->meta_value; 
					?>
					<select name="selectusertype" id="selectusertype">
						<option value="">Select Level Type</option>
						<option value="employer" <?php echo ($lt == 'employer')? 'selected' : ''; ?> >Employer</option>
						<option value="candidate" <?php echo ($lt == 'candidate')? 'selected' : ''; ?> >Candidate</option>
					</select>
				
				</td>
			</tr> 

			<tr>
				<th scope="row" valign="top"><label for="confirmation">Other text after price</label></th>
				<td>
					<?php 
					global $wpdb;
					$levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$_GET['edit']."' AND meta_key = 'other_text_after_price' " );
					?>
					<textarea name="other_text_after_price" rows="5" cols="105"><?php echo $levelmeta->meta_value; ?></textarea>
				
				</td>
			</tr> 
		</tbody>
	</table>
	<script type="text/javascript">
	jQuery(document).ready(function($){
	    $('#upload-btn').click(function(e) {
	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Upload Image',
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            var uploaded_image = image.state().get('selection').first();
	            var image_url = uploaded_image.toJSON().url;
	            $('#image_url').val(image_url);
	        });
	    });
	});
	</script>
	<?php
} 



add_action('pmpro_save_membership_level', 'save_customfield_pmpro');
function save_customfield_pmpro($saveid){
	global $wpdb;
	$table_prefix = $wpdb->prefix.'pmpro_membership_levelmeta';
	$levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$saveid."' AND meta_key = 'plan_image' " );
	if (empty($levelmeta)) {
		$wpdb->insert(
			$table_prefix,
			array(
				'pmpro_membership_level_id' => $saveid,
				'meta_key' => 'plan_image',
				'meta_value' => $_POST['image_url']
			),
			array(
				'%d','%s','%s'
			)
		);
	}
	else{
	    $wpdb->query("UPDATE $table_prefix SET meta_value = '".$_POST['image_url']."' WHERE meta_key = 'plan_image' AND pmpro_membership_level_id = '".$saveid."' ");
	}



	$levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$saveid."' AND meta_key = 'other_desc' " );
	if (empty($levelmeta)) {
		$wpdb->insert(
			$table_prefix,
			array(
				'pmpro_membership_level_id' => $saveid,
				'meta_key' => 'other_desc',
				'meta_value' => $_POST['description_sidebar']
			),
			array(
				'%d','%s','%s'
			)
		);
	}
	else{
	    $wpdb->query("UPDATE $table_prefix SET meta_value = '".$_POST['description_sidebar']."' WHERE meta_key = 'other_desc' AND pmpro_membership_level_id = '".$saveid."' ");
	}

	$leveltypemeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$saveid."' AND meta_key = 'selectusertype' " );
	if (empty($leveltypemeta)) {
		$wpdb->insert(
			$table_prefix,
			array(
				'pmpro_membership_level_id' => $saveid,
				'meta_key' => 'selectusertype',
				'meta_value' => $_POST['selectusertype']
			),
			array(
				'%d','%s','%s'
			)
		);
	}
	else{
	    $wpdb->query("UPDATE $table_prefix SET meta_value = '".$_POST['selectusertype']."' WHERE meta_key = 'selectusertype' AND pmpro_membership_level_id = '".$saveid."' ");
	}


	$levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$saveid."' AND meta_key = 'other_text_after_price' " );
	if (empty($levelmeta)) {
		$wpdb->insert(
			$table_prefix,
			array(
				'pmpro_membership_level_id' => $saveid,
				'meta_key' => 'other_text_after_price',
				'meta_value' => $_POST['other_text_after_price']
			),
			array(
				'%d','%s','%s'
			)
		);
	}
	else{
	    $wpdb->query("UPDATE $table_prefix SET meta_value = '".$_POST['other_text_after_price']."' WHERE meta_key = 'other_text_after_price' AND pmpro_membership_level_id = '".$saveid."' ");
	}
}



function job_seeker_profile_com_status($user_id){
	global $wpdb;
	$profileBasicQTotal		= 0;
	$profileBasicQAnswered	= 0;
	$totalper 				= 0;
	//$values = get_cimyFieldValue($user_id, false);
	$values = array('SYSTEM_AND_PROCE', 'BEST_INDUSTRY', 'CLEARANCE_LEVEL', 'CLEARANCE_STATUS', 'HIGHEST_EDUCATION', 'TYPE_OF_OPPORTUNITY', 'JOB_SEARCH_RADIUS', 'US_ELIGIBLE', 'SECURITY_CLEAR_YN', 'OVER_18_YN', 'POSSES_DRIVER_LICENS', 'DRIVER_STATE', 'RELIABLE_TRANSPORT', 'CURR_EMPLOYED_YN', 'NAME_OF_COMP', 'WORK_DATE_AVAILABLE', 'INDUSTRY_YEARS', 'CURR_CAREER_LVL', 'REF_SRC', 'RELOCATION_YN', 'COMPENSATION_ACC', 'COMPENSATION_CURRENT', 'COMP_DESIRED_ACC', 'COMPENSATION_DESIRED', 'FIELD_LICENSE_STATUS', 'LANGUAGES_WRITTEN', 'CUR_WORK_SITUATION', 'US_ARMED_FORCES', 'LOCAL_LAW_FORCE_YN', 'FEDERAL_NVESTIGATIV', 'MAJOR_METROPOLITAN', 'SEEKER_ZIP_CODE');
	$i=0;
	foreach ($values as $value) { 
		$profileBasicQTotal++;
		$cimyFieldValue = get_cimyFieldValue($user_id, $value);
		if( !empty($cimyFieldValue) ){
			$profileBasicQAnswered++;
		}
	}
	$lisLArr = array('mandarin' => 'Mandarin','vietnamese' => 'Vietnamese','english' => 'English','javanese' => 'Javanese','spanish' => 'Spanish','tamil' => 'Tamil','hindi' => 'Hindi','Korean' => 'Korean','russian' => 'Russian','turkish' => 'Turkish','arabic' => 'Arabic','telugu' => 'Telugu','portuguese' => 'Portuguese','marathi' => 'Marathi','bengali' => 'Bengali','italian' => 'Italian','french' => 'French','thai' => 'Thai','malay' => 'Malay, Indonesian','burmese' => 'Burmese','german' => 'German','cantonese' => 'Cantonese','japanese' => 'Japanese','kannada' => 'Kannada','farsi' => 'Farsi (Persian)','gujarati' => 'Gujarati','urdu' => 'Urdu','polish' => 'Polish','punjabi' => 'Punjabi','wu' => 'Wu','other' => 'OTHER');
	$profileBasicQTotal++;
	foreach ($lisLArr as $key => $value) { 
		$fVal = get_user_meta($user_id, 'list_languages_'.$key, true);
		if ( !empty($fVal) ) {
			$profileBasicQAnswered++;
			break;
		}	
	}

	/*....................................Contact Form Values...........................*/
	$conarr = array('first_name','last_name','sec_email','cell_phone','usercustom_curr');
	foreach ($conarr as $values) {
	$profileBasicQTotal++; 
		$fVall = get_user_meta($user_id, $values, true);
		if ( !empty($fVall) ) {
			$profileBasicQAnswered++;
		}	
	}

	$data = get_userdata($user_id);
    $data->user_email;
    $profileBasicQTotal++;
    if(!empty($data)){
     $profileBasicQAnswered++;
    }

    /*..................................Check Avtar........................................*/
    $avtar = get_avatar($user_id);
    $profileBasicQTotal++;
    if(!empty($avtar)){
      $profileBasicQAnswered++;
    }

    /*....................Navigation value Check.....................................*/
    $navarr = array('background_doc','resume','honors','education','cover_letters','license','certificate');
    foreach ($navarr as $value) {
      $profileBasicQTotal++;
      $result= $wpdb->get_row("SELECT * FROM eyecuwp_jobseeker_resume WHERE user_id='".$user_id."' AND docType='".$value."' LIMIT 1 ");
      if ( !empty($result->docType) ) {
        $profileBasicQAnswered++;
      }
    }


    /*....................Self Assesment.....................................*/

    $now = time();
    $selfarr = array('abilities-assessment','knowledge-assessment','technology-assessment','skills-assessment','work-activities-assessment','tasks-assessment');
    foreach ($selfarr as $value) {
    	$profileBasicQTotal++;
		$abilities = get_user_meta($user_id, $value, true); 
		
		$abilitiesdatediff = $now - $abilities;
		$abilitiesdayes = floor( $abilitiesdatediff / (60 * 60 * 24) );
		if ( (!empty($abilities)) && ($abilitiesdayes <= 90) ) {
			$profileBasicQAnswered++;
		}
    }

    
	$reargs = array(
		'author__in' => array($user_id),
		'post_type'   => 'resume',
		'post_status' => 'publish'
	);
	$profileBasicQTotal++;
	$the_query = new WP_Query( $reargs );
	if ( $the_query->have_posts() ) {
		$profileBasicQAnswered++;
	}
  
	$totalper =  floor(($profileBasicQAnswered/$profileBasicQTotal)*100);
	return $totalper;
}


add_action('wp_ajax_my_network_follow_up_msg', 'my_network_follow_up_msg');
add_action('wp_ajax_nopriv_my_network_follow_up_msg', 'my_network_follow_up_msg');

function my_network_follow_up_msg(){
	if ( isset($_POST['user_emailadd']) ) {
		$current_user_id = get_current_user_id();
		$userdata = get_userdata($current_user_id);
		$sender_name = $userdata->first_name.' '.$userdata->last_name;

		$get_option_arr 	= get_option('follow_up');
		$subject 			= $get_option_arr['follow_up_subject'];
		$to 				= $_POST['user_emailadd'];
		
		$shordcode_to_rep 	= array('[site-url]','[name]','[sender_name]');
		$replace_with 		= array(site_url(),$_POST['user_nme'], $sender_name);
		
		$headers = "MIME-Version: 1.0" . "\r\n";
    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['follow_up_template']);
		
		echo wp_mail($to, $subject, $message, $headers);
	}
	die();
}


add_action('wp_ajax_my_network_msg_now', 'my_network_msg_now');
add_action('wp_ajax_nopriv_my_network_msg_now', 'my_network_msg_now');

function my_network_msg_now(){
	if ( isset($_POST['user_id']) ) {

		$current_user_id = get_current_user_id();
		$userdata = get_userdata($current_user_id);
		$sender_name = $userdata->first_name.' '.$userdata->last_name;

		$user_id = $_POST['user_id'];
		$fuserdata = get_userdata($user_id);
		$fname = $fuserdata->first_name;
		$phone_no = get_user_meta($user_id, 'cell_phone', true);
		$join_link = site_url().'/job-seekers/get-started/';

		$get_option_arr 	= get_option('message_now');
		$subject 			= $get_option_arr['message_now_subject'];
		$to 				= $fuserdata->user_email;
		
		$shordcode_to_rep 	= array('[site-url]','[name]','[sender_name]','[phone_no]','[join_link]');
		$replace_with 		= array(site_url(),$fname, $sender_name, $phone_no, $join_link);
		
		$headers = "MIME-Version: 1.0" . "\r\n";
    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['message_now_template']);
		
		echo wp_mail($to, $subject, $message, $headers);
	}
	die();
}
?>