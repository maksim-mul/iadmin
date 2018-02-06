<?
class Database{
	//название таблицы
	public $tablename;

	function __construct($tablename) {
		$this->connectToDb();
		$this->tablename = htmlspecialchars( trim( $tablename ) );
	}

	function connectToDb(){
		try{
			$this->$db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPASSWORD);
		}
		catch (PDOException $e){
			echo "Возникла ошибка соединения: ".$e->getMessage();
			exit();
		}
	}

	function closeConnectToDb(){
		$this->$db = null;
	}

	//DELETE==========================================================================================
	//удаление строки по id
	function deleteRow($id){
		$id = intval( htmlspecialchars( trim($id) ) );
		$sql_query = "DELETE FROM $this->tablename WHERE id=".$id;
 		$this->$db->query($sql_query);
		$this->closeConnectToDb();
	}

	//INSERT==========================================================================================
	//добавление в таблицу
	function insertRow($data) {
		$sql_query = "INSERT INTO $this->tablename ";
		foreach($data as $key => $value ){
			$keys[] = htmlspecialchars( trim($key) );
			$values[] = htmlspecialchars( trim($value) );
		}
		$sql_query .= "(".implode($keys, ",").") VALUES ";
		$sql_query .= "('".implode($values, "','")."')";
		$this->$db->query($sql_query);
		$this->closeConnectToDb();
	}

	//SELECT==========================================================================================
	//вывод всей запрошенной таблицы
	function getAllData() {
		$sql_query = "Select * from ".$this->tablename;
		$rs = $this->$db->query($sql_query);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		$this->closeConnectToDb();
		return $rows;
	}

	// $query = "SELECT * FROM firms ORDER BY company_name ASC";
	//Вывод с сортировкой
	function getDataOrderBy($sorting_type, $column_name){
		$sql_query = "Select * from $this->tablename ORDER BY ".$column_name." ".$sorting_type;
		$rs = $this->$db->query($sql_query);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		$this->closeConnectToDb();
		return $rows;
	}

	//вывод строки с подходящими параметрами
	function getDataWithParamaeters($params){
		$sql_query = "Select * from $this->tablename where ";
		foreach($params as $key => $values){
			$key = htmlspecialchars( trim($key) );
			$values = htmlspecialchars( trim($values) );
			$sql_query.= "$key = '$values' AND ";
		}
		$sql_query = substr($sql_query, 0, -4);
		$rs = $this->$db->query($sql_query);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		$this->closeConnectToDb();
		return $rows;
	}

	//SELECT name, phone FROM staff a, user b WHERE a.id_user = b.id
	//$table2 вторая таблица
	//$data необходимые поля
	//$params1 параметр сравнения из 1 таблицы
	//$params2 параметр сравнения из 2 таблицы
	function getDataFromTwoTables($table2, $column, $params1, $params2) {
		$sql_query = "SELECT ".implode($column, ", ")." FROM ".$this->tablename." a, ".$table2." b where a.".$params1." = b.".$params2;
		$rs = $this->$db->query($sql_query);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		$this->closeConnectToDb();
		//echo $query;
		return $rows;
	}

	//Функция с нестандартным запросом
	function getDataMyQuery($sql_query){
		$rs = $this->$db->query($sql_query);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		$this->closeConnectToDb();
		return $rows;
	}

	//UPDATE==========================================================================================
	//редактирование строки
	function editRow($id, $data) {
		$sql_query = "UPDATE $this->tablename SET ";
		foreach($data as $key => $value ){
			$keys[] =  htmlspecialchars( trim($key) );
			$values[] =  htmlspecialchars( trim($value) );
			$sql_query .= $key.' = ';
			$sql_query .= "'".$value."', ";
		}
		$sql_query = substr($sql_query, 0, -2);
		$sql_query.=" WHERE  id =".$id;
		//echo $sql_query;
		$this->$db->query($sql_query);
		$this->closeConnectToDb();
	}

}
?>
