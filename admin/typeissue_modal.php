<?php
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline">

            <div class="card-body">
                <div id="table2">

                </div>
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
                                <td><a href="#"
                                        onclick="show_modal_detail(`edash`,`<?=$week_year?>`,`<?=$data_master['family_jv2']?>`)"><?=$data_master['family_jv2']?></a>
                                </td>
                                <td><?php echo number_format($data_master['qty']); ?></td>
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