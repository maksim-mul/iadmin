<?
//добавляет css и js по умолчанию
function add_default_css_js(){
	?>
	<link href="/application/static/uikit/css/uikit.min.css" rel="stylesheet">
	<link href="/application/static/css/theme.css" rel="stylesheet">
	<link href="/application/static/css/login.css" rel="stylesheet">
	<script src="/application/static/js/jquery-3.2.1.min.js"></script>
	<script src="/application/static/uikit/js/uikit.min.js"></script>
	<script src="/application/static/uikit/js/uikit-icons.js"></script>
	<?
	return 0;
}

function add_template_css_js(){
	//узнаем адрес вызывающего приложения
	$path_app = mb_substr( $_SERVER['PHP_SELF'], 0, mb_strrpos( $_SERVER['PHP_SELF'], '/' ) );
	//Подключаем css и js из вызывающего приложения
	if ( file_exists( $_SERVER['DOCUMENT_ROOT'].$path_app."/static/template.css" ) )
		echo "<link href='".$path_app."/static/template.css' rel='stylesheet'>";
	if ( file_exists( $_SERVER['DOCUMENT_ROOT'].$path_app."/static/template.js" ) )
		echo "<script src='".$path_app."/static/template.js'></script>";
}

function LitePassGen($pass_len){
	$array = array("E", "T", "O", "P", "A", "H", "K", "X", "C", "B", "M", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$password = '';

	for( $i = 0; $i < $pass_len; $i++ ){
		$password = $password.$array[rand(0, count($array)-1)];
	}
	return $password;
}

function TranslitWord($word){
	$space = '-';
	$transl = array(
		'а' => 'a',
		'б' => 'b',
		'в' => 'v',
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'j',
		'к' => 'k',
		'л' => 'l',
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p',
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'h',
		'ц' => 'c',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'sh',
		'ъ' => '',
		'ы' => 'y',
		'ь' => '',
		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',
		'А' => 'A',
		'Б' => 'B',
		'В' => 'V',
		'Г' => 'G',
		'Д' => 'D',
		'Е' => 'E',
		'Ж' => 'Zh',
		'З' => 'Z',
		'И' => 'I',
		'Й' => 'J',
		'К' => 'K',
		'Л' => 'L',
		'М' => 'M',
		'Н' => 'N',
		'О' => 'O',
		'П' => 'P',
		'Р' => 'R',
		'С' => 'S',
		'Т' => 'T',
		'У' => 'U',
		'Ф' => 'F',
		'Х' => 'H',
		'Ц' => 'C',
		'Ч' => 'Ch',
		'Ш' => 'Sh',
		'Щ' => 'Sh',
		'Э' => 'E',
		'Ю' => 'Yu',
		'Я' => 'Ya',
		' ' => $space,
		'_' => $space,
		'`' => $space,
		'~' => $space,
		'!' => $space,
		'@' => $space,
		'#' => $space,
		'$' => $space,
		'%' => $space,
		'^' => $space,
		'&' => $space,
		'*' => $space,
		'(' => $space,
		')' => $space,
		'-' => $space,
		'\=' => $space,
		'+' => $space,
		'[' => $space,
		']' => $space,
		'\\' => $space,
		'|' => $space,
		'/' => $space,
		'.' => $space,
		',' => $space,
		'{' => $space,
		'}' => $space,
		'\'' => $space,
		'"' => $space,
		';' => $space,
		':' => $space,
		'?' => $space,
		'<' => $space,
		'>' => $space,
		'№' =>$space
	);


	$array = array(
		'а' => 'a',
		"в" => "b"
	);


	$space = '-';
	$new_word = "";

	//узнаем длину строки
	$strLength = iconv_strlen($word,'UTF-8');

	for( $i = 0; $i < $strLength; $i++ ){
		$new_word = $new_word.$transl[ mb_substr($word,$i,1,'UTF-8') ];
	}

	return $new_word;
}

function AllImgsInDir($path){

	$arr_images = array();
	$directory = $_SERVER['DOCUMENT_ROOT'].$path;    // Папка с изображениями
	$directory2 = $path;

	$allowed_types=array("jpg", "png", "gif");  //разрешеные типы изображений
	$file_parts = array();
	$ext="";
	$title="";
	$i=0;
	//пробуем открыть папку
	$dir_handle = @opendir($directory);// or die("Ошибка при открытии папки !!!");
	while ($file = readdir($dir_handle))    //поиск по файлам
	{
		if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки

		$file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
		$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение

		if(in_array($ext,$allowed_types))
		{
			$arr_images[$i] = $directory2.'/'.$file;
			$i++;
		}
	}
	closedir($dir_handle);  //закрыть папк

	return $arr_images;
}

function Filter($all_staffs, $guarantee, $contract, $photo){
	$staffs = array();
	$staffs = $all_staffs;

	if ( $guarantee=='yes' ){
		$b=0;
		for( $i=0; $i<count($staffs); $i++){
			if ( $staffs[$i]['guarantee'] == 1 ){
				$staffs_gar[$b] = $staffs[$i];
				$b++;
			}
		}
		$staffs = $staffs_gar;

	}

	if ( $contract=='yes' ){
		$b=0;
		$staffs_con = array();
		for( $i=0; $i<count($staffs); $i++){
			if ( $staffs[$i]['contract'] == 1 ){
				$staffs_con[$b] = $staffs[$i];
				$b++;
			}
		}
		$staffs = $staffs_con;
	}

	if ( $photo=='yes' ){
		$b=0;

		$staffs_ph = array();
		$staff_images = array();

		for( $i=0; $i<count($staffs); $i++){

			$staff_images = AllImgsInDir("/uploads/staffs/".$staffs[$i]['login']);

			if ( !empty($staff_images) ){
				$staffs_ph[$b] = $staffs[$i];
				$b++;
			}
		}
		$staffs = $staffs_ph;
	}



	return $staffs;
}
?>
