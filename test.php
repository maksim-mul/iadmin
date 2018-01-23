<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";

$data = new Database("warehouses");
$storage = $data->getAllData();
?>

<pre>
<?=print_r($storage)?>
</pre>

<?
echo "1";
?>
