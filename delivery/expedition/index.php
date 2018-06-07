<?
$SetTitle = "Экспедиция";
include $_SERVER['DOCUMENT_ROOT']."/template/header.php";

// Set your timezone!!
date_default_timezone_set('Europe/Moscow');
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}
// Today
$today = date('Y-m-j', time());
// For H3 title
$html_title = date('F Y', $timestamp);
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// Number of days in the month
$day_count = date('t', $timestamp);
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 0, date('Y', $timestamp)));
// Create Calendar!!
$weeks = array();
$week = '';
// Add empty cell
$week .= str_repeat('<td></td>', $str);
for ( $day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym.'-'.$day;
    if ($today == $date) {
        $week .= '<td day='.$date.' class="today active">'.$day;
    } else {
        $week .= '<td day="'.$ym."-".$day.'">'.$day;
    }
    $week .= '</td>';
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>'.$week.'</tr>';
        // Prepare for new week
        $week = '';
    }
}

$data = new Database("warehouses");
$storage = $data->getDataOrderBy("Asc", "Name");








echo date("Y:m:d");

$date =  date("Y:m:d");

$selectData = new Database("expeditions");
$sql_query = "SELECT * FROM warehouses a, expeditions b WHERE a.id = b.id_warehouses AND date_travel='".$date."' ORDER BY priority ASC " ;
$expeditions = $selectData->getDataMyQuery($sql_query);


/*
foreach ($expeditions as $key => $value) {
  //$arr[] = array( $expeditions[$key]["latitude"], $expeditions[$key]["longitude"] );

  $arr[] = ''[]" $expeditions[$key]["latitude"], $expeditions[$key]["longitude"] );
}*/








include $_SERVER['DOCUMENT_ROOT']."/template/footer.php";
?>
