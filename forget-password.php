<?php
session_start();
include 'config.php';
if (isset($_SESSION['login']) != "") {
  header('location:' . $_SESSION['login']);
  exit();
}
$attempt_count = intval(@$_COOKIE["forget_count"]); 
  if($attempt_count > 3){
     die("come back in 1 hour");
  }
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forget Password</title>

  <link rel="icon" type="image/png" href="admin/dist/img/favicon.ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="compo/css.css">
</head>


<body class="hold-transition login-page bg-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="color:white"><span class="sentence"></span></a>
    </div>
    <?php
    if (isset($_GET['error'])) {
      echo "<div class='alert alert-danger alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Incorrect Answer or Password.</strong>
				</div>";
    } else if (isset($_GET['success'])) {
      echo "<div class='alert alert-success alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Password changed successfully.</strong>
				</div>";
    }
    ?>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="	login-box-msg">Fill the form to change password</p>


      <form method="post" action="act_pass.php">
        <div class="form-group has-feedback">
          <input type="text" id="username" name="username" class="form-control text-uppercase" placeholder="Username" required autocomplete="off">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <div id="check">
					</div>
        </div>
        <div class="form-group has-feedback">
          <input type="text" id="question" name="question" class="form-control" placeholder="Fill the username first" readonly required>
          <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
        </div>
        <div class="form-group has-feedback">
          <input type="text" id="answer" name="answer" class="form-control" placeholder="Answer the question" required>
          <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password1" name="password1" class="form-control" placeholder="Enter the new password" required>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password2" name="password2" class="form-control" placeholder="Enter the new password again" required>
        <br>
        <a href="index.php">< Back to login page</a>
        </div>
        <br>
        <div class="row">

          <!-- /.col -->
          <div class="col-sm-12">
            <button type="submit" name="btn-pass" class="btn btn-primary btn-block btn-flat">Change Password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>

  <script src="admin/dist/js/typed.min.js"></script>

  <script>
    var typed = new Typed('.sentence', {
      strings: ['Locker Apps', 'Schneider-Electric'],
      typeSpeed: 50,
      backSpeed: 30,
      smartBackspace: true,
      loop: true
    });
  </script>
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <script>
$(document).ready(function(){
	$('#username').keyup(autoname);

}
);
function autoname(){
  document.getElementById("check").innerHTML = "Checking...";
	$('#question').val('');
  var quest = $('#question');
  var disabled = quest.find(':input:disabled').removeAttr('disabled');
	var txt = $(this).val();
	$.ajax({
		url:"autoquest.php",
		method:"post",
		data:{search:txt},
		dataType:"text",
		success:function(data){
			$('#question').val(data);
      document.getElementById("check").innerHTML = "";
      disabled.attr('disabled','disabled');
		}
	});
}
</script>
</body>

</html>