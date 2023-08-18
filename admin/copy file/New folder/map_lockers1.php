<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    // error_reporting(0);
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
                              <h3 style="text-align: center;"><strong> Map Lockers </strong></h3>
                            </div>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br>
                  <div class="card-header bg-info">
                    <div class="row">
                    
                      
                      <div class="col-md-2">
                        <label>Plant</label>
                        <select onchange="filterByPlant()" class="form-control selectpicker show-tick" id="select_plant"
                          name="location" data-style="btn btn-default" data-size="5" data-live-search="true">
                          <?php 
                                    $sql = "SELECT * from mst_plant order by id_plant";
                                    $sqlres = sqlsrv_query($conn, $sql);
                                    while ($res = sqlsrv_fetch_array($sqlres)) {
                                        echo "<option value='".$res['id_plant']."' >".$res['plant']."</option>";
                                    }
                                ?>
                        </select>
                      </div><br>

                     
                      <div class="col-md-2">
                        <label>Area</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="selectlocation"
                          name="location" data-style="btn btn-default" data-size="5" data-live-search="true">
                          <?php 
                                    $sql = "SELECT * from mst_area order by id_area";
                                    $sqlres = sqlsrv_query($conn, $sql);
                                    while ($res = sqlsrv_fetch_array($sqlres)) {
                                        echo "<option value='".$res['id_area']."' >".$res['area']."</option>";
                                    }
                                ?>
                        </select>
                      </div><br>

                      <div class="col-md-2">
                        <label>Area</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" name="status[]"
                          id="status" style="width : 100%" multiple>
                          <!-- <option disabled selected value> -- select an option -- </option> -->
                          <option value="open" selected>Office</option>
                          </option>
                          <option value="close" selected>Sub Floor</option>
                        </select>
                      </div><br>


                      <div class="col-md-2">
                        <label>Floor</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="location"
                          name="location" data-style="btn btn-default" data-size="5" data-live-search="true">
                          <?php 
                                    $sql = "SELECT * from mst_floor order by id_floor";
                                    $sqlres = sqlsrv_query($conn, $sql);
                                    while ($res = sqlsrv_fetch_array($sqlres)) {
                                        echo "<option value='".$res['id_floor']."' >".$res['floor']."</option>";
                                    }
                                ?>
                        </select>
                      </div><br>

                  

                      <div class="col-md-2">
                        <label>Department</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="location"
                          name="location" data-style="btn btn-default" data-size="5" data-live-search="true">
                          <?php 
                                    $sql = "SELECT * from mst_dept order by id_dept";
                                    $sqlres = sqlsrv_query($conn, $sql);
                                    while ($res = sqlsrv_fetch_array($sqlres)) {
                                        echo "<option value='".$res['id_dept']."' >".$res['dept']."</option>";
                                    }
                                ?>
                        </select>
                      </div><br>

                      
                      
                      
                    </div>
                  </div>
                  
                  <section class="content" style="min-height: 100px;">
          <div class="card-block">
            <div class="box" style="width:100%">
                
                <!-- /.box-header -->
              
                <div class="row" id="tbl_priority">
                  <div class="col-md-12">
                    <div class="card">
                      
                      <!-- /.box-header -->
                      <div class="card-body center">
                       
                      <!-- /.locker -->
                        <div class="col-md-12 table-responsive">
                          <div id="tb_user">
                            <table style="margin-right: 10px">
								<!--  -->
								<tr>
                  <div class="row">
                    <div class="col-md-1">
                      <?php
                        $qry3 = sqlsrv_query($conn, "select * from [SERE].[dbo].[tbl_code_locker] where locker_id='A001' or locker_id='A002' or locker_id='A003' or locker_id='A004' or locker_id='A005' or locker_id='A006'", array(), array("Scrollable"=>SQLSRV_CURSOR_KEYSET));
                        while($c=sqlsrv_fetch_array($qry3)){
                          $kol = $c['locker_id'];
                          $kol1 = $c['sesa'];
                          $kol2 = $c['department']; 
                          $kol3 = $c['plant']; 
                      ?>
                      <div style='margin-bottom: 10px;'>
                        <div align="center" data-target="#ModalDetailGambar" data-whatever="<?php echo $data['locker_id']; ?>" data-toggle="modal"class='border border-5 border-dark'>
                          <?php if ($kol1 != '-' && $kol2 != '-' && $kol3 != '-' && $kol1 != NULL && $kol2 != NULL && $kol3 != NULL){ ?>
                            <img style="width:100%;" src="img/full_locker.png" width="100vw" alt="Berisi . . ."/>
                          <?php } else{ ?>
                            <img style="width:100%;" src="img/empty_locker.png" width="100vw" alt="Kosong . . ."/>
                          <?php } ?>
                        </div>
                        <div style='white-space: nowrap;' class="<?php if($kol1 != '-' && $kol2 != '-' && $kol3 != '-' && $kol1 != NULL && $kol2 != NULL && $kol3 != NULL){ echo 'bg-success';} else { echo 'bg-danger';} ?> text-center text-bold" width="100vw"><?php echo $kol ?> (<?php echo $kol2 ?>)</div>
                      </div>
                      <?php
                        }
                      ?>
                    </div>

                    <div class="col-md-1">
                      <?php
                        $qry3 = sqlsrv_query($conn, "select * from [SERE].[dbo].[tbl_code_locker] where locker_id='A007' or locker_id='A008' or locker_id='A009' or locker_id='A010' or locker_id='A011' or locker_id='A012'", array(), array("Scrollable"=>SQLSRV_CURSOR_KEYSET));
                        while($c=sqlsrv_fetch_array($qry3)){
                          $kol = $c['locker_id'];
                          $kol1 = $c['sesa'];
                          $kol2 = $c['department']; 
                          $kol3 = $c['plant']; 
                      ?>
                      <div style='margin-bottom: 10px;'>
                        <div align="center" data-target="#ModalDetailGambar" data-whatever="<?php echo $data['locker_id']; ?>" data-toggle="modal"class='border border-5 border-dark'>
                          <?php if ($kol1 != '-' && $kol2 != '-' && $kol3 != '-' && $kol1 != NULL && $kol2 != NULL && $kol3 != NULL){ ?>
                            <img style="width:100%;" src="img/full_locker.png" width="100vw" alt="Berisi . . ."/>
                          <?php } else{ ?>
                            <img style="width:100%;" src="img/empty_locker.png" width="100vw" alt="Kosong . . ."/>
                          <?php } ?>
                        </div>
                        <div style='white-space: nowrap;' class="<?php if($kol1 != '-' && $kol2 != '-' && $kol3 != '-' && $kol1 != NULL && $kol2 != NULL && $kol3 != NULL){ echo 'bg-success';} else { echo 'bg-danger';} ?> text-center text-bold" width="100vw"><?php echo $kol ?> (<?php echo $kol2 ?>)</div>
                      </div>
                      <?php
                        }
                      ?>
                    </div>
                    
                    
                   

                  </div>
								</tr>
								<!--  -->
                            </table>
                          </div>
                        </div>
                        <div class="" style="color:black; margin-top: 10px;" >
                          <p class="text-danger" class="w-75">Locker Full</p>
                          <p class="text-success">Locker Empty</p>
                      </div>
                    </div>
                  </div> 

            </div>

            <div class="modal fade" id="ModalDetailGambar" tabindex="-1" role="dialog" aria-labelledby="upload-avatar-title" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header box-solid bg-info">
                        <h3 class="modal-title" id="memberModalLabel">Data Locker</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    
                    <div class="modal-content" >
                      <span class="pull-right">
                                <div class="modal-body" id="info_update" >
                                    <div class="" style="color:black; margin-top: 30px;" align="center">
                                      <img src="img/profile.png" width="200vw"/>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-9 col-form-label">Locker ID </label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SESA</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gender</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Department</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Plant</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No.Phone</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">End Date</label>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>

                            </div>
                        </div>
                      </span>
                    <div class="dash">
                        <!-- Content goes in here -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        </div>   
    </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>
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
  $('#ModalDetailGambar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "showapar.php",
            data: dataString,
            cache: false,
            success: function(data) {
                console.log(data);
                $('.dash').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    })

    function filterByPlant() {
    var plant = $('#select_plant').val();
    alert(plant);

  

    $.ajax({
      type: 'POST',
      data: {
        plant: plant,

      },
      url: 'filteraction.php',
      success: function (resp) {
        $data = resp.split('|||');
        $('#respons').html($data[0]);
      
      }
    })
  }



  $(document).ready(function () {
    $('#tablesum').DataTable();
  });
</script>

</html>