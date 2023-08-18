<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header.php");

    $msd_plants= $_SESSION['userplant'];


    // Get idno
    $sql = "SELECT max(locker_id) as locker_id from tbl_locker";
    $sqlres = sqlsrv_query($conn, $sql);
    while ($res = sqlsrv_fetch_array($sqlres)) {
        $locker_id=$res['locker_id']+1;
    }

    // Generate data list
    $sql = "delete tbl_insp_tmp where id_no=$idno 
        insert into tbl_insp_tmp (id_no,insp_id) 
        select $idno, insp_id from mst_inspection order by insp_id";
        // echo $sql;
    $sqlquery = sqlsrv_query($conn, $sql);

    $msd_lantai= 'SNC';
    $msd_line= 'Tesys';
    $msd_cell= 'Tesys - Front Line 1';
    $msd_bench= 'TE-062 Final Tester & Dating';
    
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $_head_id = 1;
    if(isset($_GET['head_id'])){
        $_head_id = $_GET['head_id'];
    }
?>

<!-- =============================================================================================CUSTOM STYLE============================================================================ -->
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
    span.bahasa {
        color: #32CD32;
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
    .checkmark, .secondcheckmarks {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 25px;
        background-color: #E0E0E0;
    }

    /* On mouse-over, add a grey background color */
    .containercheckbox:hover input ~ .checkmark, .containercheckbox:hover input ~ .secondcheckmarks {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containercheckbox input:checked ~ .checkmark {
            background-color: #2196F3;
        }

    .containercheckbox input:checked ~ .secondcheckmarks {
        background-color: #b5bbc8  ;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after, .secondcheckmarks:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containercheckbox input:checked ~ .checkmark:after, .containercheckbox input:checked ~ .secondcheckmarks:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containercheckbox .checkmark:after, .containercheckbox .secondcheckmarks:after {
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
        width: 100%;
        height: 100%;
    }
    input.mediumtext {
        width: 50px;
        height: 40px;
        font-size: 16pt;
        text-align: center;
        background-color: greenyellow;
        box-sizing: border-box;
    }
    .textright {
        width: 50px;
        height: 40px;
        font-size: 16pt;
        text-align: center;
        background-color: greenyellow;
        box-sizing: border-box;
        position: absolute;
        right: 0px;
        /*border: 3px solid #73AD21;
        padding: 10px;*/
    }
    input.largertext {
        width: 100%;
        height:120px;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    input.largerradio {
        width: 200px;
        height: 20px;
    }
    input.largerCheckbox {
        width: 40px;
        height: 40px;
    }
    input[type="checkbox"] {
        vertical-align:middle;
    }
    .modal {
        overflow: auto !important;
    }
    input[type="radio"] 
    {
        border: 0px;
        width: 2000px;
        height: 2em;
    }
    .button {
        /*background-color: #4CAF50; /* Green */
        border: none;
        color: blue;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 0px 0px;
        cursor: pointer;
        border-radius: none;
    }

</style>
<!-- =============================================================================================END CUSTOM STYLE============================================================================ -->


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline">
                            <div class="card-header bg-success" style="text-align: center;">
                                <h3>Committe Structure</h3>
                            </div>
                            <section class="content ">
                                <div class="box" style="width:100%">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            <div class="btn-group btn-group-xs">
                                                <a href="managechart.php">
                                                    <div class="text-left" style="width: 20px; margin-top: 16px; margin-left: 20px;">
                                                    <button class="btn btn-info">
                                                        <span class="fa fa-search"></span> Manage Chart
                                                    </button>
                                                    </div>
                                                </a>
                                            </div>
                                        </h3>
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
                        </div>
                    </div>
                </div>



<!-- ============================================================================================================CLOSE MODAL PICTURE REFERENCES=========================================== -->

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

</body>



