<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{
	public function getAllPost()
	{

		$this->db->select("post.*,categories.name as cat_name,categories.id as cat_id,");
		$this->db->from('post');
		$this->db->join('categories', 'post.cat_id = categories.id');
		$result = $this->db->get()->result_array();
		// $result = $this->db->get('post')->result_array();
		return $result;
	}

	public function insertPostData($data)
	{
		$insert = $this->db->insert('post', $data);
		return $insert;
	}

	public function getPost($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('post')->row_array();
		return $result;
	}

	public function statusChange($id, $status)
	{
		$data = (['status' => $status]);
		$this->db->where('id', $id);
		$result = $this->db->update('post', $data);
		return $result;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('post');
		return $result;
	}

	public function updatePost($id, $data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('post', $data);
		return $result;
	}

	// front view 
	public function getPostFrontPage($param = array())
	{
		if (isset($param['offset']) && isset($param['limit'])) {
			$this->db->limit($param['offset'], $param['limit']);
		}
		// if (isset($param['q'])) {
		// 	$this->db->or_like('post.tittle', trim($param['q']));
		// 	$this->db->or_like('post.author_id', trim($param['q']));
		// }
		if (isset($param['category']) && !empty($param['category'])) {
			$this->db->where('cat_id', $param['category']);
		}
		$this->db->select('post.*,categories.name as category_name,categories.id as category_id');
		if (isset($param['order_by'])) {
			if ($param['order_by'] == 'asc') {
				$this->db->order_by('post.id', 'ASC');
			} elseif ($param['order_by'] == 'desc') {
				$this->db->order_by('post.id', 'DESC');
			}
		}




		$this->db->join('categories', 'categories.id=post.cat_id', 'left');
		$query = $this->db->get('post')->result_array();
		return $query;
	}

	public function getPostCount($param = array())
	{
		if (isset($param['category']) && !empty($param['category'])) {
			$this->db->where('cat_id', $param['category']);
		}
		$count = $this->db->count_all_results('post');
		return $count;
	}


	public function getRecentPost($r_post_param = array())
	{

		if (isset($r_post_param['offset']) && isset($r_post_param['limit'])) {
			$this->db->limit($r_post_param['offset'], $r_post_param['limit']);
		}

		$this->db->select('post.*,categories.name as category_name,categories.id as category_id');
		$this->db->order_by('post.id', 'DESC');
		$this->db->join('categories', 'categories.id=post.cat_id', 'left');
		$query = $this->db->get('post')->result_array();

		return $query;
	}

	public function getPostUsingId($id)
	{


		$this->db->select('post.*,categories.name as category_name,categories.id as category_id');
		$this->db->where('post.id', $id, 'post.status', 1);
		$this->db->order_by('post.id', 'DESC');
		$this->db->join('categories', 'categories.id=post.cat_id', 'left');
		$query = $this->db->get('post')->row_array();

		return $query;
	}

	public function getPostUsingCategoryId($related_post_param = array())
	{
		$this->db->select('post.*,categories.name as category_name,categories.id as category_id');
		if (isset($related_post_param['offset']) && isset($related_post_param['limit'])) {
			$this->db->limit($related_post_param['offset'], $related_post_param['limit']);
		}
		$this->db->where('post.cat_id', $related_post_param['category_id'], 'post.status', 1);
		$this->db->join('categories', 'categories.id=post.cat_id', 'left');
		$query = $this->db->get('post')->result_array();

		return $query;
	}
}
