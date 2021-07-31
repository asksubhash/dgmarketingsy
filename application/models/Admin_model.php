<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{


	function getByUserEmail($email)
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return  $query->row_array();
		}
	}

	
}
