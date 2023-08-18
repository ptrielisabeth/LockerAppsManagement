<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header.php");

    $msd_plants= $_SESSION['userplant'];
    if ($msd_plants=='SEMB'){
    $msd_plant='PEM';
    }else{$msd_plant= $_SESSION['userplant'];}
    $msd_lantai= 'SNC';
    $msd_line= 'Tesys';
    $msd_cell= 'Tesys - Front Line 1';
    $msd_bench= 'TE-062 Final Tester & Dating';

?>
<style>
  /* The container */
  .containercheckbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-align: center;
  }

  /* Hide the browser's default checkbox */
  .containercheckbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  /* Create a custom checkbox */
  .checkmark,
  .secondcheckmarks {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 25px;
    background-color: #E0E0E0;
  }

  /* On mouse-over, add a grey background color */
  .containercheckbox:hover input~.checkmark,
  .containercheckbox:hover input~.secondcheckmarks {
    background-color: #ccc;
  }

  /* When the checkbox is checked, add a blue background */
  .containercheckbox input:checked~.checkmark {
    background-color: #2196F3;
  }

  .containercheckbox input:checked~.secondcheckmarks {
    background-color: #b5bbc8;
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after,
  .secondcheckmarks:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the checkmark when checked */
  .containercheckbox input:checked~.checkmark:after,
  .containercheckbox input:checked~.secondcheckmarks:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .containercheckbox .checkmark:after,
  .containercheckbox .secondcheckmarks:after {
    left: 9px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }

  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 90%;
    height: 100%;
  }

  .modal {
    overflow: auto !important;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
    </div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="changeData">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-outline">
                  <div class="card-header bg-success">
                    <div class="row">
                      <div class="col-md-10">
                        <div class="col-md-12">
                          <center>
                            <div style="width: 70%; padding-top: 0%;">
                              <h3 style="text-align: center;"><strong> Data Lockers </strong></h3>
                            </div>
                          </center>
                        </div>
                      </div>               
                    </div>
                  </div>

                  <br>
                  <div class="card-header bg-info">
                    <div class="row">

                      <div class="text-left" style="width: 100px; margin-top: 20px; margin-left: 10px;">
                        <button data-toggle="modal" data-target="#ModalAdd" class="btn btn-light"><i class="fa fa-plus"></i> Add New Locker</button>           
                      </div> 

                    </div>
                  </div>

                  <!-- The Modal Add-->
                  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog"
                            aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-bg">
                                <div class="modal-content">
                                    <div class="modal-header box-solid bg-green">
                                    <h4 class="modal-title" id="memberModalLabel">Add New Lockers</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>     
                                    </div>

                                    <!-- /.box-header input form-->
                                    <div class="box-body">
                                        <form role="form" id="saveinput" class="form-horizontal" action="add_locker.php" method="post">
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Locker ID :</label>
                                                    <div class="col-sm-8">
                                                        <input type="locker_id" class="form-control" name="locker_id" id="locker_id"
                                                            value="<?php echo $getType['locker_id']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Name :</label>
                                                    <div class="col-sm-8">
                                                        <input type="name" class="form-control" name="name" id="name"
                                                            value="<?php echo $getType['name']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">SESA :</label>
                                                    <div class="col-sm-8">
                                                        <input type="sesa" class="form-control" name="sesa" id="sesa"
                                                            value="<?php echo $getType['sesa']; ?>" required>
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Gender :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="Type">
                                                            <?php
                                                            $query_type = sqlsrv_query($conn, "SELECT * FROM tbl_gender");
                                                            while ($getType = sqlsrv_fetch_array($query_type)) {
                                                                ?>
                                                            <option value="<?= $getType[0] ?>"><?= $getType[1] ?>
                                                            </option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Department :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="Type">
                                                            <?php
                                                            $query_type = sqlsrv_query($conn, "SELECT * FROM tbl_department");
                                                            while ($getType = sqlsrv_fetch_array($query_type)) {
                                                                ?>
                                                            <option value="<?= $getType[0] ?>"><?= $getType[1] ?>
                                                            </option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Plant :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="Type">
                                                            <?php
                                                            $query_type = sqlsrv_query($conn, "SELECT * FROM tbl_plant");
                                                            while ($getType = sqlsrv_fetch_array($query_type)) {
                                                                ?>
                                                            <option value="<?= $getType[0] ?>"><?= $getType[1] ?>
                                                            </option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">No.Phone :</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="no_hp" id="no_hp"
                                                            value="<?php echo $getType['no_hp']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Address :</label>
                                                    <div class="col-sm-8">
                                                        <input type="address" class="form-control" name="address" id="address"
                                                            value="<?php echo $getType['address']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">End Date :</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control" name="end_date" id="end_date"
                                                            value="<?php echo $getType['end_date']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Upload Image :</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" name="img" id="img"
                                                            placeholder="Input ..."
                                                            value="<?php echo $getType['img']; ?>" required>
                                                    </div>
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="reset" name="reset" class="btn btn-secondary">
                                                        Reset</button>
                                                    <button type="submit" name="submit" class="btn btn-success"></i>
                                                        Save</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                </div>

                  

                
                
              
                <div class="card-body">
                  <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered text-center table-striped table-condensed">
                    <thead class="bg-info">
                        <tr font-size='8' align='center'>
                            <th>No</th>
                            <th>Locker ID</th>
                            <th>Name</th>
                            <th>Talent ID</th>
                            <th>Gender</th>
                            <th>Plant</th>
                            <th>Area</th>
                            <th>Department</th>
                            <th>No.Phone</th>
                            <th>Record Date</th>
                            <th>Update Date</th>
                            <th>Images</th>
                            <th>QR Code</th>
                            <th style="colspan:2">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $a= "  SELECT * FROM [SERE].[dbo].[tbl_locker] ";
                                // echo $a;
                            $actionsum= sqlsrv_query($conn, $a);
                            $no=1;
                            while ($r = sqlsrv_fetch_array($actionsum)) { 
                            ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $r['locker_id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['talent_id'] ?></td>
                            <td><?= $r['gender'] ?></td>
                            <td><?= $r['plant'] ?></td>
                            <td><?= $r['area'] ?></td>
                            <td><?= $r['dept'] ?></td>
                            <td><?= $r['no_phone'] ?></td>
                            <td><?= $r['record_date'] ?></td>
                            <td><?= $r['update_date'] ?></td>
                            <td><?= $r['img'] ?></td>
                            <td>
                              <?php 
                                require_once 'phpqrcode/qrlib.php';
                                $path = 'imgqr/';
                                $qrcode = $path.time(). $r['locker_id'] .".png";

                                QRcode::png($r['locker_id'], $qrcode, 'M');
                                echo "<img src='".$qrcode." 'width='100px' height='100px'>";
                              ?>
                            </td>
                            <td>
                            <form>
                              <button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button>
                            </form>
                            </td>        
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                    
                    
                </table>
            </div>

            <!-- Modal -->
<div id="modal_print" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Printtt</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form target="_blank" method="post" action="process/print_qr_mat3.php">
          <input type="hidden" id="id_qr" name="id">
          <div class="form-group">
            <label for="print_from">Print From</label>
            <input type="number" class="form-control" id="print_from" name="print_from">
            <label for="qty_print">QTY Print</label>
            <input type="number" class="form-control" id="qty_print" name="qty_print">
          </div>
          <center><button type="submit" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> Print</button></center>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- end modal print  -->
                  
                  
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>
  </div>
</div>

<div class="container right-container col-md-6" id="printableArea" style="display:block;">
    <span id="link7">   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 id="school_title"><?php echo "$school_name";?> </h3>
                <p><p> 
               
            </div>
        </div>
        <hr id="line" style="margin-top: 13px;">
        <div class="row q-question-type-style" id='question_section'>
        </div>
    </span>
</div>



<!-- EDIT USER -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1200px!important;">
    <div class="modal-content">
      <div class="modal-header box-solid bg-success">
        <h4 class="modal-title" id="memberModalLabel">Modify Action Summary</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Close</span></button>
      </div>
      <div class="dash">
      </div>
    </div>
  </div>
</div>

<?php include("partial/footer.php"); ?>
<style>
  .modal-lg {
    max-width: 90%;
  }
</style>


<!-- <!?php include("partial/script.php"); ?> -->
</body>

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
<!-- Font Awesome -->
<link rel="stylesheet" href="../../theme/fontawesome-free/css/all.min.css">
<link rel="../stylesheet" href="font-awesome.min.css">

<script>
  // Button DELETE USER
  function del_confirm(id) {
    console.log(id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#dc3545',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      showLoaderOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve, reject) {

          $.ajax({
            type: "POST",
            url: "deleteaction.php",
            data: {
              id: id
            }
          }).done(function (msg) {
            if (msg == "ok") {
              //  location.reload();
              swal.fire("DELETED!", "Data Successfully Deleted!", "success").then(function () {
                location.reload();
              });
            } else {
              swal.fire("Failed!", msg, "warning");
            }
          });
        })
      },
      allowOutsideClick: () => !Swal.isLoading()
    });
  }


  function getDetailGambar1(params) {
    $.ajax({
      type: "POST",
      url: "showgambar.php",
      data: {
        insp_head_id: params
      },
      success: function (data) {
        $('#GambarModal').modal('show');
        console.log(data);
        $('#dasha').html(data);
      },
      error: function (err) {
        console.log(err);
      }
    });
  }

  function filterByStatus() {
    var status = $('#status').val();
    var location = $('#location').val();
    var month = $('#month').val();
  

    $.ajax({
      type: 'POST',
      data: {
        status: status,
        location: location,
        month: month
        
      },
      url: 'filteraction.php',
      success: function (resp) {
        $data = resp.split('|||');
        $('#respons').html($data[0]);
      
      }
    })
  }



  $(document).ready(function () {
    $('#tableact').DataTable();
    filterByStatus();
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

    $('#expired_date').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'yyyy-mm-dd'
    })

    $(function() {
        $('.select2').select2()
        $('#table').DataTable({
            "scrollX": true
        })
    })
</script>

<script>
  function showQRCode(a){
    $('#HasilPrint').modal('show');
    
  }
</script>

<script>
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

</html>