<?php
if(!$_GET['id'] && !$_POST['id'] ){
    header('location: http://eyerecruit.com/__lists/seeker-leads/');    
}
$http_origin = $_SERVER['HTTP_ORIGIN'];
$allowed_cross_domains = array(
    'http://infosecjobsnearme.com',
    'http://www.infosecjobsnearme.com',
    'http://cybersecurityjobsnearme.com',
    'http://www.cybersecurityjobsnearme.com',
    'http://investigationjobsnearme.com',
    'http://www.investigationjobsnearme.com',
    'http://securityjobsnearme.com',
    'http://www.securityjobsnearme.com',
    'http://eyerecruit.com',
    'http://www.eyerecruit.com'
);
if(in_array($http_origin, $allowed_cross_domains)){
    header("Access-Control-Allow-Origin: $http_origin");
}


require_once('config.php');
require_once('api.php');
?>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Jura:400,600,700|Open+Sans:400,600,700,800|Open+Sans+Condensed:300" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel='stylesheet' type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php // https://github.com/Abban/jQuery-Ajax-File-Upload ?>
    <script src="js/jquery-fileupload.min.js"></script>
    <style>
        #back_to_list{font-size: 10px;}
        h2.display_name{padding-bottom: 0; margin-bottom: 0;}
        .form-group{display: inline-flex; width: 100%; flex-direction: column; box-sizing: border-box; padding: 10px;}
        
        .form-group:nth-of-type(1),
        .form-group:nth-of-type(2),
        .form-group:nth-of-type(3),
        .form-group:nth-of-type(4),
        .form-group:nth-of-type(7),
        .form-group:nth-of-type(8){
            width: 50%;
            margin-right: -4px;
        }
        textarea{height: 10em;}
    </style>
