<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header2.php");

    $msd_plants= $_SESSION['userplant'];

    $query = sqlsrv_query($conn, "SELECT * FROM tbl_managechart");
    $row = sqlsrv_fetch_array($query);
?>

 

<?php  
function make_slide_indicators()
{
    include("../../theme/config.php");
    $qry = sqlsrv_query($conn, "SELECT * FROM tbl_managechart ORDER BY id");
    $output = '';
    $count = 0;
    while ($row = sqlsrv_fetch_array($qry)) {
        if ($count == 0) {
            $output .= '<li data-target="#dynamic_slide_show" data-slide-to="' . $count . '" class="active"></li>';
        } else {
            $output .= '<li data-target="#dynamic_slide_show" data-slide-to="' . $count . '"></li>';
        }
        $count = $count + 1;
    }
    return $output;
}

function make_slides()
{
    include("../../theme/config.php");
    $qry = sqlsrv_query($conn, "SELECT * FROM tbl_managechart ORDER BY id");
    $output = '';
    $count = 0;
    while ($row = sqlsrv_fetch_array($qry)) {
        if ($count == 0) {
            $output .= '<div class="carousel-item active">';
        } else {
            $output .= '<div class="carousel-item">';
        }
        $output .= '
        <img src="images/' . $row["img"] . '" alt="' . $row["title"] . '" style="height:100%; width:100%" />
            <div class="carousel-caption">
                <h3><strong>' . $row["title"] . '</strong></h3>
            </div>
        </div>
        
        ';
        $count = $count + 1;
    }
    return $output;
}
?>


<!-- =============================================================================================END CUSTOM STYLE============================================================================ -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                    <div class="card-header bg-success">
                                <div style="text-align: left;"></i></div>
                                <div style="width: 70%; padding-top: 0%; text-align: left;">
                                    <img src="../../theme/images/se-lio-logo-white.png" alt="image" widht="70" height="40"/>
                                </div> 
                                    <a style="margin-left: 97%; margin-top: -3%;" href="chart_guest_user.php" class="nav-link <?php if($pg =='chart'){echo 'active';}?>">
                                        <i class="fas fa-users nav-icon"></i>
                                    </a>
                                <div style="text-align: center;"> <h3><strong>Committee Structure</strong></h3></div> 
                            </div>
                        <section class="content ">
                            <div class="box" style="width:100%">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        <div class="btn-group btn-group-xs">
                                            <a href="managechart.php">
                                                <div class="text-left" style="width: 20px; margin-top: 16px; margin-left: 20px;">
                                                <a href="scan_qr2.php"><button class="btn btn-md btn-danger">
                                                    <span class="fa fa-caret-left"></span> Back
                                                </button></a>
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
                                            <a class="left carousel-control-prev" href="#myCarousel" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control-next" href="#myCarousel" data-slide="next">
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
    <script src="../../theme/sweetalert/sweetalert2.min.js"></script>s
    <script src="../../theme/select2/js/select2.full.js"></script>
    <script src="../../theme/select2/js/select2.js"></script>
    <script src="../../theme/selecpicker/bootstrap-select.min.js"></script>
    
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>
</body>




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



