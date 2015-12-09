<?php

namespace Agil\Model;

use Agil\Helpers\Sql as Sql;

class Model extends Sql {
	public $table = '';
	public $fields = array();
	public $hidden = array();

	function __construct() {
		parent::__construct();
		try {
			if (get_called_class()) 
				$table = explode("\\", get_called_class());
			else if (get_class($this)) 
				$table = explode("\\", get_class($this));
			$this->table = strtolower($table[(count($table)-1)]);

		} catch (\Exception $e) {
			echo $e;
		}
	}

	public function get($where = null) {
		return $this->read($this->table, $this->fields, $where);
	}

	public function save($fields) {
		try {
			if(!empty($fields) && !empty($this->fields)) {
				$sql = array();
				foreach ($fields as $key => $value) {
					if(in_array($key, $this->fields)) {
						if(in_array($key, $this->hidden))
							$sql[$key] = md5($value);
						else
							$sql[$key] = $value;
					}
				}
				$sql['create_date'] = date('Y-m-d H:i:s');
				$sql['update_date'] = date('Y-m-d H:i:s');
				$sql['status'] = 1;
				return $this->insert($this->table, $sql);
			}
		} catch (Exception $e) {
			echo $e;
			return false;
		}
		return false;
	}
}