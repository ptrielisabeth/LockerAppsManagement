<?php
session_start();
error_reporting(0);
include("../../theme/config.php");

$area= $_POST['area'];
$status= $_POST['status'];
$location = $_POST['location'];
$insp_date=$_POST['month'];

$area = "'".join("','", $_POST['area'])."'";
$status = "'".join("','", $_POST['status'])."'";
$insp_date = "'".join("','", $_POST['month'])."'";


?>

<div class="card-body">
    <div class="col-12 table-responsive">
        <table class="table table-data table-striped table-bordered text-center" id="tablefilter">
            <thead class="bg-info">
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Checked By</th>
                    <th>Aknowledge By</th>
                    <th>Action</th>
                    <th>Action By</th>
                    <th>Responsible</th>
                    <th>Target Date Complete</th>
                    <th>Actual Date Complete</th>
                    <th>Status</th>
                    <th>area</th>
                    <th width='15%'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $a= "  SELECT insp_head_id, 
                    cast([insp_date] as varchar(20)) as insp_date
                    ,[location]
                    ,[check_a]
                    ,[aknowledge]
                    ,[action]
                    ,[actionby]
                    ,[responsible]
                    ,cast([target_date] as varchar(20)) as target_date
                    ,cast([actual_date] as varchar(20)) as actual_date
                    ,[status]
                    ,[area]
                    FROM [SERE].[dbo].[tbl_insp_header] where insp_head_id >='25' 
                    AND (area IN ($area) OR area is null)   and location ='$location' and DATENAME(MONTH,[insp_date]) IN($insp_date)";

                        // echo $a;
                    $actionsum= sqlsrv_query($conn, $a);
                    $no=1;
                    while ($r = sqlsrv_fetch_array($actionsum)) { 
                    ?>
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $r['insp_date'] ?></td>
                    <td><?= $r['location'] ?></td>
                    <td><?= $r['check_a'] ?></td>
                    <td><?= $r['aknowledge'] ?></td>
                    <td><?= $r['action'] ?></td>
                    <td><?= $r['actionby'] ?></td>
                    <td><?= $r['responsible'] ?></td>
                    <td><?= $r['target_date'] ?></td>
                    <td><?= $r['actual_date'] ?></td>
                    <td><?= $r['status'] ?></td>
                    <td><?= $r['area'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning text-white"
                            href="editaction.php?id=<?php echo $r['insp_head_id']; ?>"><i class='fa fa-edit'></i>
                            Edit</a>
                        <a class="btn btn-sm btn-danger text-white" insp_head_id="<?php echo $r['insp_head_id']; ?>"
                            onclick="del_confirm($(this).attr('insp_head_id'))"><i class='fa fa-trash'></i> Delete</a>
                        <a class="btn btn-sm btn-success text-white"
                            href="actionsum_detail.php?id=<?php echo $r['insp_head_id']; ?>"><i class='fa fa-edit'></i>
                            Detail</a>

                </tr>
                <?php
                    }
                    ?>
            </tbody>
        </table>         
    </div>
</div>

<script>
// $(document).ready(function () {
    $('#tablefilter').DataTable();
// });
</script>


