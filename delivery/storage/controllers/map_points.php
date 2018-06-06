<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$data = new Database("warehouses");
$storage = $data->getAllData();

foreach ($storage as $key => $value) {
  $points[$key] = array(
    "type" => "Feature",
    "id" => $key,
    "geometry" => array(
      "type" => 'Point',
      "coordinates" => array($storage[$key]["latitude"], $storage[$key]["longitude"])
    ),
    "properties" => array(
      "balloonContentBody" => $storage[$key]["name"],
      "hintContent" => $storage[$key]["name"]
    ),
    "options" => array(
      "preset" => "islands#nightFactoryCircleIcon"
    )
  );
}
$mas_point = array(
  "type" => "FeatureCollection",
  "features" => $points
);
echo json_encode( $mas_point, JSON_UNESCAPED_UNICODE );
?>
