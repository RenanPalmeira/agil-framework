<?php

namespace Agil\Sql;

use PDO;
use Agil\Database\Database as Database;

class SQL extends Database {
		private $rs = null;

		function __construct(){
			parent::__construct();
		}

		private function endKey($array) {
			end($array);
			return key($array);
		}


		private function existTable($table){
			if($this->driver == 'mysql'){
				$rs = $this->pdo->query("SHOW TABLES FROM ".$this->database." LIKE '{$table}'");
			}
			if($this->driver == 'sqlite'){
				$rs = $this->pdo->query("SELECT EXISTS(SELECT name FROM sqlite_master WHERE name = '{$table}')");
			}
			if($this->driver == 'pgsql'){
				$rs = $this->pdo->query("SELECT relname FROM pg_class WHERE relname = '{$table}'");
			}
			
			if($rs){
				$rows = $rs->fetchAll();
				$num_rows = count($rows);
				
				if($num_rows == 1){
					return true;
				}
				else{
					$message = sprintf('Table["%s"] does not exist in this database.', print_r($table, true));
					echo $message;
					return false;
				}
			}
		}
		
		public function rows() {
			return $this->rs->rowCount();
		}

		public function insert($table, array $dados){
			if($this->existTable($table)){
				
				$campos = array();
				$valores = array();
				$valor_sql = '';

				foreach ($dados as $keys => $values){
					$campos[] = $keys;
					$valores[] = $values;
					
					if(count($dados)<=1 || $keys==$this->endKey($dados))
						$valor_sql .= "?";
					else
						$valor_sql .= "?,";
				}
				$campos = implode(', ', $campos);
				try {
					$query = "INSERT INTO `{$table}` ({$campos}) VALUES ({$valor_sql})";
					$rs = $this->pdo->prepare($query);
					$rs->execute($valores);
					return true;
				} catch (Exception $e) {
					return false;
				}
				return false;
			}
		}
		
		public function read($table, $rows = '*', $where = null, $order = null, $limit = null) {
			
			if($this->existTable($table)) {
				if($where!=null && gettype($where)=='string') 
					$where_sql = "WHERE {$where}";
				else if($where!=null && gettype($where)=='array') {
					$where_sql = "WHERE ";
					$where_data = array();
					foreach ($where as $key => $value) {

						$key = strtolower($key);
						if(ctype_upper($value))
							$value = strtoupper($value);
						else
							$value = strtolower($value);

						if(count($where)<=1  || $key==$this->endKey($where))
							$where_sql .= "{$key} = ? ";
						else
							$where_sql .= " {$key} = ? AND ";

						$where_data[] = $value;
					}
					
				}
				else 
					$where_sql = "";

				$order = ($order!=null ? "ORDER BY {$order}" : "");
				$limit = ($limit!=null ? "LIMIT {$limit}" : "");
				
				if(gettype($rows) == 'array') {
					foreach ($rows as $keys) {
						$campos[] = $keys;
					}

					$campos = implode(', ', $campos);
				}
				if(gettype($rows) == 'string') {
					$campos = $rows;
				}
					
				$query = "SELECT {$campos} FROM `{$table}` {$where_sql} {$order} {$limit}";

				$rs = $this->pdo->prepare($query);
				

				if(isset($where_data))
					$rs->execute($where_data);
				

				$rs->setFetchMode(PDO::FETCH_ASSOC);
				$this->rs = $rs;
				return $rs->fetchAll();
			}
		}
		
		public function resave($table, $dados, $where){
			if($this->existTable($table)){
				foreach ($dados as $keys => $values){
					$campos[] = "{$keys} = '{$values}'";
				}
				$campos = implode(', ', $campos); 

				$sql =  "UPDATE `{$table}` SET {$campos} WHERE ";
				$where_data = array();
				foreach ($where as $key => $value) {

					$key = strtolower($key);
					$value = strtolower($value);

					if(count($where)<=1  || $key==$this->endKey($where))
						$sql .= "{$key} = ? ";
					else
						$sql .= " {$key} = ? AND ";

					$where_data[] = $value;
				}
				$rs = $this->pdo->prepare($sql);
				return (bool)$rs->execute($where_data);
			}
		}
		
		public function delete($table, $where){
			if($this->existTable($table)){
				return $this->pdo->query("DELETE FROM `{$table}` WHERE {$where}");
			}
		}
		
		public function exist($table, $field, $value){
			if($this->existTable($table)){
				if(isset($value) && isset($field)){
				
					$rs = $this->pdo->query("SELECT {$field} FROM `{$table}` WHERE {$field}='{$value}' ");
					if($rs->rowCount()>0)
						return true;
				}
				else
					return false;

				$this->close();
			}
		}
		
		public function listOne($table, $where = null){
			if($this->existTable($table)){
				$where = ($where!=null ? "WHERE {$where}" : "");
				$rs = $this->pdo->query("SELECT * FROM `{$table}` {$where}");	
				$rs->setFetchMode(PDO::FETCH_ASSOC);
				
				return $rs->fetch();

				$this->close();
			}
		}

		public function exec($sql){
			if(isset($sql))
				return $this->pdo->query($sql);
			else
				return false;
		}
		
		public function lastInsertId(){
			return $rs = $this->pdo->lastInsertId();
		}
	}