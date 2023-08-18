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

<style>
	.flex-form
	{
		display:flex;
	}
</style>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>

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
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Register Failed.</strong>
				</div>";
    } else if (isset($_GET['success'])) {
      echo "<div class='alert alert-success alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Register successfully.</strong>
				</div>";
    }
    ?>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="	login-box-msg">Fill the form to register</p>


      <form role="form" class="form-horizontal" action="http://10.155.152.114/sere-apps/sere/lockers2/admin/add_user2.php" method="GET">
							<div class="modal-body">

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="username">Username :</label>
									<div class="col-sm-8">
										<input type="hidden" name="id" value="">
										<input type="text" id="username" name="username" maxlength="50" class="form-control" value="" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="name">Name :</label>
									<div class="col-sm-8">
										<input type="text" id="name" name="name" maxlength="50" class="form-control" value="" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="password">Password :</label>
									<div class="col-sm-8">
										<input type="password" name="password" id="myInput" maxlength="50" class="form-control" value="" required>
										<br>
										<input type="checkbox" onclick="myFunction()">Show Password
									</div>
								</div>
                
								<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="ask">Recovery Question :</label>
								<div class="col-sm-8">
								<select class="form-control" id="ask" name="ask">
									<option value="" disabled selected>Select Question</option>
									<option value="Apa makanan kesukaan anda?">Apa makanan favorit mu?</option>
									<option value="Apa permainan kesukaan anda?">Apa permainan kesukaan anda?</option>
									<option value="Apa Hobi anda?">Apa Hobi anda?</option>
									<option value="Dimana dulu anda sekolah?">Dimana dulu anda sekolah?</option>
									<option value="Siapa nama hewan peliharaan anda?">Siapa nama hewan peliharaan anda?</option>
								</select>
								</div>

							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="ans">Recovery Answer :</label>
								<div class="col-sm-8">
									<input type="text" id="ans" name="ans" maxlength="100" class="form-control">
								</div>
							</div>
              
							<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="user_plant">Plant :</label>
									<div class="col-sm-8">
                    							<select class="form-control" id="user_plant" name="user_plant">
											<option disabled selected>Select Plant</option>
											<option value="User">BLP</option>
											<option value="PEL">PEL</option>
											<option value="PEM">PEM</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="user_level">Level :</label>
									<div class="col-sm-8">
										<select class="form-control" id="user_level" name="user_level">
											<option disabled selected>Select User Level</option>
											<option value="User">User</option>
											<option value="PIC">PIC</option>
											<option value="Keeper">Keeper</option>
										</select>
									</div>
								</div>
                <br>
                <a href="index.php">< Back to login page</a>
							</div>
							<div class="modal-footer">
								<button type="submit" name="btn-input" id="btn-input" class="btn btn-success"><i class="fa fa-save" disabled></i> Save</button>
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
		url:"process/autoquest.php",
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