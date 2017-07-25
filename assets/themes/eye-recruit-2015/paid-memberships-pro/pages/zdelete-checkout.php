<?php
  global $gateway, $pmpro_review, $skip_account_fields, $pmpro_paypal_token, $wpdb, $current_user, $pmpro_msg, $pmpro_msgt, $pmpro_requirebilling, $pmpro_level, $pmpro_levels, $tospage, $pmpro_show_discount_code, $pmpro_error_fields;
  global $pmpro_currency_symbol, $discount_code, $username, $password, $password2, $bfirstname, $blastname, $baddress1, $baddress2, $bcity, $bstate, $bzipcode, $bcountry, $bphone, $bemail, $bconfirmemail, $CardType, $AccountNumber, $ExpirationMonth,$ExpirationYear;

  /**
   * Filter to set if PMPro uses email or text as the type for email field inputs.
   *
   * @since 1.8.4.5
   *
   * @param bool $use_email_type, true to use email type, false to use text type
   */
  $pmpro_email_field_type = apply_filters('pmpro_email_field_type', true);
?>
<section class="upgrade_membership">
<div id="pmpro_level-<?php echo $pmpro_level->id; ?>">
  <form id="pmpro_form" action="<?php if(!empty($_REQUEST['review'])) echo pmpro_url("checkout", "?level=" . $pmpro_level->id); ?>" method="post">
    <div class="clear">
    <input type="hidden" id="level" name="level" value="<?php echo esc_attr($pmpro_level->id) ?>" />
    <input type="hidden" id="checkjavascript" name="checkjavascript" value="1" />
    <div class="membership_about">
      <div class="sidebar_title cont_title">
        <?php
        if ( is_user_logged_in() ) {
          global $current_user;
          if ( in_array('candidate', $current_user->roles) ) {
            $cuText = 'Membership';
          }
          else if ( in_array('employer', $current_user->roles) ) {
            $cuText =  "Plan";
          }
          else{
            $cuText = 'Membership'; 
          }
        } else{
          $cuText = 'Membership';
        }

        $userID = $current_user->ID;
        ?>
        <h4><?php echo $pmpro_level->name. ' ' .$cuText; ?> </h4>
      </div>
      <div class="row">
        <?php
        $level_description = apply_filters('pmpro_level_description', $pmpro_level->description, $pmpro_level);
        if(!empty($level_description)){
          echo $level_description;
        }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <h4 class="text-primary">This order form is provided in a secure environment and to help protect against fraud, your current IP address (their IP here) is being logged.</h4>
        <div class="sidebar_title cont_title">
          <h4>Billing Address</h4> <a href="javascript:void(0);" class="use_billing_info" id="useSaveBillingInfo">Use saved billing detail</a>
        </div>
        <div class="indent">
          <div class="hide">
            <div class="form-group custom_required">
              <label for="bfirstname"><?php _e('First Name', 'pmpro');?></label>
              <input id="bfirstname" name="bfirstname" type="text" class="form-control <?php echo pmpro_getClassForField("bfirstname");?>" size="30" value="<?php echo $current_user->first_name; ?>" />
            </div>
            <div class="form-group custom_required">
              <label for="blastname"><?php _e('Last Name', 'pmpro');?></label>
              <input id="blastname" name="blastname" type="text" class="form-control <?php echo pmpro_getClassForField("blastname");?>" size="30" value="<?php echo $current_user->last_name; ?>" />
            </div>
          </div>
          <div class="form-group custom_required">
            <label for="baddress1"><?php _e('Address 1', 'pmpro');?></label>
            <input id="baddress1" name="baddress1" type="text" class="form-control <?php echo pmpro_getClassForField("baddress1");?>" size="30" value="<?php //echo esc_attr($baddress1)?>" />
          </div>
          <div class="form-group">
            <label for="baddress2"><?php _e('Address 2', 'pmpro');?></label>
            <input id="baddress2" name="baddress2" type="text" class="form-control <?php echo pmpro_getClassForField("baddress2");?>" size="30" value="<?php //echo esc_attr($baddress2)?>" />
          </div>
          
          <?php
          $longform_address = apply_filters("pmpro_longform_address", true);
          if($longform_address){ ?>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group custom_required">
                  <label for="bcity"><?php _e('Billing City', 'pmpro');?></label>
                  <input id="bcity" name="bcity" type="text" class="form-control <?php echo pmpro_getClassForField("bcity");?>" size="30" value="<?php //echo esc_attr($bcity)?>" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group custom_required">
                  <label for="bzipcode"><?php _e('Billing Zip', 'pmpro');?></label>
                  <input id="bzipcode" name="bzipcode" type="text" class="form-control <?php echo pmpro_getClassForField("bzipcode");?>" size="30" value="<?php //echo esc_attr($bzipcode)?>" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group custom_required">
                  <label for="bstate"><?php _e('State', 'pmpro');?></label>
                  <input id="bstate" name="bstate" type="text" class="form-control <?php echo pmpro_getClassForField("bstate");?>" size="30" value="<?php //echo esc_attr($bstate)?>" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="alert" role="alert"><i class="fa fa-info-circle"></i> <span>Internatial orders w/o a state, select “My State is not listed”</span></div>
              </div>
            </div>
            <?php
          }
          else{ ?>
            <div class="form-group custom_required has-feedback">
              <label for="bcity_state_zip"><?php _e('City, State Zip', 'pmpro');?></label>
              <input id="bcity" name="bcity" type="text" class="form-control <?php echo pmpro_getClassForField("bcity");?>" size="14" value="<?php //echo esc_attr($bcity)?>" />,
              <?php
              $state_dropdowns = apply_filters("pmpro_state_dropdowns", false);
              if($state_dropdowns === true || $state_dropdowns == "names"){
                global $pmpro_states; ?>
                <select name="bstate" class=" <?php echo pmpro_getClassForField("bstate");?>">
                  <option value="">--</option>
                  <?php
                  foreach($pmpro_states as $ab => $st){
                    ?>
                    <option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php //echo $st;?></option>
                  <?php } ?>
                </select>
                <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
                <?php
              }
              elseif($state_dropdowns == "abbreviations"){
                global $pmpro_states_abbreviations; ?>
                <select name="bstate" class=" <?php echo pmpro_getClassForField("bstate");?>">
                  <option value="">--</option>
                  <?php
                  foreach($pmpro_states_abbreviations as $ab){ ?>
                    <option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php //echo $ab;?></option>
                  <?php } ?>
                </select>
                <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
                <?php
              }
              else{ ?>
                <input id="bstate" name="bstate" type="text" class="form-control <?php echo pmpro_getClassForField("bstate");?>" size="2" value="<?php //echo esc_attr($bstate)?>" />
                <?php
              } ?>
              <input id="bzipcode" name="bzipcode" type="text" class="form-control <?php echo pmpro_getClassForField("bzipcode");?>" size="5" value="<?php //echo esc_attr($bzipcode)?>" />
            </div>
            <?php
            }
          ?>
          <div class="row">
            <div class="col-sm-6">
              <?php
              $show_country = apply_filters("pmpro_international_addresses", true);
              if($show_country)
              {   ?>
                <div class="form-group custom_required has-feedback">
                  <label for="bcountry"><?php _e('Country', 'pmpro');?></label>
                  <select name="bcountry" class="<?php echo pmpro_getClassForField("bcountry");?>">
                    <?php
                      global $pmpro_countries, $pmpro_default_country;
                      if(!$bcountry)
                        $bcountry = $pmpro_default_country;
                      foreach($pmpro_countries as $abbr => $country)
                      {
                      ?>
                      <option value="<?php echo $abbr?>" <?php if($abbr == 'US') { ?>selected="selected"<?php } ?>><?php echo $country?></option>
                      <?php
                      }
                    ?>
                  </select>
                  <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
                </div>
                <?php
              }
              else
              { ?>
                <input type="hidden" name="bcountry" value="US" />
                <?php
              } ?>
            </div>
          </div>
          <div class="hide">
          <div class="form-group custom_required">
            <label for="bphone"><?php _e('Phone', 'pmpro');?></label>
            <?php $pNo = get_user_meta($current_user->ID, 'cell_phone', true); ?>
            <input id="bphone" name="bphone" type="text" class="form-control <?php echo pmpro_getClassForField("bphone");?>" size="30" value="<?php echo ( !empty($pNo) )? $pNo : 1234 ?>" />
          </div> 
          <?php if($skip_account_fields) { ?>
            <?php
            if($current_user->ID)
            {
              if(!$bemail && $current_user->user_email)
                $bemail = $current_user->user_email;
              if(!$bconfirmemail && $current_user->user_email)
                $bconfirmemail = $current_user->user_email;
            }
            ?>
            <div class="form-group custom_required">
              <label for="bemail"><?php _e('E-mail Address', 'pmpro');?></label>
              <input id="bemail" name="bemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="form-control <?php echo pmpro_getClassForField("bemail");?>" size="30" value="<?php echo esc_attr($bemail)?>" />
            </div>
            <?php
            $pmpro_checkout_confirm_email = apply_filters("pmpro_checkout_confirm_email", true);
            if($pmpro_checkout_confirm_email)
            {
              ?>
              <div class="form-group custom_required">
                <label for="bconfirmemail"><?php _e('Confirm E-mail', 'pmpro');?></label>
                <input id="bconfirmemail" name="bconfirmemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="form-control <?php echo pmpro_getClassForField("bconfirmemail");?>" size="30" value="<?php echo esc_attr($bconfirmemail)?>" />

              </div>
              <?php
            }
            else
            { ?>
              <input type="hidden" name="bconfirmemail_copy" value="1" />
              <?php
            }
            ?>
            </div>
          <?php } ?>
        </div>
        <?php do_action('pmpro_checkout_after_pricing_fields'); ?>
        <?php
          do_action('pmpro_checkout_after_user_fields');
        ?>
        <?php
          do_action('pmpro_checkout_boxes');
        ?>
        <?php if(pmpro_getGateway() == "paypal" && empty($pmpro_review)) { ?>
        <div id="pmpro_payment_method" class="pmpro_checkout top1em" <?php if(!$pmpro_requirebilling) { ?>style="display: none;"<?php } ?>>
        <div class="sidebar_title cont_title">
          <h4><?php _e('Choose your Payment Method', 'pmpro');?></h4>
        </div>
        <div class="indent">
          <div class="form-group custom_required">
            <span class="gateway_paypal">
              <input type="radio" name="gateway" value="paypal" <?php if(!$gateway || $gateway == "paypal") { ?>checked="checked"<?php } ?> />
              <a href="javascript:void(0);" class="pmpro_radio"><?php _e('Check Out with a Credit Card Here', 'pmpro');?></a>
            </span>
            <span class="gateway_paypalexpress">
              <input type="radio" name="gateway" value="paypalexpress" <?php if($gateway == "paypalexpress") { ?>checked="checked"<?php } ?> />
              <a href="javascript:void(0);" class="pmpro_radio"><?php _e('Check Out with PayPal', 'pmpro');?></a>
            </span>
          </div>
        </div>
        <?php } ?>

        <?php do_action("pmpro_checkout_after_billing_fields"); ?>
        <?php
          $pmpro_accepted_credit_cards = pmpro_getOption("accepted_credit_cards");
          $pmpro_accepted_credit_cards = explode(",", $pmpro_accepted_credit_cards);
          $pmpro_accepted_credit_cards_string = pmpro_implodeToEnglish($pmpro_accepted_credit_cards);
        ?>
        <?php
        $pmpro_include_payment_information_fields = apply_filters("pmpro_include_payment_information_fields", true);
        if($pmpro_include_payment_information_fields)
        {   ?>


        <div id="pmpro_payment_information_fields" class="pmpro_checkout top1em" <?php if(!$pmpro_requirebilling || apply_filters("pmpro_hide_payment_information_fields", false) ) { ?>style="display: none;"<?php } ?>>
          <div class="sidebar_title cont_title">
            <h4><?php _e('Card Information', 'pmpro');?>
              <span class="pmpro_thead-msg"><?php printf(__('We Accept %s', 'pmpro'), $pmpro_accepted_credit_cards_string);?></span></h4>
          </div>
          <div class="indent">
          <?php
            $sslseal = pmpro_getOption("sslseal");
            if($sslseal)
            {
            ?>
              <div class="pmpro_sslseal"><?php echo stripslashes($sslseal)?></div>
            <?php
            }
          ?>

          <?php
          $pmpro_include_cardtype_field = apply_filters('pmpro_include_cardtype_field', false);
          if($pmpro_include_cardtype_field)
          {
            ?>
            <div class="pmpro_payment-card-type form-gorup has-feedback">
              <label for="CardType"><?php _e('Card Type', 'pmpro');?></label>
              <select id="CardType" name="CardType" class=" <?php echo pmpro_getClassForField("CardType");?>">
                <?php foreach($pmpro_accepted_credit_cards as $cc) { ?>
                  <option value="<?php echo $cc?>" <?php if($CardType == $cc) { ?>selected="selected"<?php } ?>><?php echo $cc?></option>
                <?php } ?>
              </select>
              <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
            </div>
            <?php
          }
          else
          { 
            ?>
            <input type="hidden" id="CardType" name="CardType" value="<?php echo esc_attr($CardType);?>" />
            <script>
              <!--
              jQuery(document).ready(function() {
                jQuery('#AccountNumber').validateCreditCard(function(result) {
                  var cardtypenames = {
                    "amex"                      : "American Express",
                    "diners_club_carte_blanche" : "Diners Club Carte Blanche",
                    "diners_club_international" : "Diners Club International",
                    "discover"                  : "Discover",
                    "jcb"                       : "JCB",
                    "laser"                     : "Laser",
                    "maestro"                   : "Maestro",
                    "mastercard"                : "Mastercard",
                    "visa"                      : "Visa",
                    "visa_electron"             : "Visa Electron"
                  };

                  if(result.card_type)
                    jQuery('#CardType').val(cardtypenames[result.card_type.name]);
                  else
                    jQuery('#CardType').val('Unknown Card Type');
                });
              });
              -->
            </script>
            <?php
          }
          ?>
          <div class="form-group custom_required">
            <label for="AccountNumber"><?php _e('Card Number', 'pmpro');?></label>
            <input id="AccountNumber" name="AccountNumber" class="form-control <?php echo pmpro_getClassForField("AccountNumber");?>" type="text" size="25" value="<?php echo esc_attr($AccountNumber)?>" data-encrypted-name="number" autocomplete="off" />
          </div>
          <div class="pmpro_payment-expiration form-group custom_required has-feedback">
            <label for="ExpirationMonth"><?php _e('Exp Month', 'pmpro');?></label>
            <select id="ExpirationMonth" name="ExpirationMonth" class="form-control <?php echo pmpro_getClassForField("ExpirationMonth");?>">
              <option value="01" <?php if($ExpirationMonth == "01") { ?>selected="selected"<?php } ?>>01</option>
              <option value="02" <?php if($ExpirationMonth == "02") { ?>selected="selected"<?php } ?>>02</option>
              <option value="03" <?php if($ExpirationMonth == "03") { ?>selected="selected"<?php } ?>>03</option>
              <option value="04" <?php if($ExpirationMonth == "04") { ?>selected="selected"<?php } ?>>04</option>
              <option value="05" <?php if($ExpirationMonth == "05") { ?>selected="selected"<?php } ?>>05</option>
              <option value="06" <?php if($ExpirationMonth == "06") { ?>selected="selected"<?php } ?>>06</option>
              <option value="07" <?php if($ExpirationMonth == "07") { ?>selected="selected"<?php } ?>>07</option>
              <option value="08" <?php if($ExpirationMonth == "08") { ?>selected="selected"<?php } ?>>08</option>
              <option value="09" <?php if($ExpirationMonth == "09") { ?>selected="selected"<?php } ?>>09</option>
              <option value="10" <?php if($ExpirationMonth == "10") { ?>selected="selected"<?php } ?>>10</option>
              <option value="11" <?php if($ExpirationMonth == "11") { ?>selected="selected"<?php } ?>>11</option>
              <option value="12" <?php if($ExpirationMonth == "12") { ?>selected="selected"<?php } ?>>12</option>
            </select>
            <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="pmpro_payment-expiration form-group custom_required has-feedback">
            <label for="ExpirationYear"><?php _e('Exp Year', 'pmpro');?></label>
            <select id="ExpirationYear" name="ExpirationYear" class="form-control <?php echo pmpro_getClassForField("ExpirationYear");?>">
              <?php
                for($i = date("Y"); $i < date("Y") + 10; $i++)
                {
              ?>
                <option value="<?php echo $i?>" <?php if($ExpirationYear == $i) { ?>selected="selected"<?php } ?>><?php echo $i?></option>
              <?php
                }
              ?>
            </select>
            <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
          </div>
          <?php
            $pmpro_show_cvv = apply_filters("pmpro_show_cvv", true);
            if($pmpro_show_cvv) { ?>
          <div class="pmpro_payment-cvv form-group custom_required">
            <label for="CVV"><?php _e('CVV', 'pmpro');?></label>
            <input class="input" id="CVV" name="CVV" type="text" size="4" value="<?php if(!empty($_REQUEST['CVV'])) { echo esc_attr($_REQUEST['CVV']); }?>" class="form-control <?php echo pmpro_getClassForField("CVV");?>" />  <small>(<a href="javascript:void(0);" onclick="javascript:window.open('<?php echo pmpro_https_filter(PMPRO_URL)?>/pages/popup-cvv.html','cvv','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=475');"><?php _e("what's this?", 'pmpro');?></a>)</small>
          </div>
          <?php } ?>

          <?php if($pmpro_show_discount_code) { ?>
          <div class="pmpro_payment-discount-code form-group custom_required">
            <div class="form-group">
              <label for="discount_code"><?php _e('Discount Code', 'pmpro');?></label>
              <input class="form-control <?php echo pmpro_getClassForField("discount_code");?>" id="discount_code" name="discount_code" type="text" size="20" value="<?php echo esc_attr($discount_code)?>" />
            </div>
            
            <input type="button" class="btn btn-primary" id="discount_code_button" name="discount_code_button" value="<?php _e('Apply', 'pmpro');?>" />
            <p id="discount_code_message" class="pmpro_message" style="display: none;"></p>
          </div>
          <?php } ?>
          </div>
        </div>
          <?php } ?>
        <div class="sidebar_title cont_title">
          <h4>Review Your Order</h4>
        </div>
        <div class="indent">
          <ul class="card_billing_info">
            <li><span><?php echo $cuText; ?> Type : </span><?php echo $pmpro_level->name; ?></li>
            <li><span>Price : </span><?php echo $pmpro_currency_symbol . $pmpro_level->initial_payment; ?></li>
            <li><span>Total : </span><strong>$<?php echo $pmpro_level->initial_payment; ?></strong></li>
          </ul>
        </div>
        
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>     

        <script>
          <!--
          //checking a discount code
          jQuery('#discount_code_button').click(function() {
            var code = jQuery('#discount_code').val();
            var level_id = jQuery('#level').val();

            if(code)
            {
              //hide any previous message
              jQuery('.pmpro_discount_code_msg').hide();

              //disable the apply button
              jQuery('#discount_code_button').attr('disabled', 'disabled');

              jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php')?>',type:'GET',timeout:<?php echo apply_filters("pmpro_ajax_timeout", 5000, "applydiscountcode");?>,
                dataType: 'html',
                data: "action=applydiscountcode&code=" + code + "&level=" + level_id + "&msgfield=discount_code_message",
                error: function(xml){
                  alert('Error applying discount code [1]');

                  //enable apply button
                  jQuery('#discount_code_button').removeAttr('disabled');
                },
                success: function(responseHTML){
                  if (responseHTML == 'error')
                  {
                    alert('Error applying discount code [2]');
                  }
                  else
                  {
                    jQuery('#discount_code_message').html(responseHTML);
                  }

                  //enable invite button
                  jQuery('#discount_code_button').removeAttr('disabled');
                }
              });
            }
          });
          -->
        </script>

        <?php do_action('pmpro_checkout_after_payment_information_fields'); ?>

        <?php
        if($tospage && !$pmpro_review)
        { ?>
          <table id="pmpro_tos_fields" class="pmpro_checkout top1em" width="100%" cellpadding="0" cellspacing="0" border="0">
            <thead>
              <tr>
                <th><?php echo $tospage->post_title?></th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd">
                <td>
                  <div id="pmpro_license">
                    <?php echo wpautop(do_shortcode($tospage->post_content));?>
                  </div>
                  <input type="checkbox" name="tos" value="1" id="tos" /> <label class="pmpro_normal pmpro_clickable" for="tos"><?php printf(__('I agree to the %s', 'pmpro'), $tospage->post_title);?></label>
                </td>
              </tr>
            </tbody>
          </table>
          <?php
        }
        ?>

        <?php do_action("pmpro_checkout_after_tos_fields"); ?>

        <?php do_action("pmpro_checkout_before_submit_button"); ?>

        <div class="pmpro_submit indent text-center">
          <?php if($pmpro_review) { ?>

            <div class="indent text-center" id="pmpro_submit_span">
              <input type="hidden" name="confirm" value="1" />
              <input type="hidden" name="token" value="<?php echo esc_attr($pmpro_paypal_token)?>" />
              <input type="hidden" name="gateway" value="<?php echo esc_attr($gateway); ?>" />
              <input type="submit" class="pmpro_btn pmpro_btn-submit-checkout btn btn-primary" value="Upgrade My <?php echo $cuText; ?> &raquo;" />
            </div>
          <?php } else { ?>

            <?php
              $pmpro_checkout_default_submit_button = apply_filters('pmpro_checkout_default_submit_button', true);
              if($pmpro_checkout_default_submit_button)
              {
              ?>
              <span id="pmpro_submit_span">
                <input type="hidden" name="submit-checkout" value="1" />
                <button type="submit" class="pmpro_btn pmpro_btn-submit-checkout btn btn-primary" value=""><?php if($pmpro_requirebilling) { _e('Upgrade My '.$cuText, 'pmpro'); } else { _e('Submit and Confirm', 'pmpro');}?></button>
              </span>
              <?php
              }
            ?>

          <?php } ?>

          <span id="pmpro_processing_message" style="visibility: hidden;">
            <?php
              $processing_message = apply_filters("pmpro_processing_message", __("Processing...", "pmpro"));
              echo $processing_message;
            ?>
          </span>
        </div>

      </div>
      <?php
      if ( !is_user_logged_in() ) {
        echo "</div>";
      }
      ?>
      <div class="col-md-4">
        <div class="special_box special_logo">
          <div class="thumbnail"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
          <h5>What You'll Get Going Plus</h5>
          <?php
          global $wpdb;
          $table_prefix = $wpdb->prefix.'pmpro_membership_levelmeta';
          $levelmeta = $wpdb->get_row( "SELECT * FROM $table_prefix WHERE pmpro_membership_level_id = '".$pmpro_level->id."' AND meta_key = 'other_desc' " );
          echo $levelmeta->meta_value;
          ?>
        </div>
        <div class="special_box">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/security_pro_img.jpg" class="img-responsive">
        </div>
      </div>
    <?php
      if ( is_user_logged_in() ) {
        echo "</div>";
      }
    ?>

    </div>

  </form>

  <?php do_action('pmpro_checkout_after_form'); ?>

