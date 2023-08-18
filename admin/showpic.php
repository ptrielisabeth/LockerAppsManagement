
<?php
include('config.php');
error_reporting(0);
session_start();

$locker_id = $_POST['locker_id'];
?>

    <?php
    $x = "SELECT * FROM tbl_locker_data WHERE locker_id = '$locker_id'";
    // echo $x;
    $result = sqlsrv_query($conn, "SELECT * FROM tbl_locker WHERE locker_id = '$locker_id'");
    ?>
    <div class="row">
        <div class="col-md-12">
            <center>
            <?php while ( $data = sqlsrv_fetch_array($result)) { ?>
                
                <img src="<?php echo "imgprofile/" . $data['img']; ?>" height="300px" />
            </center>
            <?php } ?>
        </div>
    </div>