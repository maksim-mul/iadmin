<?
  $SetTitle = "Список складов";
  include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";

  $data = new Database("warehouses");
  $storage = $data->getDataOrderBy("asc", "NAME");

  echo "<pre>";
  print_r($storage);
  echo "</pre>";


  //include_once $_SERVER['PHP_SELF']."/views/main.php";
  $path_app = mb_substr( $_SERVER['SCRIPT_FILENAME'], 0, mb_strrpos( $_SERVER['SCRIPT_FILENAME'], '/' ) );
  echo $path_app."/views/main.php";


  include_once $path_app;
?>
<? include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php"; ?>
