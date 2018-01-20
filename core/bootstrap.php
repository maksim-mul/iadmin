<?php
	session_start();
	if (isset($_SESSION['admin'])){
		include_once $_SERVER['DOCUMENT_ROOT']."/core/models/settings.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/core/models/db.class.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";
	}
	else{
		include_once $_SERVER['DOCUMENT_ROOT']."/core/models/functions.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/views/login.php";
		//Подключаем стили и js по умолчанию
		add_default_css_js();
		die();
	}
?>
