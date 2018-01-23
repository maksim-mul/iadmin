<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$id = $_POST['id'];
$data['name'] = $_POST['name'];
$data['address'] = $_POST['address'];
$data['latitude'] = $_POST['latitude'];
$data['longitude'] = $_POST['longitude'];
$data['description'] = $_POST['description'];

$editData = new Database("warehouses");
$allCats = $editData->editRow($id, $data);

echo "Объект редактирован.";
?>
