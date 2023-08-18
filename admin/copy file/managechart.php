<?php
session_set_cookie_params(3600*3600*24*5, "/");
session_start();
error_reporting(0);
include("../../theme/config.php");
include("partial/header.php");

date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="100% !important">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="card-header bg-success">
            <div class="row">
                <div class="col-md-10">
                    <div class="col-md-11">
                        <center>
                            <div style="width: 70%; padding-top: 0%;">
                            <h3 style="text-align: center;">Manage Chart</h3>
                            </div>
                        </center>
                    </div>
                </div>               
            </div>
        </div>    
    </section>
    <section class="content">
        <div class="box" style="width:100%">
            <div class="box-header">
              <div class="card-header bg-info">
                <a href="#"><button class="btn btn-md btn-light" name="add" data-target="#ModalAdd" data-toggle="modal">
                        <span class="fa fa-plus"></span> Add New
                    </button></a>

                <div class="text-left" style="width: 80px; margin-top: 32px; margin-left: 5px;">
                    <button data-toggle="modal" data-target="#ModalAdd" class="btn btn-light"><i class="fa fa-plus"></i>&nbspAdd Locker</button>           
                </div> 

                <a href="chart.php"><button class="btn btn-md btn-danger">
                        <span class="fa fa-caret-left"></span> Back
                    </button></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-condensed dt-responsive nowrap">
                    <thead>
                        <tr font-size='8' align='center'>
                            <th>No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th style="colspan:2">Action</th>
                        </tr>
                    </thead>
                        <?php
                        include("../../theme/config.php");
                        $hasil = sqlsrv_query($conn, "SELECT * FROM images");
                        $no = 1;
                        while ($data = sqlsrv_fetch_array($hasil)) {
                        // $date2 = $data['expired'];
                        // $date1 = new DateTime($now);
                        // $date2 = new DateTime($expired);
                        // $diff = date_diff($date2, $date1);
                        // $diff = $date2->diff($date1);
                        ?>
                        <tr font-size='9' align='center'>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['title'] ?></td>
                            <td>
                                <a class="button" href="#" data-target="#ModalDetailGambar" data-whatever="<?php echo $data['id']; ?>" data-toggle="modal">
                                    <div id="results<?php echo $no; ?>">
                                        <img src="images/<?php echo $data['img']; ?>" width="auto" height="106px" />
                                    </div>
                                </a>
                            <td>
                                <a class="btn btn-xs btn-info" href='editchart.php?id=<?php echo $data['id']; ?>'>Edit</a>

                                <!-- <?php if ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'safety') { ?>
                                    <a class="btn btn-xs btn-danger" data-target="#ModalDelete" data-href='deletechart.php?id=<?php echo $data['id']; ?>' data-toggle="modal">Delete</a>
                                <?php } ?> -->

                            </td>
                        </tr>

                    <?php $no++;
                    } ?>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

        <!-- The Modal -->
        <div id="myModal1" class="modal1">
            <span class="close">&times;</span>
            <img class="modal-content1" id="img01">
            <div id="caption"></div>
        </div>

        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header box-solid bg-green">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="memberModalLabel">Add New Part</h4>
                    </div>
                    <div>
                        <form method="POST" action="upchart.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="text" class="form-control" id="title_img" name="title_img" placeholder="Title">
                            </div>
                            <div class="modal-body">
                                <input type="file" class="form-control" name="image" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <button type="submit" class="btn btn-success pull-right" name="upload"><i class="fa fa-plus"></i> Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include("partial/footer.php"); ?>
<style>
  .modal-lg {
    max-width: 70%;
  }
</style>

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

    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal1 {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 150px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content1 {
        margin: auto;
        display: block;
        width: 100%;
        max-width: 1280px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 500px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content1,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 70px;
        right: 35px;
        color: #f1f1f1;
        font-size: 30px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content1 {
            width: 100%;
        }
    }
</style>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="../../theme/datatables/jquery.dataTables.min.js"></script>
<script src="../../theme/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../theme/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../theme/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

<script src="../dist/plugins/datepicker/bootstrap-datepicker.min.js"></script>


<script>
   $(document).ready(function () {
    $('#tableact').DataTable();
    filterByStatus();
    printall()
   })
   
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
    $(document).ready(function() {
        $('#ModalDelete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#ModalOut').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
<script>
    // Get the modal
    var modal1 = document.getElementById("myModal1");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    function show_image(name) {
        modal1.style.display = "block";
        $("#img01").attr("src", "images/" + name);
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal1.style.display = "none";
    }
</script>
<script>
    $('#ModalDetailGambar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "showchart.php",
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
</script>

</body>

</html>