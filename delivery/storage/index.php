<?
  $SetTitle = "Список складов";
  include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";

  //список всех складов
  $data = new Database("warehouses");
  $storage = $data->getDataOrderBy("asc", "NAME");

  include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php";
?>
