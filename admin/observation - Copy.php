<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header.php");

    $id = $_GET['id'];
    $query = sqlsrv_query($conn, "SELECT * FROM tbl_rate WHERE query='$id'");

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
                              <h3 style="text-align: center;"><strong>Observation Lockers </strong></h3>
                            </div>
                          </center>
                        </div>
                      </div>               
                    </div>
                  </div>
                  

                  <br>
                  <div class="card-header bg-info">
                    <div class="row">
                      <div class="row">
                      <div class="text-left" style="width: 165px; margin-top: 32px; margin-left: 5px;">
                        <button data-toggle="modal" data-target="#ModalAdd" class="btn btn-light"><i class="fa fa-plus"></i>&nbspAdd Observation</button>           
                      </div>
                      <div class="text-left" style="width: 200px; margin-top: 32px; margin-left: 3px;">
                        <a href="Locker_Template.xlsx"><button data-toggle="modal" class="btn btn-warning"><i class="fa fa-file"></i>&nbspDownload Template</button></a>      
                      </div>
                      <div class="text-left" style="width: 20px; margin-top: 32px; margin-left: -10px;">
                        <button data-toggle="modal" data-target="#ModalUpload" class="btn btn-secondary"><i class="fa fa-upload"></i>&nbspUpload Excel</button>           
                      </div> 
                      <div class="text-left" style="width: 80px; margin-top: 32px; margin-left: 120px;">
                        <a onclick="download_locker('<?php echo $plant ?>')"><button data-toggle="modal" class="btn btn-primary"><i class="fa fa-download"></i>&nbspDownload CSV</button></a>           
                      </div> 
                    </div>



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

                  <!-- The Modal Add-->
                  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog"
                            aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-bg">
                                <div class="modal-content">
                                    <div class="modal-header box-solid bg-green">
                                    <h4 class="modal-title" id="memberModalLabel">Add New Observation</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>     
                                    </div>
                                    

                                    <!-- /.box-header input form-->
                                    <div class="box-body">
                                        <form role="form" id="saveinput" class="form-horizontal" action="add_observation.php" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Description :</label>
                                                    <div class="col-sm-8">
                                                        <textarea row="5" type="text" class="form-control" name="description" id="description" maxlength="500" 
                                                            value="<?php echo $getType['description']; ?>" placeholder="Input Description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="plant_observation">Plant :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="plant_observation" name="plant_observation">
                                                            <option disabled selected>Select Plant</option>
                                                            <option value="PEM">PEM</option>
                                                            <option value="PEL">PEL</option>
                                                            <option value="BLP">BLP</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="floor_obaservation">Floor :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="floor_observation" name="floor_observation">
                                                            <option disabled selected>Select Floor</option>
                                                            <option value="1">1st Floor</option>
                                                            <option value="2">2nd Floor</option>
                                                            <option value ="3">3rd Floor</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Location :</label>
                                                    <div class="col-sm-8">
                                                        <input type="sesa" class="form-control" name="location_observation" id="location_observation"
                                                            value="<?php echo $getType['location_observation']; ?>" placeholder="Input Location">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="image">Upload :</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="image" name="image" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="status_observation">Status :</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="status_observation" name="status_observation">
                                                            <option disabled selected>Select Status</option>
                                                            <option value="OK">OK</option>
                                                            <option value="NOT OK">NOT OK</option>
                                                        </select>
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

                  <!-- The Modal Edit -->       
                  <div class="modal fade" id="ModalEdit"<?php echo $data['description']; ?> tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-bg">
                        <div class="modal-header box-solid bg-green">
                            <h4 class="modal-title" id="memberModalLabel">Edit Locker</h4>
                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                            </div>
                              <div class="modal-content">
                                    <div class="modal-body" id="info_update" >
                                        <div class="form-group row">
                                          <label class="col-sm-4 col-form-label">Locker ID : </label>
                                          <div class="col-sm-8">
                                              <input disabled type="text" step="1" class="form-control" name="locker_id" id="locker_id1" value=""  />
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-sm-4 col-form-label">Name : </label>
                                          <div class="col-sm-8">
                                              <input type="text" step="1" class="form-control" name="name" id="name1" placeholder="Input Name" value=""  />
                                          </div>
                                        </div>


                                        <div class="form-group row">
                                          <label class="col-sm-4 col-form-label">Talent ID : </label>
                                          <div class="col-sm-8">
                                              <input type="text" step="1" class="form-control" name="talent_id" id="talent_id1" placeholder="Input Talent ID" value=""  />
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Gender :</label>
                                            <div class="col-sm-8">
                                                <select id="gender1" class="form-control" name="gender">
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Plant :</label>
                                            <div class="col-sm-8">
                                                <select id="plant2" class="form-control" name="plant">
                                                    <option value="PEM">PEM</option>
                                                    <option value="PEL">PEL</option>
                                                    <option value="BLP">BLP</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Area :</label>
                                            <div class="col-sm-8">
                                                <select id="area2" class="form-control" name="area">
                                                    <option value="Office">Office</option>
                                                    <option value="Sub Office">Sub Office</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Floor :</label>
                                            <div class="col-sm-8">
                                                <select id="floor2" class="form-control" name="floor">
                                                    <option value="1">1st Floor</option>
                                                    <option value="2">2nd Floor</option>
                                                    <option value ="3">3rd Floor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Department :</label>
                                            <div class="col-sm-8">
                                                <select id="dept2" class="form-control" name="dept">
                                                  <option disabled selected>Select Department</option>
                                                  <option value="Production">Production</option>
                                                  <option value="Shipping">Shipping</option>
                                                  <option value ="Warehouse">Warehouse</option>
                                                  <option value ="SC Hub Asia">SC Hub Asia</option>
                                                  <option value="TCC">TCC</option>
                                                  <option value="Industrial / Manufacturing">Industrial / Manufacturing</option>
                                                  <option value ="TA">TA</option>
                                                  <option value ="Procurement">Procurement</option>
                                                  <option value="Logistics">Logistics</option>
                                                  <option value="Finance">Finance</option>
                                                  <option value ="IT">IT</option>
                                                  <option value ="Method">Method</option>
                                                  <option value="SERE">SERE</option>
                                                  <option value="HR">HR</option>
                                                  <option value ="Maintenance">Maintenance</option>
                                                  <option value ="CS & Quality">CS & Quality</option>
                                                  <option value ="Supply Chain">Supply Chain</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-sm-4 col-form-label">No.Phone : </label>
                                          <div class="col-sm-8">
                                              <input type="number" step="1" class="form-control" name="no_phone" id="no_phone1" placeholder="Input No.Phone" value=""  />
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-sm-4 col-form-label">Upload : </label>
                                          <div class="col-sm-8">
                                              <input type="file" step="1" class="form-control" name="img" id="img1" value=""  />
                                          </div>
                                        </div>

                                        <div class="modal-footer">
                                          <button type="submit" data-dismiss="modal" id="update" class="btn btn-success" onclick="updateUser($('#locker_id1').val(), $('#name1').val(), $('#talent_id1').val(), $('#gender1').val(), $('#plant2').val(), $('#area2').val(), $('#floor2').val(), $('#dept2').val(), $('#no_phone1').val(), $('#img1').val())"> Save</button>
                                          
                                          <button data-dismiss="modal" name="reset" class="btn btn-secondary">
                                              Close</button>     
                                        </div>

                                </div>
                            </div> 
                        </div>
                    </div> 
                  </div>   
                  
                  <!-- The Modal Upload File-->
                  <div class="modal fade" id="ModalUpload" tabindex="-1" role="dialog"
                            aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-bg">
                                <div class="modal-content">
                                    <div class="modal-header box-solid bg-green">
                                    <h4 class="modal-title" id="memberModalLabel">Add New Observation</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>     
                                    </div>
                                    

                                    <!-- /.box-header input File-->
                                    <div class="box-body">
                                        <form role="form" id="saveinput" class="form-horizontal" action="upload_observation.php" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="image">Select File Excel :</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="image" name="image" />
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="reset" name="reset" class="btn btn-secondary">
                                                        Reset</button>
                                                    <button type="submit" name="submit" class="btn btn-info"></i>
                                                        Import</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                </div>
                                    
				

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


  

  $(document).ready(function () {
    $('#tableact').DataTable();
    filterByStatus();
    printall()
  });
