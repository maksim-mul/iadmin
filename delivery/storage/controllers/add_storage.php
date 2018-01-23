<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$data['name'] = $_POST['storage_name'];
$data['address'] = $_POST['storage_adress'];
$data['latitude'] = $_POST['storage_lat'];
$data['longitude'] = $_POST['storage_long'];
$data['description'] = $_POST['storage_desc'];

$insertData = new Database("warehouses");
$insertData->insertRow($data);

echo 'Новый склад добавлен в список.';
?>
