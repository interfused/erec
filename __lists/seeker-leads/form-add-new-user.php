<?php
function setup_question_textarea($question, $field_name){
  return '
  <div class="form-group q_a">
  <label>'.$question.'</label>
  <textarea name="'.$field_name.'"  ></textarea>
  </div>
  ';
}
function setup_question_select($question,$field_name,$options_arr){
  $htmlStr = '<div class="form-group">';
  $htmlStr .= '<label>'.$question.'</label>';
  $htmlStr .= '<select name="'.$field_name.'">';
  for($i=0; $i<count($options_arr); $i++){
    $val = $options_arr[$i];
    $htmlStr .= '<option value="'.$val.'">'.$val.'</option>';
  }
  $htmlStr .= '</select></div>';  
  return $htmlStr;
}
?>

<div id="wrapper-add_user">
  <form id="add_new_user_form" enctype="multipart/form-data">
    <p class="required">* required</p>
    <div class="form-group">
      <label>First Name *</label>
      <input name="first_name" type="text" required />
    </div>

    <div class="form-group">
      <label>Last Name *</label>
      <input name="last_name" type="text" required />
    </div>

    <div class="form-group">
      <label>Email *</label>
      <input name="email" type="text" required />
    </div>

    <div class="form-group">
      <label>Phone</label>
      <input name="phone" type="text" />
    </div>

    <div class="form-group">
      <label>Resume</label>
      <input name="resume" id="resume" type="file" />
    </div>

    <div class="form-group">
      <label>Industry</label>
      <select name="industry" >
        <option value=""></option>
        <option value="Security">Security</option>
        <option value="Investigations">Investigations</option>
        <option value="Surveillance">Surveillance</option>
        <option value="Risk Management">Risk Management</option>
        <option value="Information Technology">Information Technology</option>
        <option value="Loss Prevention">Loss Prevention</option>

      </select>

    </div>

    <div class="form-group">
      <label>Contact Source</label>
      <input name="contact_source" type="text" />
    </div>

    <div class="form-group">
      <label>Zip Code</label>
      <input name="zip" type="text" />
    </div>
    <div class="form-group">
      <label>Desired Salary Range</label>
      <select name="SALARY_REQ" class="" id="mce-SALARY_REQ">
        <option value=""></option>
        <option value="30K-35K">30K-35K</option>
        <option value="35K-40K">35K-40K</option>
        <option value="40K-45K">40K-45K</option>
        <option value="45K-50K">45K-50K</option>
        <option value="50K-55K">50K-55K</option>
        <option value="55K-60K">55K-60K</option>
        <option value="60K-65K">60K-65K</option>
        <option value="65K-70K">65K-70K</option>
        <option value="70K-75K">70K-75K</option>
        <option value="75K-80K">75K-80K</option>
        <option value="80K-85K">80K-85K</option>
        <option value="85K-90K">85K-90K</option>
        <option value="90K-95K">90K-95K</option>
        <option value="95K-100K">95K-100K</option>
        <option value="100K-125K">100K-125K</option>
        <option value="125K-150K">125K-150K</option>
        <option value="150K+">150K+</option>

      </select>
    </div>
    <?php
/*

*/
echo setup_question_textarea('Has anything changed since our last conversation?', 'any_changes');
echo setup_question_textarea('Let’s start with what your doing now.  Can you give me a better understanding of your daily duties and responsibilities?', 'daily_duties');
//echo setup_question_textarea('How long have you been in the industry?', 'industry_history');
echo setup_question_select('How long have you been in the industry?', 'industry_history',array('under 1 year','1-2 years','2-5 years','5-7 years','7-10 years','10-15 years','15-20 years','over 20 years'));
echo setup_question_textarea('So tell me what you are looking for right now.','looking_for');
echo setup_question_textarea('How did you find your last Job (with the company you are with now)?', 'how_last_job_found');
echo setup_question_textarea('Have you ever worked with any other Recruiter or Agency? If so, whom?', 'any_other_recruiters');
echo setup_question_textarea('Whom have you reached out to or applied with recently & when? What was the result?', 'current_applications_results');
echo setup_question_textarea('What does the ideal career look like for you?', 'ideal_career');
echo setup_question_textarea('Why did you leave your last Employer? (Who was the Employer?)', 'why_left_last_job');
echo setup_question_textarea('Give me the list of 5 companies currently in the market that you would like to work with and why.', 'desired_companies');
echo setup_question_textarea('Whom have you met with so far in your job search?', 'who_met_with');
echo setup_question_textarea('What is most important factor to you at this point in your career?', 'most_important_career_factor');
echo setup_question_textarea('What do you see going on in the industry right now?', 'industry_observations');
echo setup_question_textarea('What\'s you biggest complaint about the process of career advancement you have right now?', 'biggest_complaint');
echo setup_question_textarea('What do you think is keeping you from finding the job you want?', 'biggest_job_hurdles');
echo setup_question_textarea('Tell me a little about what you are doing for continuing education. Where are you going for this learning or what is available to achieve your learning goals?', 'continuing_education');
//echo setup_question_textarea($question, $field_name);

?>


<p style="text-align: center;"><button id="submit_new_user" disabled ><i class="fa fa-plus"></i> Save User</button></p>

</form>
</div>