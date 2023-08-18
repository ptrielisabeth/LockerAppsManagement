<?php
include("../../theme/config.php");
session_start();

require_once('vendor/autoload.php');
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Helper\Sample;
if (isset($_FILES["image"])) {
	$filename = $_FILES["image"]["tmp_name"];

	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y/m/d H:i:s');
	$user = $_SESSION['userid'];

	$action = "Importing Locker Excel File";

	sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

	$file = $_FILES['image']['name'];
	$ekstensi = explode(".", $file);
	$file_name = "Locker_Template-".round(microtime(true)).".".end($ekstensi);
	$source = $_FILES['image']['tmp_name'];
	$upload = move_uploaded_file($source,'tmp/'.$file_name);
	$target_file = 'tmp/'.$file_name;

	if($upload) {
		// echo "success";

		$reader = new Xlsx();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($target_file);
		$sheetData = $spreadsheet->getActiveSheet();

		$rows = $sheetData->getHighestRow();

		// echo $rows;

		$row = 2;
		$col = 1;
		for ($row=2; $row<=$rows; $row++) {
            
			$locker_id = $sheetData->getCellByColumnAndRow($col, $row)->getValue();
			$name = $sheetData->getCellByColumnAndRow($col+1, $row)->getValue();
			$talent_id = $sheetData->getCellByColumnAndRow($col+2, $row)->getValue();
			$gender = $sheetData->getCellByColumnAndRow($col+3, $row)->getValue();
			$plant = $sheetData->getCellByColumnAndRow($col+4, $row)->getValue();
			$area = $sheetData->getCellByColumnAndRow($col+5, $row)->getValue();
			$floor = $sheetData->getCellByColumnAndRow($col+6, $row)->getValue();
			$dept = $sheetData->getCellByColumnAndRow($col+7, $row)->getValue();
			$no_phone = $sheetData->getCellByColumnAndRow($col+8, $row)->getValue();

			$qry = sqlsrv_query($conn, "INSERT INTO tbl_locker (locker_id, talent_id, plant, area, floor, dept, name, gender, no_phone) VALUES ('".$locker_id."', '".$talent_id."', '".$plant."', '".$area."', '".$floor."', '".$dept."', '".$name."', '".$gender."', '".$no_phone."')");

		}

		if ($qry) {
			// echo "success"; echo "<br>";
			echo "<script language='javascript'> alert('Upload file was successfully!'); window.location.href='data_lockers.php'; </script>";
		} else {
			echo "failed"; echo "<br>";
			// echo $query; echo "<br>";
		}
	} else {
		echo "failed";
		var_dump($_FILES['image']['error']);
	}
}
