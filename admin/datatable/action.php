<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Easy set variables
*/
session_start();
error_reporting(0);
/* Array of database columns which should be read and sent back to DataTables. Use a space where
* you want to insert a non-database field (for example a counter or static image)
*/
// add your columns here!!!
$msd_plants= $_SESSION['userplant'];
  if ($msd_plants=='SEMB'){
    $condition = "WHERE plant='PEM'";
	$condition2 = "WHERE plant='PEM'";
  }else{
	$condition = "WHERE plant=$msd_plants";
	$condition2 = "WHERE plant=$msd_plants";}
// $aColumns = array('history_id', 'sbin', 'material', 'book_value', 'count1_value', 'count1_by', 'count1_date', 'audit1_value', 'audit1_by', 'audit1_date', 'count2_value', 'count2_by', 'count2_date', 'audit2_value', 'audit2_by', 'audit2_date', 'count3_value', 'count3_by', 'count3_date', 'audit3_value', 'audit3_by', 'audit3_date', 'final_res');
$aColumns = array('id','issues','action','floor','line','cell', 'survey_id', 'last_update','update_by', 'shift'
,'bench','process','PIC','due_date','status','picture','remark','record_date');

/*$aColumns = array('colmn', 'book_value', 'count1', 'count_var1', 'audit1', 'count_var_p1', 'count2', 'count_var2', 'audit2', 'count_var_p2', 'final_res', 'final_var', 'sbin', 'material', 'count1_value', 'audit1_value', 'count2_value', 'audit2_value');*/
include("../../../theme/config.php");
/* Indexed column (used for fast and accurate table cardinality) */
// $sIndexColumn = "[sbin]";
$sIndexColumn = "id";
$curr_date = date('Y-m-d');
$start_date =  date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))));
/* DB table to use */
$sTable = "inspect_action";
// $sTable = "[dbo].[v_historyh]";

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* If you just want to use the basic configuration for DataTables with PHP server-side, there is
* no need to edit below this line
*/

/*
* Local functions
*/
function fatal_error($sErrorMessage = '')
{
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
	die($sErrorMessage);
}


/* Ordering */

$sOrder = "";
if (isset($_POST['order'])) {
	// $test=$_POST['columns'][3];
	$sOrder = "ORDER BY ";
	if ($_POST['columns'][0]['orderable'] == "true") {
		// echo $test;
		$sOrder .= "" . $aColumns[intval($_POST['order'][0]['column'])] . " " .
			($_POST['order'][0]['dir'] === 'asc' ? 'asc' : 'desc');
	}
}

/* escape function */
function mssql_escape($data)
{
	if (is_numeric($data))
		return $data;
	$unpacked = unpack('H*hex', $data);
	return '0x' . $unpacked['hex'];
}

/* Filtering */
$sWhere = "$condition2";
if (isset($_POST['search']['value']) && $_POST['search']['value'] != "") {
	$sWhere = "WHERE $condition (";
	for ($i = 0; $i < count($aColumns); $i++) {
		$sWhere .= $aColumns[$i] . " LIKE '%" . addslashes($_POST['search']['value']) . "%' OR ";
	}
	$sWhere = substr_replace($sWhere, "", -3);
	$sWhere .= ')';
}
/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
	if (isset($_POST['columns'][$i]) && $_POST['columns'][$i]['searchable'] == "true" && $_POST['columns'][$i]['search']['value'] != '') {
		if ($sWhere == "") {
			$sWhere = "WHERE $condition ";
		} else {
			$sWhere .= " AND ";
		}
		$sWhere .= $aColumns[$i] . " LIKE '%" . addslashes($_POST['columns'][$i]['search']['value']) . "%' ";
	}
}

/* Paging */
$top = (isset($_POST['start'])) ? ((int) $_POST['start']) : 0;
$limit = (isset($_POST['length'])) ? ((int) $_POST['length']) : 10;
/*$sQuery = "SELECT TOP $limit " . implode(",", $aColumns) . "
FROM $sTable
$sWhere " . (($sWhere == "") ? " WHERE $condition " : " AND ") . " $sIndexColumn NOT IN
(
SELECT TOP $top $sIndexColumn FROM
$sTable $sOrder
)
$sOrder";*/
$startrow = $top;
$endrow = $top+$limit;
$sQuery = "
SELECT " . implode(",", $aColumns) . "
FROM(
SELECT ROW_NUMBER() OVER( $sOrder ) RowNum," . implode(",", $aColumns) . "
FROM $sTable $condition ) as x
WHERE RowNum BETWEEN $startrow AND $endrow";
$sQuery2 = $sQuery;
//echo $sQuery2;
$rResult = sqlsrv_query($conn, $sQuery);

/* Data set length after filtering */
if ($sWhere == "") {
	$sQueryCnt = "SELECT * FROM $sTable";
} else {
	$sQueryCnt = "SELECT * FROM $sTable $sWhere";
}
$rResultCnt = sqlsrv_query($conn, $sQueryCnt, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$iFilteredTotal = sqlsrv_num_rows($rResultCnt);

/* Total data set length */
$sQuery = "
SELECT COUNT(" . $sIndexColumn . ")
FROM $sTable
";
$rResultTotal = sqlsrv_query($conn, $sQuery);
$aResultTotal = sqlsrv_fetch_array($rResultTotal);

$iTotal = $aResultTotal[0];


/* Output */


$output = array(
	"draw" => intval($_POST['draw']),
	"recordsTotal" => $iTotal,
	"recordsFiltered" => $iFilteredTotal,
	"data" => array()
);

$no = $top + 1;
while ($aRow = sqlsrv_fetch_array($rResult)) {
	$row = array();
	for ($i = 0; $i < count($aColumns); $i++) {
		/* General output */
		// $row[$i] = $aRow[ $aColumns[$i] ];
		$row[$aColumns[$i]] = $aRow[$aColumns[$i]];
	}
	$row['no'] = $no++;
	$output['data'][] = $row;
}

echo json_encode($output);