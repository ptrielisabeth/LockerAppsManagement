<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);

	if ($_SESSION['userlevel'] == 'admin' ){

    include("../../theme/config.php");
    include("partial/header.php");

    $end_date = date('Y-m-d');
    $msd_plants= $_SESSION['userplant'];

?>

<style>
	.flex-form
	{
		display:flex;
	}
</style>


<div class="content-wrapper" style="100% !important">
	</section> 
	<section class="content">
		<div class="box" style="width:100%">
			<div class="box-header"  style="height: 80px; line-height: 80px;">
				<h3 class="box-title"style="line-height: 80px; margin-left: 10px" >
					User Management
					<a href="#"><button class="btn btn-xl btn-success" name="add" data-target="#ModalAdd" data-toggle="modal">
							<span class="fa fa-plus"></span> Add User
						</button></a>
				</h3>
			</div>
			<!-- /.box-header -->
				
			<div class="card-body">
    				<div class="col-12 table-responsive">
					<table id="example1" class="table table-bordered table-striped table-condensed">
						<thead>
							<tr class="bg-info" style='font-size:16'>	
								<th>No.</th>
								<th>Username</th>
								<th>Name</th>
								<th>Plant</th>
								<th>Level User</th>
								<th style="colspan:2">Action</th>
							</tr>
						</thead>
						<?php
						include("../../theme/config.php");
						$a = explode(',', $msd_plants);
						$b = "";
						for ($i=0; $i < sizeof($a); $i++) { 
							$b .= "'".$a[$i]."',";
						}
						$b .= "'".'a'."'";
						// if($msd_plants=='All'){
							$hasil = sqlsrv_query($conn, "SELECT * FROM tb_user_locker");
							$ex = "SELECT * FROM tb_user_locker";
						// } else {
							
						// 	$hasil = sqlsrv_query($conn, "SELECT * FROM mst_users WHERE plant IN ($b)");
						// 	$ex = "SELECT * FROM mst_users WHERE plant IN ($b)";
						// }
						
						// // echo $ex;
						// echo $ex;

						$no = 1;
						while ($data = sqlsrv_fetch_array($hasil)) {
							?>
							<tr style='font-size:16' align=' center'>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['username']; ?></td>
								<td><?php echo $data['name']; ?></td>
								<td><?php echo $data['plant']; ?></td>
								<td><?php echo $data['user_level']; ?></td>
								
								<td>
									<a class="btn btn-xl btn-danger" data-target="#ModalDelete" data-href='deleteuser.php?name=<?php echo $data['name']; ?>' data-toggle="modal"><i class="fa fa-trash">&nbsp;</i>Delete</a>
									<a class="btn btn-xl btn-warning" data-id="<?= $data['id_user'] ?>" data-role="pop"><i class="fa fa-cog">&nbsp;</i>Change</a>
								</td>
								
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-default">
				<div class="modal-content">
					<div class="modal-header box-solid bg-success">
					<h4 class="modal-title" id="ModalLabel">&nbsp;Alert</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<div>
						<div class="modal-body">
							<p class="text-secondary"> Are you sure delete this data? </p>
						</div>
						<div class="modal-footer">
							<a class="btn btn-success btn-ok"><i class="fa fa-check"></i> Yes</a>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-bg">
				<div class="modal-content">
					<div class="modal-header box-solid bg-green">
						<h4 class="modal-title" id="memberModalLabel">Add User</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

					</div>
					<div>
						<form role="form" class="form-horizontal" action="add_user.php" method="get">
							<div class="modal-body">

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="username">Username :</label>
									<div class="col-sm-8">
										<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
										<input type="text" id="username" name="username" maxlength="50" class="form-control" value="<?php echo $data['username']; ?>" required>
										<div id="check"></div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="name">Name :</label>
									<div class="col-sm-8">
										<input type="text" id="name" name="name" maxlength="50" class="form-control" value="<?php echo $data['name']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="password">Password :</label>
									<div class="col-sm-8">
										<input type="password" name="password" id="myInput" maxlength="50" class="form-control" value="<?php echo $data['password']; ?>" required>
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
										<select class="form-control" id="user_plant" name="user_plant" <?php if($user_plant!=='All') ?>>
											<option selected>Select Plant</option>
											<option value="All">All</option>
											<option value="BLP" <?php if($user_plant=="BLP"){echo "selected";} ?>>BLP</option>
											<option value="PEL" <?php if($user_plant=="PEL"){echo "selected";} ?>>PEL</option>
											<option value="PEM" <?php if($user_plant=="PEM"){echo "selected";} ?>>PEM</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="user_level">Level :</label>
									<div class="col-sm-8">
										<select class="form-control" id="user_level" name="user_level">
											<option disabled selected>Select User Level</option>
											<option value="admin">Admin</option>
											<option value="User">User</option>
											<option value="PIC">PIC</option>
											<option value="Keeper">Keeper</option>
										</select>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="submit" name="btn-input" id="btn-input" class="btn btn-success"><i class="fa fa-save" disabled></i> Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</section>
</div>
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-bg">
		<div class="modal-content">
			<div class="modal-header box-solid bg-green">
				<h4 class="modal-title" id="memberModalLabel">Change Password</h4>
			</div>
			<div class="modal-body" id="data_modal">
			</div>
		</div>
	</div>
</div>
<footer class="main-footer">
	<!-- To the right -->
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0 Beta
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; 2018<a href="https://www.schneider-electric.co.id" target="_blank"> Schneider Electric Manufacturing Batam</a>.</strong> All rights
</footer>

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

<!-- jQuery 3 -->
<style>
	.content-wrapper {
		min-height: 613px !important;
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
	<script src="theme/selecpicker/bootstrap-select.min.js"></script>
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>




<script>
	$(document).ready(function() {
		$('#ModalDelete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		
		});
	});


	function changepass(id_user) {
            
            $.ajax({
            url : 'get_user.php',
            type : 'POST',
            data: {id_user : id_user},
            success: function (data) {
                    $('#data_modal').html(data);
					$('#ModalEdit').modal();
            }
        })
    }

    $(document).ready(function() {
		$('a[data-role=pop]').click(function() {
			var id = $(this).data("id");

			$.ajax({
				url:'get_user.php',
				type: 'post',
				data: {id: id},
				success:function(data){
					// var row = JSON.parse(data);
					// console.log(data);
					$("#data_modal").html(data);
					$('#ModalEdit').modal();
				}
			});
		})
	});
</script>


<script>
	$(document).ready(function() {
		$('#example1').DataTable({
			paging: true,
			lengthChange: true,
			searching: true,
			ordering: true,
			info: true,
			autoWidth: false
		})
	})

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
	$('#name').val('');
	var txt = $(this).val();
	$.ajax({
		url:"process/autoname.php",
		method:"post",
		data:{search:txt},
		dataType:"text",
		success:function(data){
			$('#name').val(data);
		}
	});
}
</script>

</body>

</html>
<?php 
} else {
	echo "<h4> You don't have access </h4>";
	
}

?>

