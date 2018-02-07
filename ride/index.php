<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/settings.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/db.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";

if (isset($_GET['ymd'])) {
    $ym = $_GET['ymd'];
} else {
    // This month
    $ym = date('Y-m-d');
}
// Check format
$timestamp = strtotime($ym . '-01');
echo $timestamp;


$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));




$selectData = new Database("expeditions");
$sql_query = "SELECT * FROM warehouses a, expeditions b WHERE a.id = b.id_warehouses AND date_travel='2018-02-06' ORDER BY priority ASC " ;
$expeditions = $selectData->getDataMyQuery($sql_query);

include_once $_SERVER['DOCUMENT_ROOT']."/ride/views/main.php";
?>
