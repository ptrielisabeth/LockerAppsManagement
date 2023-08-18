<?php
include("../../theme/config.php");
session_start();

$obserID = $_GET['obserID'];
?>
<html>

<body>
    <?php
    $result = sqlsrv_query($conn, "SELECT * FROM tbl_observation WHERE obserID = '" . $obserID . "'");
    $data = sqlsrv_fetch_array($result) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <img src="<?php echo "imgobservation/" . $data['img']; ?>" height="500px" width="600px" />
                </center>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
</body>
<style>
    .list-group {
        max-height: 300px;
        margin-bottom: 10px;
        overflow: scroll;
        -webkit-overflow-scrolling: touch;
    }
</style>

</html>