<?php 
session_set_cookie_params(3600*3600*24*5, "/");
session_start();
error_reporting(0);
include("../../theme/config.php");
include("partial/header.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="100% !important">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
                <div class="card" style="width: 95%" cellpadding="2">
                    <div class="card-header bg-success">
                    <div class="row">
                        <div class="col-sm-8 float-center">
					Edit Committee Structure
				</h3>
			</div>
        </div>
    </div>
    </section>
    
    <section class="content">
        <?php
        include("../../theme/config.php");
        $id = $_GET['id'];
        $query = sqlsrv_query($conn, "SELECT * FROM tbl_managechart WHERE id='$id'");

        while ($data = sqlsrv_fetch_array($query)) {
            ?>
            <form class="form-horizontal" action="updatechart.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                <div class="box box-solid box-success" style="width:100%">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title_img">Title : </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input type="text" name="title_img" maxlength="95" class="form-control" value="<?php echo $data['title']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Upload :</label>
                            <div class="col-sm-8">
                                <img class="img-responsive" src="<?php echo 'images/' . $data['img'] ?>" height="10%">
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-8">
                            <button type="submit" a href ="managechart.php" class="btn btn-sm btn-lg btn-success"> Save</button>
                            <a href="managechart.php" class="btn btn-sm btn-lg btn-default"> Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </section>

</div>
<td>
<?php include("partial/footer.php"); ?>
<style>
  .modal-lg {
    max-width: 90%;
  }
</style>
</td>

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
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script><!-- AdminLTE App -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../dist/js/adminlte.min.js"></script>

<!-- <script type="text/javascript">
    function nomor_apar(input) {
        var num = input.value;

        $.post("part.php", {
            dataidpart: num,
        }, function(response) {
            $('#stok').html(response)

            document.getElementById('').focus();
        });
    }
</script> -->

</body>

</html>