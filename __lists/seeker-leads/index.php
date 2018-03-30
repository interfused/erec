<?php 
/*
  $allowed_ips = array('76.108.131.107');
  if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
    die('NOPE');
}
*/
?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Jura:400,600,700|Open+Sans:400,600,700,800|Open+Sans+Condensed:300" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link rel='stylesheet' type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php // https://github.com/Abban/jQuery-Ajax-File-Upload ?>
  <script src="js/jquery-fileupload.min.js"></script>
</head>
<body>

<h1 class="wrapper">EyeRecruit Seeker Leads
<!-- <div class="fineprint">Use to manage seekers who ARE NOT in the wordpress system</div> -->

</h1>
  <div id="main_wrapper" class="wrapper">
    
    <div id="left_col">
      <?php include('user_list.php');?>
    
    <button id="show_add_form"><i class="fa fa-plus"></i> Add New User</button>

    </div>

    <div id="right_col">
     <button id="back_to_list"><i class="fa fa-angle-left"></i> Back to user list</button>

    <?php include('form-add-new-user.php');?>
    <?php include('single-user-details.php');?>
    <?php include('single-user-notes.php');?>
    </div>
    
    

  </div>

  <script>
  $("#show_add_form").click(function(){
    $("#right_col,#add_new_user_form").show();
    $("#user_detail, #add_user_note_form").hide();
  });

  $("input[name=email]").change(function(event) {
    /* Act on the event */
    $("#submit_new_user").removeAttr('disabled');
  });

  $('#submit_new_user').on('click', function(e) {
    e.preventDefault();
    var file_data = $('#resume').prop('files')[0];   
    var form_data = new FormData( $('#add_new_user_form')[0] );                  
    form_data.append('file', file_data);
    console.log('///// FORM DATA');
    console.dir(form_data);                             
    $.ajax({
                url: 'add2.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    console.log('SUCCESS: '+php_script_response); // display response from the PHP script, if any
                    location.reload();
                  },
                  error: function(php_script_response){
                    console.log('WTF: '+php_script_response); // display response from the PHP script, if any
                  }
                });
  });

/* USER SELECTOR */
$('.user_selector').click(function(){
  $("#main_wrapper").addClass('detail_view');
  $("#right_col").show();
  var userid = $(this).data('userid');
  $("#editUserBtn").attr('href','update.php?id='+userid);
  
  $('#user_detail, #add_user_note_form').show();
  $("#add_new_user_form").hide();
    
  var parentEl = $(this).closest('li');
  $("#user_detail #info").empty();
  parentEl.find('.contact_info').clone().appendTo("#user_detail #info");
  var display_name = parentEl.find('span.first_name').text() ;
  display_name += ' '+parentEl.find('span.last_name').text() ;
  $("#user_detail h2 span").text(display_name);
  //grab user notes
  $('input[name=user_id]').val(userid);
  console.log('userid: '+userid);
  get_user_notes();
});

$("#back_to_list").click(function(){
  $("#right_col").hide();
  $("#main_wrapper").removeClass('detail_view');
});

/* USER NOTES */
function get_user_notes(){
    var fetchURL = 'get-user-notes.php';

    if($("#user_detail span#userid").text().length > 0){
      fetchURL += '?user_id=' + $("#user_detail span#userid").text();
    }

    console.log('////REFRESH USER NOTES FOR  ' + fetchURL);
    $.ajax({
                url: fetchURL, // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,                         
                type: 'get',
                success: function(php_script_response){
                    console.log('SUCCESS GET NOTES: '+php_script_response); // display response from the PHP script, if any
                    $("#user_notes_wrapper .container").empty().append(php_script_response);
                  },
                  error: function(php_script_response){
                    console.log('WTF GET NOTES: '+php_script_response); // display response from the PHP script, if any
                  }
                });
  }

  $('#btn-add-user-note').on('click', function(e) {
    e.preventDefault();
    console.log('clicked');
//    var file_data = $('#resume').prop('files')[0];   
    var form_data = new FormData( $('#add_user_note_form')[0] );                  
    //form_data.append('file', file_data);
    console.log('///// FORM DATA');
    console.dir(form_data);                             
    $.ajax({
                url: 'add-user-note.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    console.log('SUCCESS NOTE: '+php_script_response); // display response from the PHP script, if any
                     $('#add_user_note_form')[0].reset();
                     get_user_notes();
                  },
                  error: function(php_script_response){
                    console.log('WTF NOTE: '+php_script_response); // display response from the PHP script, if any
                  }
                });
  });

</script>

<?php
if($_GET['id']){ ?>
<script>
  $(document).ready(function(){
    $(".user_list a[data-userid=<?php echo $_GET['id'];?>]").trigger('click');
  });
</script>
<?php } ?>

</body>
</html>