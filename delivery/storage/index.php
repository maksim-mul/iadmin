<?
  $SetTitle = "Список складов";
  include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";

  $data = new Database("warehouses");
  $storage = $data->getDataOrderBy("Asc", "Name");

  include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php";
?>
