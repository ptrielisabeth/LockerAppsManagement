<!-- jQuery -->
<script src="../../theme/jquery/jquery.min.js"></script>
<!-- JQuery UI -->
<script src="../../theme/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../theme/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../theme/datepicker/bootstrap-datepicker.js"></script>
<!-- Data Tables -->
<script src="../../theme/datatables/jquery.dataTables.min.js"></script>
<script src="../../theme/datatables/dataTables.bootstrap4.js"></script>
<!-- Slimscroll -->
<script src="../theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../theme/highchart/jquery.highchartTable.js"></script>
<!-- FastClick -->
<script src="../../theme/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../theme/lte/js/adminlte.js"></script>
<!-- Sweet Alert 2 -->
<script src="../../theme/sweetalert/sweetalert2.min.js"></script>
<script src="../../theme/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../theme/plugins/validate/dist/jquery.validate.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	  var url = window.location;
	  jQuery('ul.nav a[href="' + url + '"]').parent().addClass('active');
	  jQuery('ul.nav a').filter(function() {
	    return this.href == url;
	  }).parent().addClass('nav-path-selected');
	});
</script>