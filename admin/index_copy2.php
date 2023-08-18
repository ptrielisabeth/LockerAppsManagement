<?php
  session_set_cookie_params(3600*3600*24*5, "/");
  session_start();
  error_reporting(0);
  include("../../theme/config.php");
  include("partial/header.php");
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
                      <div class="col-md-12">
                        <center>
                          <div style="width: 70%; padding-top: 0%;">
                            <h3 style="text-align: center;"><strong>Dashboard </strong></h3>
                          </div>
                        </center>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body" style="background-color:white">
                  <div class="row">
                    
                  <script>
                    window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                      animationEnabled: true,
                      title: {
                        text: "Status Lockers"
                      },
                      data: [{
                        type: "pie",
                        startAngle: 240,
                        yValueFormatString: "##0.00\"%\"",
                        indexLabel: "{label} {y}",
                        dataPoints: [
                          {y: 85, label: "Full"},
                          {y: 15, label: "Empty"}
                        ]
                      }]
                    });
                    chart.render();

                    }
                  </script>
                  <body>
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </body>
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


  <!-- Modal -->
  <div id="detailmodal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" style="max-width: 850px!important;" role="document">
      <div class="modal-content">
        <div class="modal-header bg-green">
          <h4 class="modal-title text-center" id="detail_title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="detailbody"></div>
        </div>
      </div>
    </div>
  </div>




  <?php include("partial/footer.php"); ?>
  <style>
    .modal-lg {
      max-width: 90%;
    }
  </style>

</body>
</html>