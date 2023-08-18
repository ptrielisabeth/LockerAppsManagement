<?php
include("../../theme/config.php");
session_start();

$id = $_GET['id'];
?>
<html>

<body>
    <?php
    $result = sqlsrv_query($conn, "SELECT * FROM tbl_managechart WHERE id = '" . $id . "'");
    $data = sqlsrv_fetch_array($result) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <img src="<?php echo "images/" . $data['img']; ?>" height="500px" width="600px" />
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