<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/settings.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/db.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";

$selectData = new Database("expeditions");
$sql_query = "SELECT * FROM warehouses a, expeditions b WHERE a.id = b.id_warehouses AND date_travel='2018-02-06' ORDER BY priority ASC " ;
$expeditions = $selectData->getDataMyQuery($sql_query);

include_once $_SERVER['DOCUMENT_ROOT']."/ride/views/main.php";
?>
