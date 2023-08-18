<?php
  session_set_cookie_params(3600*3600*24*5, "/");
  session_start();
  error_reporting(0);
  include("../../theme/config.php");
  include("partial/header.php");

  $msd_year= DATE("Y");
  $msd_plant= $_SESSION['userplant'];
  if ($msd_plant=='SEMB'){
    $msd_plant='PEM';
  }else{$msd_plant= $_SESSION['userplant'];}

$sqlc= "SELECT top 1 insp_date FROM [SERE].[dbo].[tbl_insp_header] ORDER BY insp_date desc";
$qryc = sqlsrv_query($conn, $sqlc);
while ($datac = sqlsrv_fetch_array($qryc)){
  $wheretoday=$datac['insp_date'];
}

$wheretoday = date('Y-m-d');
$start_date =  date('Y-m-d', strtotime('-30 days', strtotime($wheretoday)));
$end_date = $wheretoday;


$qry_bay3 = sqlsrv_query($conn, "SELECT insp_id, insp_nm, count(insp_nm) as total_insp FROM [SERE].[dbo].[v_insp_result]
group by insp_nm, insp_id order by insp_id");
$arr_medium_chart = array();
$arr_high_chart = array();
while ($data_chart = sqlsrv_fetch_array($qry_bay3)) {
  $chartline1[] = array("y" => $data_chart['total_insp'], "label" => $data_chart['insp_nm']);
  }
  $medium_chart =  json_encode($arr_medium_chart);
  $high_chart = json_encode($arr_high_chart);



$qry_bay = sqlsrv_query($conn, "SELECT location, count(location) as total_insp
FROM [SERE].[dbo].[tbl_insp_header] group by location order by location");
$arr_medium_chart5 = array();
$arr_high_chart5 = array();
while ($data_chart5 = sqlsrv_fetch_array($qry_bay)) {
  $chartline[] = array("y" => $data_chart5['total_insp'], "label" => $data_chart5['location']);
  }
  $medium_chart5 =  json_encode($arr_medium_chart5);
  $high_chart5 = json_encode($arr_high_chart5);

  // var_dump($chartline);
  


$qry_bay2 = sqlsrv_query($conn, "SELECT status, count(status) as jml FROM [SERE].[dbo].[tbl_insp_header] WHERE status is not null 
GROUP BY status");
$arr_medium_chart6 = array();
$arr_high_chart6 = array();
while ($data_chart6 = sqlsrv_fetch_array($qry_bay2)) {
    $pie[] = array("y" => $data_chart6['jml'], "label" => $data_chart6['status']);
  }
  $medium_chart6 =  json_encode($arr_medium_chart6);
  $high_chart6 = json_encode($arr_high_chart6);
  // var_dump($pie);



$qry_bay7 = sqlsrv_query($conn, " SELECT DATENAME(month,insp_date) AS month, COUNT(*) AS count FROM tbl_insp_header
GROUP BY DATENAME(month,insp_date)");
$arr_medium_chart7 = array();
$arr_high_chart7 = array();
while ($data_chart7 = sqlsrv_fetch_array($qry_bay7)) {
    $column3[] = array("y" => $data_chart7['count'], "label" => $data_chart7['month']);
  }
  $medium_chart7 =  json_encode($arr_medium_chart7);
  $high_chart7 = json_encode($arr_high_chart7);
  // var_dump($column3);


?>
<style>
  /* The container */
  .containercheckbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-align: center;
  }

  .highcharts-point:hover {
    cursor: pointer;
  }

  .content-wrapper {
    /* padding: 2%; */
  }

  .selectpicker-select {
    font-size: 16px;
  }

  .card-header {
    /* background-color: #007bff; */
    background-color: #28a745;
    color: #fff;
  }

  .card-header2 {
    /* background-color: #007bff; */
    background-color: #80bfff;
    color: #fff;
  }

  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    height: 800px;
  }

  .bg-msd {
    background-color: #9999ff;
  }

  .bg-nonmsd {
    background-color: #ffff00;
  }

  .modal {
    overflow: auto !important;
  }
</style>


<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#d9d9d9">
    <?php $alex1 = sqlsrv_query($conn,"select COUNT(*) as alex1 FROM [SERE].[dbo].[tbl_locker_data] where name = ''"); ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h2 class="m-0 text-green"></h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div id="changeData">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-sm-11">
                        <center>
                          <h3>Dashboard</h3>
                        </center>
                      </div>
                      <!-- <div class="col-sm-1">
                      <?php 
                      if($_SESSION['userplant']=='SEMB'){
                        $q_partctb = sqlsrv_query($conn,"SELECT DISTINCT plant FROM msd_mst_line order by plant");}
                      else{ 
                        $q_partctb = sqlsrv_query($conn,"SELECT DISTINCT plant FROM msd_mst_line where plant='$msd_plant' order by plant");}
                      //  $msd_plant='PEM';}
                      
                      while($res_partctb = sqlsrv_fetch_array($q_partctb)){
                        if ($res_partctb['plant'] != $msd_plant) {
                          ?>
                        <option value="<?= $res_partctb['plant'] ?>"><?= $res_partctb['plant'] ?></option>
                          <?php
                          } else {
                      ?>
                        <option value="<?= $res_partctb['plant'] ?>" selected><?= $res_partctb['plant'] ?></option>
                      <?php
                        }
                      } ?>
                      </select>
                          </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body" style="background-color:white">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <div class="col-sm-8">
                            <h4 class="m-0 text-white">Status of Locker Management</h4>
                          </div>
                        </div>
                        <?php $alex = sqlsrv_query($conn,"select COUNT(*) as alex FROM [SERE].[dbo].[tbl_locker_data] where name <> ''"); ?>
                        
                        <div class="card-body">
                          <div style="display: flex; flex-direction: row;">
                          <div class="col-md-12">
                              <div id="pie" style="height: 400px; width: 100%;"><i class="fa fa-spinner fa-spin"></i>
                                <i>loading...</i></div>
                            </div>
                            <div class="col-md-6" hidden>
                              <!-- <div id="chart-line1" hidden style="color: #ccceee; height: 500px;"><i class="fa fa-spinner fa-spin"></i> <i>loading...</i></div> -->
                              <div id="column3" style="height: 100%; width: 100%;"><i
                                  class="fa fa-spinner fa-spin"></i> <i>loading...</i></div>

                            </div>
                            <div id="chartContainer" style="width: 100%; height: 300px">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
  </div>
</section>
  </div>
  
  <?php include("partial/footer.php"); ?>
  <style>
    .modal-lg {
      max-width: 90%;
    }
  </style>

</body>

<script src="../../theme/jquery/jquery.min.js"></script>
<script src="../../theme/bootstrap/js/bootstrap.js"></script>
<script src="../../theme/bootstrap/js/bootstrap.min.js"></script>
<script src="../../theme/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../theme/datatables/jquery.dataTables.min.js"></script>
<script src="../../theme/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../theme/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../theme/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../theme/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../../theme/sweetalert/sweetalert2.min.js"></script>
<script src="../../theme/lte/js/adminlte.min.js"></script>
<script src="../../theme/select2/js/select2.full.js"></script>
<script src="../../theme/select2/js/select2.js"></script>
<script src="../../theme/selecpicker/bootstrap-select.min.js"></script>
<script src="../../theme/highcharts/highcharts.js"></script>
<script src="../../theme/highcharts/modules/pareto.js"></script>
<script src="../../theme/highcharts/grouped_categories/grouped-categories.js"></script>
<script type="text/javascript" src="../canvasjs.min.js"></script>


<script>
  var loading =
    "<img style='display: block; margin-left: auto; margin-right: auto; width: 50%;' src='../theme/images/preloading.gif'>";
  $(document).ready(function () {
    $('.selectpicker').selectpicker();

  });

  function change_year() {
    $("#chart-prbaging").html(loading);
    $("#line-data").html(loading1);
    $("#ctb-container").html(loading);
    $("#ctb-container1").html(loading2);
    //var datefrom = $("#datepickerFr").val();
    //var dateto = $("#datepickerTo").val();
    var station1 = $("#station1").val();
    $.ajax({
      type: "POST",
      url: "change/by_line.php",
      data: {
        //datefrom: datefrom,
        //dateto: dateto,
        station1: station1
      },
      success: function (msg) {
        //$("#line-body").html(msg);
        $("#changeData").html(msg);
        //$("#title_by_line").html(station1);
      }
    });
  }

  $(function () {
    $('#filter_B1').datepicker({
      autoclose: true
    }).on('hide', function () {})
  })


  $(function () {
    $('#filter_B2').datepicker({
      autoclose: true
    }).on('hide', function () {})
  })


  $(function () {
    $('#filter_C1').datepicker({
      autoclose: true
    }).on('hide', function () {})
  })


  $(function () {
    $('#filter_C2').datepicker({
      autoclose: true
    }).on('hide', function () {})
  })
</script>



<script>
  $(document).ready(function () {
    $('#ModalDelete').on('show.bs.modal', function (e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  });
  

  // function changeact() {
  //   $.ajax({
  //     type: 'POST',
  //     dataType: 'json',
  //     url: "../process/changeChart3.php",
  //     data: {
  //       f3datefrom: f3datefrom,
  //       f3dateto: f3dateto,
  //     },
  //     success: function (hasil) {
  //       // console.log("Response"+hasil);
  //       var column3 = new CanvasJS.Chart("column3", {
  //         animationEnabled: true,
  //         legend: {
  //           cursor: "pointer",
  //         },
  //         data: [{
  //           type: "column",
  //           markerType: "square",
  //           yValueFormatString: "0 Issues",
  //           dataPoints: hasil
  //         }]
  //       });
  //       column3.render();
  //     }
  //   });

  //   $.ajax({
  //     type: 'POST',
  //     dataType: 'json',
  //     url: "../process/changeChart4.php",
  //     data: {
  //       f3datefrom: f3datefrom,
  //       f3dateto: f3dateto,
  //     },
  //     success: function (hasil) {
  //       // console.log("Response"+hasil);
  //       var pie = new CanvasJS.Chart("pie", {
  //         animationEnabled: true,
  //         legend: {
  //         cursor: "pointer",
  //         },
  //         data: [{
  //           type: "pie",
  //           markerType: "square",
  //           yValueFormatString: "0 Issues",
  //           dataPoints: hasil
  //         }]
  //       });
  //       pie.render();
  //     }
  //   });
  // }

  
</script>





<script>
  window.onload = function () {
    const alex = <?php while($alex2 = sqlsrv_fetch_array($alex)){ echo $alex2['alex']; } ?> 
    var column3 = new CanvasJS.Chart("column3", {
      animationEnabled: true,
      theme: "light",
      axisY: {
        title: "STATUS LOCKER"
      },
      dataPointWidth: 40,
      data: [{
        type: "column",
        yValueFormatString: "0 Issues",
        dataPoints: <?php echo json_encode($column3, JSON_NUMERIC_CHECK); ?>
      }]
    });

    var pie = new CanvasJS.Chart("pie", {
      borderColor: 'orange',
      animationEnabled: true,
      theme: "light6",
      data: [{
        type: "pie",
        yValueFormatString: "#\" Locker\"",
        indexLabelPlacement: "inside",
        indexLabelFontWeight: "bold",
        indexLabelFontSize: 0,
        showInLegend: true,
			  toolTipContent: "{y} - #percent %",
			  legendText: "{indexLabel}",
        dataPoints: [
          { y: Number(alex), indexLabel: "Terisi", color: "#e83845" },
          { y: Number(<?php while($alex3 = sqlsrv_fetch_array($alex1)){ echo $alex3['alex1']; } ?>), indexLabel: "Kosong", color: "#4fb06d" },
        ]
      }]
    });

    column3.render();
    pie.render();
  }
</script>


</html>