</div> <!-- end pmpro_level-ID -->
</section>
<script>
<!--
  // Find ALL <form> tags on your page
  jQuery('form').submit(function(){
    // On submit disable its submit button
    jQuery('input[type=submit]', this).attr('disabled', 'disabled');
    jQuery('input[type=image]', this).attr('disabled', 'disabled');
    jQuery('#pmpro_processing_message').css('visibility', 'visible');
  });

  //iOS Safari fix (see: http://stackoverflow.com/questions/20210093/stop-safari-on-ios7-prompting-to-save-card-data)
  var userAgent = window.navigator.userAgent;
  if(userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
    jQuery('input[type=submit]').click(function() {
      try{
        jQuery("input[type=password]").attr("type", "hidden");
      } catch(ex){
        try {
          jQuery("input[type=password]").prop("type", "hidden");
        } catch(ex) {}
      }
    });
  }

  //add required to required fields
  //jQuery('.pmpro_required').after('<span class="pmpro_asterisk"> <abbr title="Required Field">*</abbr></span>');
  jQuery('<span class="pmpro_asterisk">*</span>').appendTo('.custom_required label');

  //unhighlight error fields when the user edits them
  jQuery('.pmpro_error').bind("change keyup input", function() {
    jQuery(this).removeClass('pmpro_error');
  });

  //click apply button on enter in discount code box
  jQuery('#discount_code').keydown(function (e){
      if(e.keyCode == 13){
       e.preventDefault();
       jQuery('#discount_code_button').click();
      }
  });

  //hide apply button if a discount code was passed in
  <?php if(!empty($_REQUEST['discount_code'])) {?>
    jQuery('#discount_code_button').hide();
    jQuery('#discount_code').bind('change keyup', function() {
      jQuery('#discount_code_button').show();
    });
  <?php } ?>

  //click apply button on enter in *other* discount code box
  jQuery('#other_discount_code').keydown(function (e){
      if(e.keyCode == 13){
       e.preventDefault();
       jQuery('#other_discount_code_button').click();
      }
  });
