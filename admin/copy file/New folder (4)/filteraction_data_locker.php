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
    <div class="col-12 table-responsive">
    
                <table id="example1" class="table table-bordered text-center table-striped table-condensed">
                    <thead class="bg-info">
                        <tr font-size='8' align='center'>
                            <th>No</th>
                            <th>Locker ID</th>
                            <th>Name</th>
                            <th>Talent ID</th>
                            <th>Gender</th>
                            <th>Plant</th>
                            <th>Area</th>
                            <th>Floor</th>
                            <th>Department</th>
                            <th>No.Phone</th>
                            <th>Record Date</th>
                            <th>Images</th>
                            <th style="colspan:2">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $a= "  SELECT * 
                            FROM [SERE].[dbo].[tbl_locker] 
                            where plant ='$plant' and (area IN ('$areaResult') OR area is null) and (floor IN ('$floorResult') OR floor is null) and (dept IN ('$deptResult') OR dept is null)";

                                // echo $a;
                            $actionsum= sqlsrv_query($conn, $a);
                            $no=1;
                            while ($r = sqlsrv_fetch_array($actionsum)) { 
                            ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $r['locker_id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['talent_id'] ?></td>
                            <td><?= $r['gender'] ?></td>
                            <td><?= $r['plant'] ?></td>
                            <td><?= $r['area'] ?></td>
                            <td><?= $r['floor'] ?></td>
                            <td><?= $r['dept'] ?></td>
                            <td><?= $r['no_phone'] ?></td>
                            <td><?= $r['record_date'] ?></td>
                            <td>
                                <?php
                                    if($r['img'] == "" || $r['img'] == null){
                                        echo "No Picture";
                                    }else{
                                ?>
                                    <a class="button" id="<?php echo $r['locker_id']; ?>" >
                                        <img src="imgprofile/<?php echo $r['img']; ?>" width="100px" height="100px" />
                                    </a>
                                <?php
                                    }
                                ?>
                            </td>
                            
                            <td>
                            <form target="_blank" method="post" action="print_qr_mat3.php">
                              <input type="hidden" name='id' value='<?=$r['locker_id']?>' />
                              <button class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                            </form>
                            </td>        
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                    
                    
                </table>
    </div>
</div>


<script>
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
</script>








