<?php

class Db {
    private static $instance;
    private $pdo;
    const T_PRIMARY_KEY = "primary key";
    const T_INT = "int";
    const T_VARCHAR = "varchar(255)";
    const T_NULL = "NULL";
    const T_NOT_NULL = "NOT NULL";
    const A_I = "AUTO_INCREMENT";

    public static function get_instance() {
		if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        
		return self::$instance;
	}

    public function connect() {
        $host = "localhost";
        $db_name = "brackets";
        $user = "root";
        $password = "";
        $charset = "utf8";

        $this->pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset", $user, $password);
    }

    function create_table($table_name, $data) {
        $column_with_datatype = [];
        foreach($data as $name_columns => $data_type) {
            $column_with_datatype[] = $name_columns . " " . implode(" ", $data_type);
        }

        $string = implode(", ", $column_with_datatype);
        $sql = "create table $table_name ($string)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }

    function insert($table_name, $table_values) {
        $column_name = implode(",", array_keys($table_values));
        $placeholder = ":" . implode(", :", array_keys($table_values));
        $sql = "insert into $table_name ($column_name) value ($placeholder)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($table_values);

        return $this->pdo->lastinsertid();
    }

    public function select(string $table_name, string $where = "", $limit = 0) {
        $sql = "SELECT * FROM $table_name";
        if($where != "") {
            $sql .= " WHERE $where";
        }
        if($limit != 0) {
            $sql .= " LIMIT $limit";
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        

        return $statement;
    }

    protected function __construct() {
        $this->connect();
    }

    protected function __clone() {}
    public function __wakeup() {
        throw new Exception("Error call wakeup");
    }
}