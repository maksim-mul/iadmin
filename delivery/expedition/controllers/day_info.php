<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$data['date_travel'] = $_POST['date'];

$selectData = new Database("regions");
$allCats = $selectData->getDataWithParamaeters($data);

if($allCats == 1) {
  $insertData = new Database("regions");
  $insertData->insertData($data);

  $selectData = new Database("regions");
  $row = $selectData->getDataWithParamaeters($data);

  ?>
  <tr id="<?=$row[0]['id']?>" class="region-row">
          <td><?=$row[0]['name']?></td>
          <td>
              <button class="uk-button uk-button-primary uk-button-small region-edit" uk-toggle="target: #modal-edit-region">Редактировать</button>
              <button class="uk-button uk-button-danger uk-button-small region-delit" uk-toggle="target: #modal-delit-region">Удалить</button>
          </td>
      </tr>
  <?
}

$data = array();


?>
