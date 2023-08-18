<?php
    session_start();
    error_reporting(0);
    include("../../../theme/config.php");

$datefrom = $_POST['f2datefrom'];
$dateto = $_POST['f2dateto'];
$cat = $_POST['cat'];

    $query="SELECT * FROM [SERE].[dbo].[v_insp_result] where insp_date BETWEEN '$datefrom' AND '$dateto' AND insp_nm = '$cat' ";
   echo $query;
    $qry_data = sqlsrv_query($conn, $query);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline">

            <div class="card-body">
                <!-- <div id="table2">

                </div> -->
                <div class="col-12 table-responsive">
                    <table class="table table-data table-bordered">
                        <thead class="bg-green">
                            <tr>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-now">
                            <?php
                    $no = 1;
                    while ($data_master = sqlsrv_fetch_array($qry_data)) {
                    ?>
                            <tr class="tr">
                                <td><?= $data_master['location']?></td>
                                <td><?= $data_master['status']?></td>
                            </tr>
                            <?php
                    }
                ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".table-data").DataTable()
    });
</script>