<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
$data['id'] = $_POST['id'];
$delitData = new Database("warehouses");
$delitData->deletData($data['id']);
echo '1';
?>
