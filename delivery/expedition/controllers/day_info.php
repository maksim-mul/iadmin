<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
$date =  htmlspecialchars( trim( $_POST['day'] ) );



$selectData = new Database("expeditions");
$sql_query = "SELECT * FROM warehouses a, expeditions b WHERE a.id = b.id_warehouses AND date_travel='".$date."'" ;




$expeditions = $selectData->getDataMyQuery($sql_query);

if( !empty( $expeditions ) ){
  foreach ($expeditions as $value) {
  ?>
    <div class="uk-card uk-card-default card-stock" storage-id="<?=$value['id_warehouses']?>">
        <div class="card-stock-title">
            <a style="color: #df405a;" href="https://yandex.ru/maps/213/moscow/?mode=search&text=<?=$value['latitude']?>%2C<?=$value['longitude']?>&sll=37.489376%2C54.902805" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a>
            <span><?=$value["name"]?></span>
            <div class="uk-float-right">
                <span uk-icon="icon: menu; ratio: 1.3"></span>
            </div>
        </div>
        <div>
            <label>Комментарий:</label>
            <textarea class="uk-textarea uk-margin-remove" rows="3"><?=$value["comment"]?></textarea>
            <div class="uk-margin-small-top">
                <div uk-grid class="uk-grid-small">
                    <div class="uk-width-1-3">
                        <select class="uk-select" id="form-stacked-select">
                            <option <? if ( $value["payment_type"] == 0 ) echo 'selected '; ?> >Безнал</option>
                            <option <? if ( $value["payment_type"] == 1 ) echo 'selected '; ?> >Наличные</option>
                        </select>
                    </div>
                    <div class="uk-width-1-3">
                        <input class="uk-input" id="form-stacked-text" type="text" placeholder="<?=$value["sum_payment"]?>" value="<?=$value["sum_payment"]?>">
                    </div>
                    <div class="uk-width-1-3 uk-text-right">
                        <a class="card-stock-delit">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?
  }
  print_r($rs);
}
else{
echo 'На этот день поездка не планируется.';
}




$data = array();
?>
