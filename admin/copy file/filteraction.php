<?php
session_start();
error_reporting(0);
include("../../theme/config.php");

$plant= $_POST['plant'];


$areaResult = join("','", $_POST['area']);
$floorResult = join("','", $_POST['floor']);
$deptResult = join("','", $_POST['dept']);

?>

<div class="card-body">
<div class="col-md-1">
                
                <?php
                    $a= "SELECT *
                    FROM [SERE].[dbo].[tbl_locker] 
                    where plant ='$plant' and (area IN ('$areaResult') OR area is null) and (floor IN ('$floorResult') OR floor is null) and (dept IN ('$deptResult') OR dept is null)";
                        // echo $a;
                    $actionsum= sqlsrv_query($conn, $a);
                    $no=1;
                    while ($r = sqlsrv_fetch_array($actionsum)) { 
                ?>
                    <tr>
                        <div style='margin-bottom: 10px;'>
                            <div align="center" class='border border-5 border-dark'>
                                <?php if ($r['talent_id'] != '-' && 
                                         $r['plant'] != '-' && 
                                         $r['area'] != '-' && 
                                         $r['floor'] != '-' && 
                                         $r['dept'] != '-' &&
                                         $r['talent_id'] != NULL && 
                                         $r['plant'] != NULL && 
                                         $r['area'] != NULL &&
                                         $r['floor'] != NULL &&
                                         $r['dept'] != NULL ){ ?>
                                <img style="width:100%;" src="img/full_locker.png" width="100vw" alt="Berisi . . ."/>
                                <?php } else{ ?>
                                <img style="width:100%;" src="img/empty_locker.png" width="100vw" alt="Kosong . . ."/>
                                <?php } ?>
                            </div>
                            <div class="<?php if($r['talent_id'] != '-' && 
                                                 $r['plant'] != '-' && 
                                                 $r['talent_id'] != NULL && 
                                                 $r['plant'] != NULL){ 
                                                echo 'bg-danger';} else { echo 'bg-success';} ?> text-center text-bold" width="100vw" style='white-space: nowrap;' ><?php echo $r['locker_id'] ?> (<?php echo $r['dept'] ?>)</div>
                            
                        </div>
                    </tr>
                
                <?php
                    }
                    ?>
                    </div>

<script>
$(document).ready(function () {
    $('#tablefilter').DataTable();
});
</script>
