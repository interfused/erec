<?php 
require('config.php');  
//$sql = "SELECT * FROM `__leads-seeker`";


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
    <hr>
    <ul>
    <?php
    while($row = $result->fetch_assoc()) {
      ?>
      <li>
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

          <p class="email"><a href="<?php echo $row["resume_location"]; ?>" class="download"><i class="fa fa-download"></i> download resume</a></p>
          
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


