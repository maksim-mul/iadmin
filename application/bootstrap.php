<?php
	session_start();
	if (isset($_SESSION['admin'])){
		include_once $_SERVER['DOCUMENT_ROOT']."/application/models/settings.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/application/models/db.class.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/application/models/functions.php";
		//Подключаем стили и js по умолчанию
		add_default_css_js();
		//Подключаем стили и js из вызывающего приложения
		add_template_css_js();
	}
	else{
		include_once $_SERVER['DOCUMENT_ROOT']."/application/models/functions.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/views/login.php";
		//Подключаем стили и js по умолчанию
		add_default_css_js();
		die();
	}
?>
