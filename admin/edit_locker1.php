<?php
session_start();
// error_reporting(0);

include("partial/header.php");
include("../../theme/config.php");

?>

<style>
    .flex-form {
        display: flex;
    }
</style>
<?php 
                    $id=$_GET['id'];
                    $a= "SELECT * FROM [SERE].[dbo].[tbl_code_locker] ";


                    $actionsum= sqlsrv_query($conn, $a);
                    $no=1;
                        ?>

<div class="content-wrapper">
    <section class="content-header" hidden>
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid bg-green">

                </div>
            </div>
        </div>
        <div class="card card-outline" style="padding: 2px 15px 0px 15px; margin-top: 30px;">
            <div class="row">
                <div class="col-12 col-md-12">
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-success" style="">
                        <div class="box-header bg-success" style="height: 80px; line-height: 80px;">
                            <div
                                style="display: flex; flex-direction: row; justify-content: space-between; padding-left: 30px; padding-right: 30px;">
                                <h3 class="box-title" style="line-height: 80px;"> Edit Data Locker</h3>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" class="form-horizontal mt-5" action="submit_action.php"
                                        id="submit_action" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Locker ID :</label>
                                            <input type="text" class="form-control" name="date" style="width: 40%"
                                                value="<?= $data['insp_date']; ?>" id="date">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Name :</label>
                                            <input type="text" class="form-control" name="location" style="width: 40%"
                                                value="<?= $data['location']; ?>" id="location">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">SESA :</label>
                                            <input type="text" class="form-control" name="check" style="width: 40%"
                                                value="<?= $data['check_a']; ?>" id="check">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Gender :</label>
                                            <input type="text" class="form-control" name="aknowledge" style="width: 40%"
                                                value="<?= $data['aknowledge']; ?>" id="aknowledge">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Department :</label>
                                            <input type="text" class="form-control" name="action" style="width: 40%"
                                                value="<?= $data['action']; ?>" id="action">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Plant :</label>
                                            <input type="text" class="form-control" name="actionby" style="width: 40%"
                                                value="<?= $data['actionby']; ?>" id="actionby">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">No.Phone :</label>
                                            <input type="text" class="form-control" name="responsible"
                                                style="width: 40%" value="<?= $data['responsible']; ?>"
                                                id="responsible">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Address :</label>
                                            <input type="text" class="form-control" name="location" style="width: 40%"
                                                value="<?= $data['location']; ?>" id="location">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">End Date :</label>
                                            <input type="text" class="form-control datepicker" style="width: 40%"
                                                name="actual_date" id="actual_date"
                                                value="<?php echo date('m/d/Y',strtotime($data['actual_date'])); ?>">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;">Image :</label>
                                            <input type="text" class="form-control" name="location" style="width: 40%"
                                                value="<?= $data['location']; ?>" id="location">
                                        </div>

                                        <div class="form-group"
                                            style="display: flex; flex-direction: row; line-height: 40px;">
                                            <label for="" style="width: 15%;"></label>
                                            <button class="btn btn-success mr-3" data-loading-text="Loading..."
                                                name="btn-input"> Submit</button>
                                            <a href="data_lockers.php" class="btn btn-danger"> Cancel</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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



<script type="text/javascript">
    $('.datepicker').datepicker({
        startDate: '-3d',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
    });
</script>

    
<script>
    function submit_act() {
        Swal.fire({
            title: 'Are You Sure?',
            text: "Data will be updated!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    $("#submitaction").submit();
                    $('#submit_action.php').modal('hide');
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
    }
</script>