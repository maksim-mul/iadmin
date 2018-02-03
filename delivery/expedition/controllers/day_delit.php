<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
  $id =  htmlspecialchars( trim( $_POST['id_exp'] ) );
  $delData = new Database("expeditions");
  $delData->deleteRow($id);
  echo "1";
?>
