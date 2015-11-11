<?php

namespace Agil\Model;

use Agil\Sql\Sql as SQL;

class Model extends SQL {
	public $table = '';
	public $prepare = array();
	public $hidden = array();
	public $fields = array();
	public $auto_fields = array();

	function __construct(array $inputs = array()) {
		parent::__construct();
		try {
			if (get_called_class()) 
				$table = explode("\\", get_called_class());
			else if (get_class($this)) 
				$table = explode("\\", get_class($this));

			$table = $table[(count($table)-1)];
			$table = implode('_', preg_split('/(?=[A-Z])/', $table));
			$this->table = strtolower(substr($table, 1));
			
			if(count($inputs)>0)
				$this->prepared($inputs);

		} catch (\Exception $e) {
			echo $e;
		}
	}

	private function prepared(array $inputs) {
		$sql = array();

		if(gettype($inputs)=='array' && gettype($this->fields)=='array' && gettype($this->auto_fields)=='array') {
			foreach ($inputs as $key => $value) {
				$fields = array_merge($this->fields, $this->hidden);
				if(!in_array($key, $fields)) {
					$message = sprintf('Field["%s"] does not exist in the table["%s"]', print_r($key, true), print_r($this->table, true));
					echo $message;
					return false;
				}
				if(in_array($key, $this->hidden)){
					$inputs[$key] = md5($value);
				}
			}
			foreach ($this->auto_fields as $key => $value) {
				if($value == 'create_date'){
					$sql[$value] = date('Y-m-d H:i:s');
				}
				if($value == 'update_date'){
					$sql[$value] = date('Y-m-d H:i:s');
				}
				if($value == 'status'){
					$sql[$value] = 1;
				}
			}
		}
		return $this->prepare = array_merge($inputs, $sql);
	}
	
	public function count($peace_sql) {
		$this->read($this->table, $this->fields, $peace_sql);
		return $this->rows();
	}

	public function extra($peace_sql) {
		return $this->read($this->table, $this->fields, $peace_sql);
	}

	public function get($where  = null, $order = null) {
		if($where)
			return $this->read($this->table, $this->fields, $where, $order);
		return $this->read($this->table, $this->fields);		
	}

	public function update($where) {
		return $this->resave($this->table, $this->fields, $where);		
	}
	
	public function save() {
		try {
			$sql = array();
			if(!empty($this->prepare) && gettype($this->prepare)=='array'){
				$sql = $this->prepare;
			}

			$this->insert($this->table, $sql);
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}