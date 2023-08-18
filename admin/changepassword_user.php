<?php
    // session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header.php");



    $id2 = $_SESSION['userid'];
    $id = $_POST['id'];
    // var_dump($id);
    $sql = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE id_user = $id2");
    // if ($sql) {
        $data = sqlsrv_fetch_array($sql);

?>

<div class="content-wrapper" style="background-color:#d9d9d9">
	</section> 
	<section class="content-header">
    <div class="container-fluid">
                <div class="card" style="width: 95%" cellpadding="2">
                    <div class="card-header bg-success">
                    <div class="row">
                        <div class="col-sm-8 float-center">
					Change Password
				</h3>
			</div>
        </div>
    </div>


        
<div class="box-body">
        <div class="form-group  col-md-offset-6">
            <label class="control-label col-sm-2" for="name_user">Name</label>
            <div class="col-sm-10">
                <input type="text" id="name_user" name="name_user" maxlength="100" class="form-control" value="<?php echo $data['name']; ?>" disabled>
            </div>
        </div>

        <div class="form-group  col-md-offset-6">
            <label class="control-label col-sm-2" for="username_user">Username</label>
            <div class="col-sm-10">
                <input type="text" id="username_user" name="username_user" maxlength="200" class="form-control" value="<?php echo $data['username']; ?>" disabled>
            </div>
        </div>

        <div class="form-group  col-md-offset-6">
            <label class="control-label col-sm-2" for="new_pass">New Password</label>
            <div class="col-sm-10">
                <input type="password" id="new_pass" name="new_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

        <div class="form-group col-md-offset-8">
            <label class="control-label col-sm-2" for="confirm_pass">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" name="confirm_pass" id="confirm_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-10">
                <button name="btn_change" class="btn btn-sm btn-lg btn-success"><i class="fa fa-save"></i> Save</button>
                <button type="button" class="btn btn-sm btn-lg btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
    </div>
            </div>
    </section>
    </div>

    <?php include("partial/footer.php"); ?>
    <style>
    .modal-lg {
        max-width: 90%;
    }
    </style>



	<script src="../../theme/jquery/jquery.min.js"></script>
	<script src="../../theme/bootstrap/js/bootstrap.js"></script>
	<script src="../../theme/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../theme/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../theme/datatables/jquery.dataTables.min.js"></script>
	<script src="../../theme/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../theme/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../../theme/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="../../theme/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../../theme/sweetalert/sweetalert2.min.js"></script>
	<script src="../../theme/lte/js/adminlte.min.js"></script>
	<script src="../../theme/select2/js/select2.full.js"></script>
	<script src="../../theme/select2/js/select2.js"></script>
	<script src="../../theme/selecpicker/bootstrap-select.min.js"></script>
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<script>
    $("button[name=btn_change]").on("click", function() {
        var id = $('#id').val();
        //var old_pass = $('#old_pass').val();
        var new_pass = $('#new_pass').val();
        var confirm_pass = $('#confirm_pass').val();

        $.ajax({
            type: "POST",
            url: "changepassword.php",
            data: {
                id: id,
                //old_pass: old_pass,
                new_pass: new_pass,
                confirm_pass: confirm_pass,
                name: name,
                username: username
            },
        }).done(function(msg) {
            if (msg == "success") {
                alert("Password Has Been Change");
                location.reload();
            } else if (msg == "old_pass") {
                alert("Old Password not Match");
            } else {
                alert("New Password not Match");
            }

        })
    })
</script>
