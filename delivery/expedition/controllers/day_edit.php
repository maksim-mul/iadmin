<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
  $id =  htmlspecialchars( trim( $_POST['id'] ) );
  $data["id_warehouses"] =  htmlspecialchars( trim( $_POST['id_warehouses'] ) );
  $data["comment"] =  htmlspecialchars( trim( $_POST['comment'] ) );
  $data["payment_type"] =  htmlspecialchars( trim( $_POST['oplata'] ) );
  $data["payment_sum"] =  htmlspecialchars( trim( $_POST['sum'] ) );
  $data["priority"] = htmlspecialchars( trim( $_POST['priority'] ) );

  if( !empty($id) ){
    $editData = new Database("expeditions");
    $rs = $editData->editRow($id, $data);
    echo "1";
  }
  else{
    $data["date_travel"] =  htmlspecialchars( trim( $_POST['day'] ) );

    $insertData = new Database("expeditions");
    $insertData->insertRow($data);
    echo '2';
  }
?>
