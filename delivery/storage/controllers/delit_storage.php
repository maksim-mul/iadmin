<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
$data['id'] = $_POST['id'];
$delitData = new Database("warehouses");
$delitData->deleteRow($data['id']);

echo 'Склад удален из списка.';
?>