-->
</script>
<script>
<!--
//add javascriptok hidden field to checkout
jQuery("input[name=submit-checkout]").after('<input type="hidden" name="javascriptok" value="1" />');
-->
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#useSaveBillingInfo').on('click', function() {
            var ccbi_address = "<?php echo get_user_meta($userID, 'ccbi_address', true); ?>"; 
            var ccbi_city = "<?php echo get_user_meta($userID, 'ccbi_city', true); ?>"; 
            var ccbi_zip = "<?php echo get_user_meta($userID, 'ccbi_zip', true); ?>"; 
            var ccbi_state = "<?php echo get_user_meta($userID, 'ccbi_state', true); ?>"; 
            var ccbi_country = "<?php echo get_user_meta($userID, 'ccbi_country', true); ?>";

            if ( ccbi_address == '' ) {
                jQuery.notify('Saved billing info was not found!', 'warning');
            } else{
              jQuery('input[name="baddress1"]').val(ccbi_address);
              jQuery('input[name="bcity"]').val(ccbi_city);
              jQuery('input[name="bzipcode"]').val(ccbi_zip);
              jQuery('input[name="bstate"]').val(ccbi_state);
              jQuery('select[name="bcountry"] option[value="'+ccbi_country+'"]').attr('selected', 'selected');
            }

        });
    });
</script>   