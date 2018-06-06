<?php
	session_start();
	if (isset($_SESSION['admin'])){
		include_once $_SERVER['DOCUMENT_ROOT']."/core/models/settings.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/core/models/db.class.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";

		//смс услуги
		include_once $_SERVER['DOCUMENT_ROOT']."/core/modules/sms/config.php";
		include_once $_SERVER['DOCUMENT_ROOT']."/core/modules/sms/transport.php";

		$sms_api = new Transport();
		$sms_balance = $sms_api->balance();		
	}
	else{
		include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/views/login.php";
		//Подключаем стили и js по умолчанию
		add_default_css_js();
		die();
	}
?>
