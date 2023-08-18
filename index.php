<?php
session_set_cookie_params(3600*3600*24*5, "/");
session_start();
include ("config.php");
if (isset($_SESSION['login']) != "") {
  header('location:' . $_SESSION['login']);
  exit();
}
  
// before login attempt:
  $attempt_count = intval(@$_COOKIE["login_count"]); 
  if($attempt_count > 10){
     die("Too many attempts, you are unable to login for 10 minutes");
  }
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SERE Apps | Schneider Electric</title>

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
  <!--<link rel="stylesheet" href="plugins/iCheck/square/blue.css">-->


  <!-- Google Font -->
  <link rel="stylesheet" href="compo/css.css">
</head>


<body class="hold-transition login-page bg-page bg-success-gradient" style="background-color:#2bc454">

  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="color:white"><span class="sentence"></span></a>
    </div>
    <?php
    if (isset($_GET['error'])) {
      echo "<div class='alert alert-danger alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Username or Password not correct.</strong>
        </div>";
        
    } else if (isset($_GET['status'])) {
      echo "<div class='alert alert-success alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Logout successfully.</strong>
				</div>";
    }
    ?>
    <div class="card">
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Please Login</p>


      <form method="post" action="act_login.php">
        <div class="form-group has-feedback">
          <!--<input type="text" name="username" class="form-control text-uppercase" placeholder="Username" required autocomplete="off">-->
          <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" id="myInput" required>
          <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
          <span class="glyphicon glyphicon-eye-open form-control-feedback" id="tooglepassword" onclick="myFunction()" style="cursor:pointer;pointer-events: initial;"></span>
          <br>
          <a href="forget-password.php">Forget Password</a>
        </div>
        <br>
        <div class="row">
          <!-- /.col -->
          <div class="col-sm-12">
            <button type="submit" name="btn-login" class="btn btn-success btn-block btn-flat">Login</button><br>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-sm-12">
            <a href="act_register.php" class="btn btn-warning btn-block btn-flat" role="button">Register
            </a>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <!--<script src="plugins/iCheck/icheck.min.js"></script>-->

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
      var tooglepass = document.getElementById("tooglepassword");
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
        tooglepass.classList.remove("glyphicon-eye-open");
        tooglepass.classList.add("glyphicon-eye-close");
      } else {
        x.type = "password";
        tooglepass.classList.remove("glyphicon-eye-close");
        tooglepass.classList.add("glyphicon-eye-open");
      }
    }
  </script>
</body>

</html>