</head>
<body>
    <h1 class="wrapper">Update User</h1>
        
    <div class="wrapper">
        <a id="back_to_list" class="button" href="index.php"><i class="fa fa-angle-left"></i> Back to user list</a>
        <?php
        
        $recordFound = false;
    //check if record found for passed ID
        if($_GET['id']){
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
            $charset = 'utf8mb4';
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=$charset";
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $opt);
            
            
            $stmt = $pdo->prepare('SELECT * FROM `__leads-seeker` WHERE id = :id ');
            $stmt->execute(['id' => $_GET['id'] ] );
            $user = $stmt->fetch();
            if($user['id']){
                $recordFound = true;
            }
            
        }
        
        if(!$recordFound && $_GET['id']){
            echo 'RECORD NOT FOUND';
        }
        if($recordFound){ 
        /////////DISPLAY UPDATE FORM
            echo '<div id="tempVals">';
            //echo ('<p id="desired_companies">Desired companies are: <span>'.$user['desired_companies'].'</span></p>');
            
            foreach ($user as $key => $value) {
                # code...
                echo ('<p id="'.$key.'">'.$key.': <span>'.$value.'</span></p>');

            }
            echo '</div>';
            include('form-add-new-user.php');
            ?>
            
            <script>
                $(document).ready(function(){
                    $('form').removeAttr('id').attr('method','POST').attr('action','update.php');
                    $('form').show();
                    $('#submit_new_user').removeAttr('disabled').attr('id','update_user').text('Update User');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'updateRec',
                        name: 'updateRec',
                        value: 1
                    }).appendTo('form');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'id',
                        name: 'id',
                        value: <?php echo $_GET['id'] ?>
                    }).appendTo('form');
                    
                    $('input[name=first_name]').val("<?php echo $user['first_name'];?>");
                    $('input[name=last_name]').val("<?php echo $user['last_name'];?>");
                    $('input[name=email]').val("<?php echo $user['email'];?>");
                    $('input[name=phone]').val("<?php echo $user['phone'];?>");
                    $('input[name=contact_source]').val("<?php echo $user['contact_source'];?>");
                    $('input[name=zip]').val("<?php echo $user['zip'];?>");
                    
                    $('select[name=industry]').val("<?php echo $user['industry'];?>");
                    $('select[name=SALARY_REQ]').val("<?php echo $user['desired_salary_range'];?>");
                    
                    questions_arr = ['any_changes','daily_duties','industry_history','looking_for','how_last_job_found','any_other_recruiters','current_applications_results','ideal_career','why_left_last_job','desired_companies','who_met_with','most_important_career_factor','industry_observations','biggest_complaint','biggest_job_hurdles','continuing_education'];
                    
                    //$('textarea[name=any_changes]').val( $('p#any_changes span').text() );
                    for(i=0;i<questions_arr.length;i++){
                        $('textarea[name = '+questions_arr[i]+']').val( $('p#'+questions_arr[i]+' span').text() );    
                    }
                    $('#tempVals').remove();
                    /*
                    
                    $('textarea[name=daily_duties]').val( $('p#daily_duties span').text() );
                    $('textarea[name=industry_history]').val( $('p#industry_history span').text() );
                    $('textarea[name=looking_for]').val( $('p#looking_for span').text() );
                    $('textarea[name=how_last_job_found]').val( $('p#how_last_job_found span').text() );
                    $('textarea[name=any_other_recruiters]').val( $('p#any_other_recruiters span').text() );
                    $('textarea[name=current_applications_results]').val( $('p#current_applications_results span').text() );
                    $('textarea[name=ideal_career]').val( $('p#ideal_career span').text() );
                    $('textarea[name=why_left_last_job]').val( $('p#why_left_last_job span').text() );
                    $('textarea[name=desired_companies]').val( $('p#desired_companies span').text() );
                    $('textarea[name=who_met_with]').val( $('p#who_met_with span').text() );
                    $('textarea[name=most_important_career_factor]').val( $('p#most_important_career_factor span').text() );
                    
                    $('textarea[name=industry_observations]').val( $('p#industry_observations span').text() );
                    $('textarea[name=biggest_complaint]').val( $('p#biggest_complaint span').text() );
                    $('textarea[name=biggest_job_hurdles]').val( $('p#biggest_job_hurdles span').text() );
                    /*
                    $('textarea[name=most_important_career_factor]').val( $('p#most_important_career_factor span').text() );
                    $('textarea[name=most_important_career_factor]').val( $('p#most_important_career_factor span').text() );
                    
                    /* str_replace("<br />",chr(13),$des)
                    //$('textarea[name=who_met_with]').val("<?php echo nl2br($user['who_met_with']);?>");
                    $('textarea[name=most_important_career_factor]').val("<?php echo $user['most_important_career_factor'];?>");
                    
                    $('textarea[name=industry_observations]').val("<?php echo $user['industry_observations'];?>");
                    $('textarea[name=biggest_complaint]').val("<?php echo $user['biggest_complaint'];?>");
                    $('textarea[name=biggest_job_hurdles]').val("<?php echo $user['biggest_job_hurdles'];?>");
                    $('textarea[name=continuing_education]').val("<?php echo $user['continuing_education'];?>");
                   
                    */
                });
            </script>
            
            <?php }
            
            /** CHECK POST ***/
            
            if($_POST['updateRec'] && $_POST['id']){
                //print_r($_POST);
                extract($_POST);
            ///
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
                $charset = 'utf8mb4';
                $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=$charset";
                $opt = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $opt);
                
                
            //PUT RESUME IN PROPER LOCATION            
                $data = array();
                $includeUploadinSql = false;
                $uploadOk = false;
                $uploadfile_url = '';
                
                //create folder based on base64 encoded email address
                $uploaddir = 'uploads/'. base64_encode($_POST['email']) .'/'  ;
                if (!file_exists($uploaddir)) {
                    mkdir($uploaddir);
                }
                
                
                $fileType = strtolower(pathinfo(basename($_FILES["resume"]["name"]) ,PATHINFO_EXTENSION));
                
            
                //CHECK FILE TYPE
                if($imageFileType == "doc" || $imageFileType == "docx" || $imageFileType == "pdf"){
                    //good to go
                    $uploadOk = true;
                }
                
                $uploadfile = $uploaddir . time() .'-' . basename($_FILES['resume']['name']);
                        
                if (move_uploaded_file($_FILES["resume"]["tmp_name"], $uploadfile)) {
                    $uploadfile_url = 'http://eyerecruit.com/__lists/seeker-leads/' . $uploadfile;
                    $includeUploadinSql = true;
                    $msg = "The file ". basename( $_FILES["resume"]["name"]). " has been uploaded to: ".$uploadfile_url;
                } else {
                    $msg = "Sorry, there was an error uploading your file.";
                }
                //mail('jeremy@interfused-inc.com','debugging message',$msg);

                
                //UPDATE DB RECORD
                
                
                if($includeUploadinSql){
                    $sql = "UPDATE `__leads-seeker` SET first_name = ?, last_name = ?, resume_location = ?, email = ?, phone = ?, industry = ?, contact_source = ?, zip = ?, desired_salary_range = ?,
                    any_changes = ?, daily_duties = ?, industry_history = ?,looking_for = ?,how_last_job_found = ?,any_other_recruiters = ?,current_applications_results = ?,ideal_career = ?,why_left_last_job = ?,desired_companies = ?,who_met_with = ?,most_important_career_factor = ?,industry_observations = ?,biggest_complaint = ?,biggest_job_hurdles = ?,continuing_education = ?
                     WHERE id = ?";
                    $pdo->prepare($sql)->execute([$first_name, $last_name, $uploadfile_url, $email, $phone, $industry, $contact_source, $zip, $SALARY_REQ,$any_changes,$daily_duties,$industry_history,$looking_for,$how_last_job_found,$any_other_recruiters,$current_applications_results,$ideal_career,$why_left_last_job,$desired_companies,$who_met_with,$most_important_career_factor,$industry_observations,$biggest_complaint,$biggest_job_hurdles,$continuing_education, $id]);    
                }else{
                    $sql = "UPDATE `__leads-seeker` SET first_name = ?, last_name = ?, email = ?, phone = ?, industry = ?, contact_source = ?, zip = ?, desired_salary_range = ?, any_changes = ?, daily_duties = ?, industry_history = ?,looking_for = ?,how_last_job_found = ?,any_other_recruiters = ?,current_applications_results = ?,ideal_career = ?,why_left_last_job = ?,desired_companies = ?,who_met_with = ?,most_important_career_factor = ?,industry_observations = ?,biggest_complaint = ?,biggest_job_hurdles = ?,continuing_education = ? WHERE id = ?";
                    $pdo->prepare($sql)->execute([$first_name, $last_name, $email, $phone, $industry, $contact_source, $zip, $SALARY_REQ,$any_changes,$daily_duties,$industry_history,$looking_for,$how_last_job_found,$any_other_recruiters,$current_applications_results,$ideal_career,$why_left_last_job,$desired_companies,$who_met_with,$most_important_career_factor,$industry_observations,$biggest_complaint,$biggest_job_hurdles,$continuing_education, $id]);
                }
                
            ////
                ?>
                <p>Updating... please wait</p>
                <script>
                    setTimeout(function(){
                        window.location.href = "http://eyerecruit.com/__lists/seeker-leads/?id=<?php echo $id;?>";    
                    },5000);
                    
                </script>
                
                <?php
                die();
            }
            
            
            die();
/*
    //notify chris
        $msg = 'check http://eyerecruit.com/__lists/seeker-leads/ for details on '.$first_name.' '.$last_name.' who subscribed from '.$contact_source;
        $headers[] = 'From: noreply@eyerecruit.com';
    //$to_email = 'jeremy@interfusedcreative.com';
        $to_email = 'chris.bauer@eyerecruit.com';
        mail ( $to_email , 'new subscriber from secondary domain' , $msg, implode("\r\n", $headers) );



//
    echo json_encode($data);
*/
    ?>
</div>
</body>
</html>
