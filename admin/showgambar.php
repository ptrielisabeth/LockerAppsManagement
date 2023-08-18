<?php
include('config.php');
error_reporting(0);
session_start();

$id = $_POST['insp_head_id'];
?>

    <?php
    $x = "SELECT * FROM tbl_insp_header WHERE insp_head_id = '$id'";
    // echo $x;
    $result = sqlsrv_query($conn, "SELECT * FROM tbl_insp_header WHERE insp_head_id = '$id'");
    ?>
    <div class="row">
        <div class="col-md-12">
            <center>
            <?php while ( $data = sqlsrv_fetch_array($result)) { ?>
                <img src="<?php echo "images/" . $data['pict_upload']; ?>" height="200px" />
            </center>
            <?php } ?>
        </div>
    </div>



    