<?php 
// session_set_cookie_params(3600*3600*24*5, "/");
session_start();
error_reporting(0);
include("../../theme/config.php");
include("partial/header.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="100% !important">
    <!-- Content Header (Page header) -->
    <section class="content">
    <section class="content-header">
		
    </section>
    <?php
    error_reporting(0);
    if ($_GET['updated_pass']=='1') {
        echo "<div class='alert alert-success alert-dismissable' style='position: center; top: 1; left: 0; width: 100%; z-index:1001;'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Changed successfully.</strong>
            </div>";
      }
    ?>
        <?php
        include "../config.php";
        $id = $_SESSION['iduser'];
        $sql = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE id_user='$id'");

        while ($data = sqlsrv_fetch_array($sql)) {
            ?>
            <form class="form-horizontal" action="updateuser.php" method="post" enctype="multipart/form-data">
                <div class="box box-solid box-success" style="width:100%">
                    <div class="box-header">
                        <h3 class="box-title">User Control</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group col-sm-12">
                        <input type="hidden" name="id" value="<?= $id ?>">
                            <label class="control-label col-sm-2" for="username">Username :</label>
                            <div class="col-sm-10">
                                <input type="text" id="username" name="username" maxlength="100" class="form-control" value="<?php echo $data['username']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="level_user">Level User :</label>
                            <div class="col-sm-10">
                                <input type="text" id="level_user" name="level_user" maxlength="100" class="form-control" value="<?php echo $data['user_level']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="user_plant">Plant :</label>
                            <div class="col-sm-10">
                                <input type="text" id="user_plant" name="user_plant" maxlength="100" class="form-control" value="<?php echo $data['plant']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="name">Name :</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" maxlength="100" class="form-control" value="<?php echo $data['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="ask">Recovery Question :</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Old Question" value="<?php echo $data['ask']; ?>" readonly>
                            <select class="form-control" id="ask" name="ask">
                                <option value="" disabled selected>Select new Question</option>
                                <option value="Apa makanan kesukaan anda?">Apa makanan favorit mu?</option>
                                <option value="Apa permainan kesukaan anda?">Apa permainan kesukaan anda?</option>
                                <option value="Apa Hobi anda?">Apa Hobi anda?</option>
                                <option value="Dimana dulu anda sekolah?">Dimana dulu anda sekolah?</option>
                                <option value="Siapa nama hewan peliharaan anda?">Siapa nama hewan peliharaan anda?</option>
							</select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="ans">Recovery Answer :</label>
                            <div class="col-sm-10">
                                <input type="text" id="ans" name="ans" maxlength="100" class="form-control" value="<?php echo $data['ans']; ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="old_pass">Old Password :</label>
                            <div class="col-sm-10">
                                <input type="password" id="old_pass" name="old_pass" maxlength="100" class="form-control" >
                                <br>
                                <input type="checkbox" onclick="showPass1()">Show Password
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="new_pass1">New Password :</label>
                            <div class="col-sm-10">
                                <input type="password" id="new_pass1" name="new_pass1" maxlength="100" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-2" for="new_pass2">Enter New Password Again :</label>
                            <div class="col-sm-10">
                                <input type="password" id="new_pass2" name="new_pass2" maxlength="100" class="form-control">
                                <br>
                            <input type="checkbox" onclick="showPass2()">Show Password
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-lg btn-success"><span class="fa fa-check-circle"></span> Update</button>
                            <a href="index.php" class="btn btn-sm btn-lg btn-default"><i class="fa fa-times-circle"></i> <span> Cancel</span></a>
                        </div>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </section>

</div>

<?php include("partial/footer.php"); ?>
<style>
  .modal-lg {
    max-width: 90%;
  }
</style>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

</aside>
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<style>
    .content-wrapper {
        min-height: 617px !important;
    }
</style>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script><!-- AdminLTE App -->

<script src="dist/js/adminlte.min.js"></script>


<script type="text/javascript">
    function showPass1() {
		var x = document.getElementById("old_pass");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
    function showPass2() {
		var y = document.getElementById("new_pass1");
        var z = document.getElementById("new_pass2");
		if (y.type === "password" && z.type === "password") {
			y.type = "text";
            z.type = "text";
		} else {
			y.type = "password";
            z.type = "password";
		}
	}
</script>

</body>

</html>