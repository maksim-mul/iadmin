<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$data['name'] = $_POST['storage_name'];
$data['address'] = $_POST['storage_adress'];
$data['description'] = $_POST['storage_desc'];
$data['time_opening'] = $_POST['storage_time_start'];
$data['time_closing'] = $_POST['storage_time_stop'];

$coordinates =  explode(",", $_POST['storage_latlong']);
$data['latitude'] = $coordinates["0"];
$data['longitude'] = $coordinates["1"];

$insertData = new Database("warehouses");
$insertData->insertRow($data);

echo 'Новый склад добавлен в список.';
?>
