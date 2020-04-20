<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condition_model extends CI_Model {

	var $table = 'tbl_conditions';
	var $column = array('description','code','category');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		    $this->search = '';

	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id, $description, $code)
	{
		$query_temp_del = "DELETE FROM tbl_temp WHERE str_condition LIKE '%$description%' || str_condition LIKE '%$code%';";
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$this->db->query($query_temp_del);
	}

		public function get_by_id_view($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	function getAllGroups()
	{
	    $this->db->from($this->table);
		// $this->db->where('plan_id', $plan_id);
		$this->db->order_by("id");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function saveDirectory($where, $data)
	{
		// $this->db->query("UPDATE tbl_directory SET dirName = '$data' WHERE id = '1';");
		$this->db->update("tbl_directory", $data, $where);
		return $this->db->affected_rows();
		// return $this->db->affected_rows();
	}

	public function getDir()
	{
		return $this->db->query('SELECT dirName FROM tbl_directory WHERE id=1')->result();

	}

	public function is_temp($temp_condition)
	{	
		$query = "SELECT * FROM tbl_temp WHERE str_condition= '$temp_condition';";
		// var_dump($query);exit;
		return $this->db->query($query)->result_array();
	}
	public function temp_save($values)
	{
		$query = "INSERT INTO tbl_temp(url, str_condition, filename, filetype, title, dataUrl, width, height) VALUES $values";
		$this->db->query($query);
	}

}
