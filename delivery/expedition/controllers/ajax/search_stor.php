<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
$row = $_POST['stor_name'];

$Result = new Database("warehouses");
$storage = $Result->getDataMyQuery("SELECT * FROM `warehouses` WHERE `name` LIKE '%".$row."%'");

$mas = [
  "q" => "й",
  "w" => "ц",
  "e" => "у",
  "r" => "к",
  "t" => "е",
  "y" => "н",
  "u" => "г",
  "i" => "ш",
  "o" => "щ",
  "p" => "з",
  "[" => "х",
  "]" => "ъ",
  "a" => "ф",
  "s" => "ы",
  "d" => "в",
  "f" => "а",
  "g" => "п",
  "h" => "р",
  "j" => "о",
  "k" => "л",
  "l" => "д",
  ";" => "ж",
  "'" => "э",
  "z" => "я",
  "x" => "ч",
  "c" => "с",
  "v" => "м",
  "b" => "и",
  "n" => "т",
  "m" => "ь",
  "," => "б",
  "." => "ю",
  "й" => "q",
  "ц" => "w",
  "у" => "e",
  "к" => "r",
  "е" => "t",
  "н" => "y",
  "г" => "u",
  "ш" => "i",
  "щ" => "o",
  "з" => "p",
  "х" => "[",
  "ъ" => "]",
  "ф" => "a",
  "ы" => "s",
  "в" => "d",
  "а" => "f",
  "п" => "g",
  "р" => "h",
  "о" => "j",
  "л" => "k",
  "д" => "l",
  "ж" => ";",
  "э" => "'",
  "я" => "z",
  "ч" => "x",
  "с" => "c",
  "м" => "v",
  "и" => "b",
  "т" => "n",
  "ь" => "m",
  "б" => ",",
  "ю" => ".",
];

if( empty($storage) ){
  $arr1 = str_split($row);
  foreach ($arr1 as $key => $value) {
    $letter = mb_substr( $value, 0, 1,"ASCII");
    $str = $str.$mas[$value];
    //echo $mas[$letter];
    //echo mb_detect_encoding($mas[и]);;
  }
  //echo $str;

  $Result = new Database("warehouses");
  $storage = $Result->getDataMyQuery("SELECT * FROM `warehouses` WHERE `name` LIKE '%".$str."%'");

}

//echo $str;

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
