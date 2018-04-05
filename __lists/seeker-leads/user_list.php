<?php 
require('config.php');  
//$sql = "SELECT * FROM `__leads-seeker`";

function setup_question($question,$answer){
  $htmlStr = '<p class="question">'.$question.'</p>';
  $htmlStr .= '<p class="answer">'.nl2br($answer).'</p>';
  return $htmlStr;
}
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
// Create connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `__leads-seeker` ORDER BY last_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
  echo '<div class="user_list">';
  ?>
  <p>Choose user below for detail</p>
  <form>
    <input name="filterText" placeholder="Search by name...">
  </form>
  <hr>
  <ul>
    <?php
    while($row = $result->fetch_assoc()) {
      ?>
      <li>
        <a href="javascript:void();" data-userid="<?php echo $row['id'];?>" class="user_delete" ><i class="fa fa-trash-o"></i></a>&nbsp;
        <a href="javascript:void();" data-userid="<?php echo $row['id'];?>" class="user_selector" >
          <span class="last_name"><?php echo $row["last_name"];?></span>, <span class="first_name"><?php echo $row["first_name"];?></span>
          
        </a>
        <div class="contact_info">
          <p class="userid">USER ID: <span id="userid"><?php echo $row["id"]; ?></span></p>
          <p class="email"><a href="mailto:<?php echo $row["email"]; ?>"><?php echo $row["email"]; ?></a></p>
          <p class="phone">P: <?php echo $row['phone'];?></p>

          <p class="industry">Industry: <?php echo $row['industry'];?></p>
          <p class="contact_source">Contact Source: <?php echo $row['contact_source'];?></p>

          <p class="zip">Zip: <?php echo $row['zip'];?></p>

          <p class="desired_salary_range">Desired Salary Range: <?php echo $row['desired_salary_range'];?></p>
          
          <?php if($row["resume_location"]){ ?>
          <p class="res"><a href="<?php echo $row["resume_location"]; ?>" class="download"><i class="fa fa-download"></i> download resume</a></p>
          <?php }else{ ?>
          <p class="res not_available"><em>Resume not uploaded</em></p>
          <?php }//endif ?>
          
          <div id="q_and_a">
            <h3>Questions and Answers</h3>
            <?php
            
            
            echo setup_question('Has anything changed since our last conversation?', $row['any_changes']);
            echo setup_question('Let’s start with what your doing now.  Can you give me a better understanding of your daily duties and responsibilities?', $row['daily_duties']);
            echo setup_question('How long have you been in the industry?', $row['industry_history']);
            echo setup_question('So tell me what you are looking for right now.',$row['looking_for']);
            echo setup_question('How did you find your last Job (with the company you are with now)?', $row['how_last_job_found']);
            echo setup_question('Have you ever worked with any other Recruiter or Agency? If so, whom?', $row['any_other_recruiters']);
            echo setup_question('Whom have you reached out to or applied with recently & when? What was the result?', $row['current_applications_results']);
            echo setup_question('What does the ideal career look like for you?', $row['ideal_career']);
            echo setup_question('Why did you leave your last Employer? (Who was the Employer?)', $row['why_left_last_job']);
            echo setup_question('Give me the list of 5 companies currently in the market that you would like to work with and why.', $row['desired_companies']);
            echo setup_question('Whom have you met with so far in your job search?', $row['who_met_with']);
            echo setup_question('What is most important factor to you at this point in your career?', $row['most_important_career_factor']);
            echo setup_question('What do you see going on in the industry right now?', $row['industry_observations']);
            echo setup_question('What\'s you biggest complaint about the process of career advancement you have right now?', $row['biggest_complaint']);
            echo setup_question('What do you think is keeping you from finding the job you want?', $row['biggest_job_hurdles']);
            echo setup_question('Tell me a little about what you are doing for continuing education. Where are you going for this learning or what is available to achieve your learning goals?', $row['continuing_education']);
            ?>
          </div>
          
        </div>
      </li>
      <?php
      //  echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }

    echo '</ul></div>';

  } else {
    echo "0 results";
  }
  $conn->close();


  ?>

  <script>
    $('input[name=filterText]').on('input',function(){
      var filterVal = $(this).val().toLowerCase(); 
      if(filterVal != ''){
        console.log(filterVal);  
        $('.user_list li').each(function(){
        //$(this).hide();
        $(this).hide(); 
        
        var lnameCheck = $(this).find('span.last_name').text().toLowerCase();
        if(lnameCheck.indexOf(filterVal) >= 0 ){
          $(this).show();
        }
        var fnameCheck = $(this).find('span.first_name').text().toLowerCase();
        if(fnameCheck.indexOf(filterVal) >= 0 ){
          $(this).show();
        }
        
      });
        
      }else{
        console.log('empty');
        $('.user_list li').show();
      }
      
      
      
      
    })
  </script>
