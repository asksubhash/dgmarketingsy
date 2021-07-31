<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{

	public function getAllCategory($param = array())
	{
		if (isset($param['status']) && $param['status'] == 1) {
			$this->db->where('status', 1);
		}
		$result = $this->db->get('categories')->result_array();
		return $result;
	}

	public function insertCategoryData($data)
	{
		$insert = $this->db->insert('categories', $data);
		return $insert;
	}

	public function getCategory($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('categories')->row_array();
		return $result;
	}

	public function statusChange($id, $status)
	{
		$data = (['status' => $status]);
		$this->db->where('id', $id);
		$result = $this->db->update('categories', $data);
		return $result;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('categories');
		return $result;
	}

	public function updateCategory($id, $data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('categories', $data);
		return $result;
	}
}

/* End of file Category_model.php */
/* Location: ./application/models/Category_model.php */
