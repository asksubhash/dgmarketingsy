

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	
public function getAllNewsLetterUser($param = array())
	{
		if (isset($param['status']) && $param['status'] == 1) {
			$this->db->where('status', 1);
		}
		$result = $this->db->get('newsletter')->result_array();
		return $result;
	}
}

?>