</script>

<script>
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
  function getDetailGambar(params) {
        // var button = $(event.relatedTarget) // Button that triggered the modal
        // var recipient = button.data('whatever') // Extract info from data-* attributes
        // var modal = $(this);
        // var dataString = 'badge_id=' + recipient;
        // console.log(params);
        // $('#ModalDetailGambar').on('show.bs.modal', function(event) {
            $.ajax({
                type: "POST",
                url: "showpic.php",
                data: {id: params},
                success: function(data) {
                    $('#dasha').html(data);
                    $('#GambarModal').modal('show');
                    // console.log(data);
                    // $('#dasha').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        // });
    }
    // })
</script>

<script>
 function filterByStatus() {
    var plant = $('#plant').val();
    var area = $('#area').val();
    var floor = $('#floor').val();
    var dept = $('#dept').val();
    $("#plant1").val(plant);
    $("#area1").val(JSON.stringify(area));
    $("#floor1").val(JSON.stringify(floor));
    $("#dept1").val(JSON.stringify(dept));
    console.log(area);

    $.ajax({
      type: 'POST',
      data: {
        plant: plant,
        area: area,
        floor: floor,
        dept: dept
        
      },
      url: 'filteraction_observation.php',
      success: function (resp) {
        $data = resp.split('|||');
        $('#respons').html($data[0]);
      
      }
    })
  }
</script>

<script>
  function updateUser(locker_id1, name1, talent_id1, gender1, plant1, area1, floor1, dept1, no_phone1, img1){
    console.log(plant1);
        $.ajax({
            type: "POST",
            url: "edit_locker.php",
            data : {
                locker_id1: locker_id1,
                name1: name1,
                talent_id1: talent_id1,
                gender1: gender1,
                plant1: plant1,
                area1: area1,
                floor1: floor1,
                dept1: dept1,
                no_phone1: no_phone1,
                img1: img1,

            },
            success: () => {
                Swal.fire(
                    'Edit Berhasil!',
                    'Edit Berhasil',
                    'success'
                ).then(() => {
                    window.location.reload();
                })
            }
        });
    }
</script>

<script>
  function download_locker(str){
        window.location = "./downloads/lockers.php?plant="+str;
    }
</script>



</html>