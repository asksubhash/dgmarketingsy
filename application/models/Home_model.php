
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

	public function insertGetInTouch($data)
	{
		$insert = $this->db->insert('touches', $data);
		return $insert;
	}
	public function insertNewsLetter($data)
	{
		$insert = $this->db->insert('newsletter', $data);
		return $insert;
	}
}

/* End of file Home_model.php */
/* Location: ./application/models/Home_model.php */
?>
