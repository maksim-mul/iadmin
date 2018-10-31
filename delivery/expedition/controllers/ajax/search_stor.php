<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$row = $_POST['stor_name'];

$Result = new Database("warehouses");
$storage = $Result->getDataMyQuery("SELECT * FROM `warehouses` WHERE `name` LIKE '%".$row."%'");

foreach ($storage as &$value) {
  ?>
  <li>
      <?=$value['name']?>
      <div class="uk-float-right">
        <a id_storage="<?=$value['id']?>" time_open="<?=date("H:i", strtotime($value['time_opening']))?>" time_close="<?=date("H:i", strtotime($value['time_closing']))?>" latitude="<?=$value['latitude']?>" longitude="<?=$value['longitude']?>" name="<?=$value['name']?>" class="btn-delit list-add-stock">Добавить</a>
        <a class="" style="color: #2f008a;" href="/delivery/storage/?lat=<?=$value['latitude']?>&long=<?=$value['longitude']?>" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
      </div>
  </li>
  <?
}
?>
