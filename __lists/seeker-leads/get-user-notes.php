<?php 
require('config.php');  

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
// Create connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if($_GET['user_id']){
  $sql = "SELECT * FROM `__leads-seeker-notes` WHERE `user_id`=".$_GET['user_id'] ." ORDER BY timestamp";
}else{
  $sql = "SELECT * FROM `__leads-seeker-notes` ORDER BY timestamp";
}

//echo $sql;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<div class="notes_list">';
    ?>
    <div class="row row_header">
      <div class="date">Date</div>
         <div class="note">Note</div>
    </div>
    <?php
    while($row = $result->fetch_assoc()) {
      ?>
      <div class="row">
          <div class="date"><?php echo $row['timestamp'];?></div>
         <div class="note"><?php echo $row['user_note'];?></div>
      </div>
      <?php
      //  echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }

    echo '</div>';

} else {
    echo "<p>No notes exist for this user</p>";
}
$conn->close();


?>