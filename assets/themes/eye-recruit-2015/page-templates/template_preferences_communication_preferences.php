<?php
/**
 * Template Name: Preferences communication-preferences page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<style>
.field_table{
  border: 1px solid #dddddd;
  margin-bottom: 2em;
}
.field_table > h3{
  background-color: #e9e9e9;
  padding: 10px;
  margin: 0;
}
.field_wrapper{
  display: -ms-flex;
  display: -webkit-flex;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: middle;
  border-color: #dddddd;
  background-color: #ffffff;
  border-style: solid;
  border-width: 2px 0 0 0;
  padding: 0;
  margin: 0;
}
.field_wrapper > div{
  padding: 10px;
  box-sizing: border-box;
}
.field_label{
  flex-grow: 1;
  vertical-align: middle;
}
.field_label p{
  margin: 0;
}
.field_toggle{
  background-color: #f3f3f3;
}
.field_toggle label{
  margin-bottom: 0;
}

</style>

<?php while ( have_posts() ) : the_post(); ?>

  <header class="page-header">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </header>

  <section class="preferences">
    <div class="container">
      <div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
      <div class="row">
        <div class="col-md-3">
          <?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
        </div>
        <div class="col-md-9 sidemenu_border">
          <div class="section_title">
            <h3>Communication Preferences</h3>
            <input type="hidden" name="cur_user_id" id="cur_user_id" value="<?php $user_id = get_current_user_id(); echo $user_id; ?>">
            <span><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
          </div>
          <div class="communication_prefer">
            <!-- 
            <div class="sidebar_title cont_title">
              <h4>Email Notifications</h4>
              <div class="title_edit">
                <label class="radio-inline">
                  <input type="radio" name="CP_EMAIL_NOTIFY" id="CP_EMAIL_NOTIFY_1" value="option1" checked> <span>HTML</span>
                </label>
                <label class="radio-inline">
                  <input type="radio" name="CP_EMAIL_NOTIFY" id="CP_EMAIL_NOTIFY_2" value="option2"> <span>Plain Text</span>
                </label>
              </div>
            </div>
            -->

            <div>
              <?php 
              function get_cp_options_html($arr){
                $htmlStr = '';
                foreach($arr as $tmp_label){
                  $field = types_get_field($tmp_label, 'usermeta');
                  $val = types_render_usermeta($tmp_label, array( "user_current" => true ));

                  $isChecked = '';
                  if($val == 1 || strtolower($val)=='yes'){
                    $isChecked = 'checked';
                  }
                  $htmlStr .= '<div class="field_wrapper">';
                  $htmlStr .= '<div class="field_label"><p>' .$field['name']. '</p></div>';
                  $htmlStr .= '<div class="field_toggle">';
                  $htmlStr .= '<label class="switch">';
                  $htmlStr .= '<input type="checkbox" value="'.$val.'" '.$isChecked.' name="'.$tmp_label.'" class="toggle_checkbox" id="'.$tmp_label.'">';
                  $htmlStr .= '<span class="slider round"></span></label>';
                  $htmlStr .= '</div></div>';
                }
                return $htmlStr;
              }

              ?>
              <div class="field_table">
              <h3>Job Leads</h3>
              <?php 
              //array of fields taken from tooltypes user fields
                $tmp_labels = array('comm-preferences-job-recommendations','comm-pref-desired-goal-career','comm-preferences-unlisted-job-opportunities');
                echo get_cp_options_html($tmp_labels);
              ?>
              </div>

              <div class="field_table">
              <h3>Employer Interactions</h3>
              
              <?php 
                $tmp_labels = array('cp-seeker-message-on-profile','cp-seeker-career-docs','cp-seeker-private-chat','cp-seeker-emp-following-profile'); 
                echo get_cp_options_html($tmp_labels);
              ?>
              </div>

              <div class="field_table">
              <h3>Recruiter Interactions</h3>
              
              <?php
                $tmp_labels =array('cp-seeker-recruiter-direct-communication','cp-seeker-recruiter-private-chat');
                echo get_cp_options_html($tmp_labels);
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

  jQuery('.communication_prefer input:checkbox').on('click', function(){

    var msg = jQuery(this).closest('.field_table').find('h3').eq(0).text();
    var user_id = jQuery('#cur_user_id').val();
    var field_names = jQuery(this).attr('name');
    if ( jQuery(this).is(':checked')){ 
      var field_values = '1';
    }
    else{
      var field_values = '0';
    }
    jQuery('#loaders').show();  
    jQuery.ajax({
      type : "POST",
      url : "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>",
      data : {
        action : 'communication_preferences',
        user_id : user_id,
        field_names : field_names,
        field_values: field_values
      },
      success : function(r){
        jQuery('#loaders').hide();
        swal({
          title: "Success", 
          html: true,
          text: "<span class='text-center'>Successfully update communication preferences permission for "+msg+"</span>",
          type: "success",
          confirmButtonClass: "btn-primary btn-sm",
        });
      }
    });
  });

});
</script>
<?php get_footer('preferences'); ?>

