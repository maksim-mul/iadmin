<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
$date =  htmlspecialchars( trim( $_POST['day'] ) );

$selectData = new Database("expeditions");
$sql_query = "SELECT * FROM warehouses a, expeditions b WHERE a.id = b.id_warehouses AND date_travel='".$date."' ORDER BY priority ASC " ;
$expeditions = $selectData->getDataMyQuery($sql_query);


if( !empty( $expeditions ) ){
  foreach ($expeditions as $value) {
  ?>
    <div class="uk-card uk-card-default card-stock" storage-name="<?=$value['name']?>" storage-id="<?=$value['id_warehouses']?>" id_exp="<?=$value['id']?>" storage-latitude="<?=$value['latitude']?>" storage-longitude="<?=$value['longitude']?>">
        <div class="card-stock-title">
            <a style="color: #df405a;" href="/delivery/storage/?lat=<?=$value['latitude']?>&long=<?=$value['longitude']?>" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a>
            <span><?=$value["name"]?></span>
            <div class="uk-float-right">
                <span uk-icon="icon: clock;"></span>
                <?=date("H:i", strtotime($value['time_opening']))?> - <?=date("H:i", strtotime($value['time_closing']))?>
            </div>
        </div>
        <div>
            <label>Комментарий:</label>
            <textarea class="uk-textarea uk-margin-remove" rows="4"><?=$value["comment"]?></textarea>
            <div class="uk-margin-small-top">
                <div uk-grid class="uk-grid-small">
                    <div class="uk-width-1-3">
                        <select class="uk-select" id="pay_type">
                            <option value="0" <? if ( $value["payment_type"] == 0 ) echo 'selected '; ?>>Наличные</option>
                            <option value="1" <? if ( $value["payment_type"] == 1 ) echo 'selected '; ?>>Безнал</option>
                        </select>
                    </div>
                    <div class="uk-width-1-3">
                        <input class="uk-input" type="text" placeholder="<?=$value["sum_papayment_sumyment"]?>" value="<?=$value["payment_sum"]?>">
                    </div>
                    <div class="uk-width-1-3 uk-text-right">
                        <a class="card-stock-delit" id-exp="<?=$value['id']?>">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?
  }
}
else{
  echo 'На этот день поездка не планируется.';
}
?>
