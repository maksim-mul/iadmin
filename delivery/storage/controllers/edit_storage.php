<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$id = $_POST['id'];
$data['name'] = $_POST['name'];
$data['address'] = $_POST['address'];
$data['description'] = $_POST['description'];
$data['time_opening'] = $_POST['storage_time_start'];
$data['time_closing'] = $_POST['storage_time_stop'];

$coordinates =  explode(",", $_POST['latlong']);
$data['latitude'] = $coordinates["0"];
$data['longitude'] = $coordinates["1"];

$editData = new Database("warehouses");
$allCats = $editData->editRow($id, $data);

echo "Объект редактирован.";
?>
