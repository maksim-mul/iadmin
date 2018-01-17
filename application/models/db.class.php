<?
class Database{
	private $host = "localhost";
	private $user = "cs62029_master";
	private $pass = "374626";
	private $db = "cs62029_master";

	//название таблицы
	private $tablename;

	function __construct($tablename) {
		$this->connectToDb();
		$this->tablename = $tablename;
	}

	function connectToDb(){
		if (mysql_connect($this->host, $this->user, $this->pass)){
			if (mysql_select_db($this->db)){
			}
		}
	}

	function closeConnection(){
		mysql_close();
	}

	//DELETE==========================================================================================
	//удаление строки по id
	function deletData($id){
		$id = intval($id);
		$query = "DELETE FROM $this->tablename WHERE id=$id;";
		if( $sql = mysql_query($query) ){
			$data = mysql_fetch_array($sql);
		}
		//echo 'Удалено!';
		$this->closeConnection();
	}
	
	//удаление строки по параметру
	function deleteDataWithParams($params){
		$query = "DELETE FROM $this->tablename WHERE ";				
		foreach($params as $key => $values){
			$query.= "$key = '$values' AND ";
		}
		$query = substr($query, 0, -4);
		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		//echo $query;
		return $data;
	}

	//INSERT==========================================================================================
	//добавление в таблицу
	function insertData($data) {
		$query = "INSERT INTO $this->tablename ";
		foreach($data as $key => $value ){
			$keys[] = $key;
			$values[] = $value;
		}
		$query .= "(".implode($keys, ",").") VALUES ";
		$query .= "('".implode($values, "','")."')";
		mysql_query($query);
		//echo $query;
		$this->closeConnection();
	}

	//UPDATE==========================================================================================
	//редактирование строки
	function editData($id, $data) {
		$query = "UPDATE $this->tablename SET ";

		foreach($data as $key => $value ){
			$keys[] = $key;
			$values[] = $value;
			$query .=$key.' = ';
			$query .= "'".$value."', ";
		}

		$query = substr($query, 0, -2);
		$query.=" WHERE  id =".$id;
		mysql_query($query);
		//echo $query;
		$this->closeConnection();
	}

	//SELECT==========================================================================================
	//вывод строки по id
	function getDataById($id) {
		$query = "Select * from $this->tablename where id = '$id'";
		if( $sql = mysql_query($query) ){
			$data = mysql_fetch_array($sql);
		}
		$this->closeConnection();
		return $data;
	}

	//вывод всей таблицы
	function getAllData() {
		$query = "Select * from $this->tablename";
		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		return $data;
	}

	//вывод строки с подходящими параметрами
	function getDataWithParamaeters($params){
		$query = "Select * from $this->tablename Where ";
		foreach($params as $key => $values){
			$query.= "$key = '$values' AND ";
		}
		$query = substr($query, 0, -4);
		//echo $query;

		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		return $data;
	}


	//SELECT name, phone FROM staff a, user b WHERE a.id_user = b.id
	//$table2 вторая таблица
	//$data необходимые поля
	//$params1 параметр сравнения из 1 таблицы
	//$params2 параметр сравнения из 2 таблицы
	function getDataFromTwoTables($table2, $column, $params1, $params2) {
		$query = "SELECT ".implode($column, ", ")." FROM ".$this->tablename." a, ".$table2." b where a.".$params1." = b.".$params2;
		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		//echo $query;
		return $data;
	}

	// $query = "SELECT * FROM firms ORDER BY company_name ASC";
	//Вывод с сортировкой
	function getDataOrderBy($sorting_type, $column_name){
		$query = "Select * from $this->tablename ORDER BY ".$column_name." ".$sorting_type;
		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		return $data;
	}
	
	//Функция с нестандартным запросом
	function getDataMyQuery($query){
		if( $sql = mysql_query($query) ){
			for($i = 0; $i < mysql_num_rows($sql); $i++){
				$data[$i] = mysql_fetch_array($sql);
			}
		}
		$this->closeConnection();
		return $data;
	}
}
?>
