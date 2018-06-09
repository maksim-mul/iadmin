<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
  $delit = $_POST['delit'];

  if( !empty($delit) ){
    foreach ($delit as $key => $value) {
      $delData = new Database("expeditions");
      $delData->deleteRow($value);
    }
  }
  
  echo "1";
?>
