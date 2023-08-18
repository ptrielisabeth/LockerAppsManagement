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
                              <h3 style="text-align: center;"><strong>Committe Structure</strong></h3>
                            </div>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>

                  <section class="content ">
                    <div class="box" style="width:100%">
                        <div class="box-header">
                                <div class="btn-group btn-group-xs">
                                    
                                        <a href="managechart.php"><button class="btn btn-xs btn-info">
                                                <span class="fa fa-search"></span> Manage Chart
                                            </button></a>
                                  
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php echo make_slide_indicators($row); ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php echo make_slides($row); ?>
                                </div>

                                <?php if ($row['stats'] == 'Y') { ?>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                  </section>
                


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

    .carousel-caption {
        top: 0;
        bottom: auto;
        color: black;
        text-transform: uppercase;
    }
</style>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="../dist/js/adminlte.min.js"></script>


<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#ModalDelete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>


</html>