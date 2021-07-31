

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment_model extends CI_Model
{


	public function insertNewComment($data)
	{
		$insert = $this->db->insert('comment', $data);
		return $insert;
	}

	public function getCommentUsingPostId($id)
	{
		$this->db->where('post_id', $id, 'status', 1);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('comment')->result_array();

		return $query;
	}
}

/* End of file Comment_model.php */
/* Location: ./application/models/Comment_model.php */
?>
