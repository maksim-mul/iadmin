<?
  $SetTitle = "Список складов";
  include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";

  $data = new Database("warehouses");
  $storage = $data->getDataOrderBy("Asc", "Name");

  if( $_GET["lat"] ){
    $lat = htmlspecialchars($_GET["lat"]);
    $zoom = 17;
  }
  else{
    $lat = "55.748794";
    $zoom = 10;
  }
  if( $_GET["long"] ){
    $long = htmlspecialchars($_GET["long"]);
    $zoom = 17;
  }
  else{
    $long = "37.609527";
    $zoom = 10;
  }
?>
  <script>
  var long = <?=$long?>;
  var lat = <?=$lat?>;
  var zoom = <?=$zoom?>;
  </script>
<?
  include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php";
?>
