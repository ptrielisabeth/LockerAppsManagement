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
                              <h3 style="text-align: center;"><strong> Map Locker </strong></h3>
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
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="plant"
                          name="location" data-style="btn btn-default" data-size="5" data-live-search="true">
                          <?php 
                                    $sql = "SELECT * from mst_plant order by id_plant";
                                    $sqlres = sqlsrv_query($conn, $sql);
                                    while ($res = sqlsrv_fetch_array($sqlres)) {
                                        echo "<option value='".$res['plant']."' >".$res['plant']."</option>";
                                    }
                                ?>
                        </select>
                      </div><br>

                      <div class="col-md-2">
                        <label>Area</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" name="area"
                          id="area" style="width : 100%" multiple>
                          <!-- <option disabled selected value> -- select an option -- </option> -->
                          <option value="1" selected>Office</option>
                          </option>
                          <option value="2" selected>Sub Office</option>
                        </select>
                      </div><br>

                      <div class="col-md-2">
                        <label>Floor</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="floor"
                          name="floor" data-style="btn btn-default" data-size="5" data-live-search="true" multiple>
                          <option value ='1' selected>1st Floor </option>
                          <option value ='2' selected>2nd Floor</option>
                          <option value ='3' selected>3rd Floor</option>
                        </select>
                      </div><br>

                      <div class="col-md-2">
                        <label>Departement</label>
                        <select onchange="filterByStatus()" class="form-control selectpicker show-tick" id="dept"
                          name="dept" data-style="btn btn-default" data-size="5" data-live-search="true" multiple>
                          <option value ='dt' selected>DT </option>
                          <option value ='hr' selected>HR</option>
                          <option value ='tcc' selected>TCC</option>
                        </select>
                      </div><br>



                    </div>
                  </div>
                </div>
                <div id="respons">
                <div class="card-body">
                  <!-- <div id="table2">
                  </div> -->
                 
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

  function filterByStatus() {
    var plant = $('#plant').val();
    var area = $('#area').val();
    var floor = $('#floor').val();
    var dept = $('#dept').val();

    $.ajax({
      type: 'POST',
      data: {
        plant: plant,
        area: area,
        floor: floor,
        dept: dept
        
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

</html>