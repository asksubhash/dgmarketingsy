

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory_model extends CI_Model {

	public function getAllSubCategory(){
		
		$result = $this->db->get('subcategories')->result_array();
		return $result;
	}

}

/* End of file SubCAtegory_model.php */
/* Location: ./application/models/SubCAtegory_model.php */
?>