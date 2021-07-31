<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider_model extends CI_Model
{


	public function getAllSlider()
	{

		$this->db->select("slider.*,categories.name as cat_name,categories.id as cat_id,");
		$this->db->from('slider');
		$this->db->join('categories', 'slider.cat_id = categories.id');
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function insertSliderData($data)
	{
		$insert = $this->db->insert('slider', $data);
		return $insert;
	}

	public function getSlider($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('slider')->row_array();
		return $result;
	}

	public function statusChange($id, $status)
	{
		$data = (['status' => $status]);
		$this->db->where('id', $id);
		$result = $this->db->update('slider', $data);
		return $result;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('slider');
		return $result;
	}

	public function updateSlider($id, $data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('slider', $data);
		return $result;
	}
}

/* End of file Slider_model.php */
/* Location: ./application/models/Slider_model.php */
