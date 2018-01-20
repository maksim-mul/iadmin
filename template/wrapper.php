<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
?>
<div class="h1-blc">
    <h1><?=$SetTitle?></h1>
</div>
<?
$path_app = mb_substr( $_SERVER['SCRIPT_FILENAME'], 0, mb_strrpos( $_SERVER['SCRIPT_FILENAME'], '/' ) );
include_once $path_app.'/views/main.php';
?>
