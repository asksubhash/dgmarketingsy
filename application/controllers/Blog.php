
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('post_model');
		$this->load->model('category_model');
		$this->load->model('slider_model');
		$this->load->model('comment_model');
		$this->load->helper('text');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
	}


	public function index($page = 1)
	{

		// recent post initiation
		$r_post_param['offset'] = 5;
		$r_post_param['limit'] = 0;
		$data['recent_posts'] = $this->post_model->getRecentPost($r_post_param);


		// home page integration 
		$perpage = 4;
		$param['offset'] = $perpage;
		$param['limit'] = ($page * $perpage) - $perpage;
		$config['base_url'] = base_url('blog/index');
		$config['total_rows'] = $this->post_model->getPostCount();
		$config['per_page'] = $perpage;
		$config['use_page_numbers'] = true;
		$param['order_by'] = 'asc';


		$config['full_tag_open'] = '<ul class="pagination blog-pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$category = $this->category_model->getAllCategory();
		// footer recent post 
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);

		$data['posts'] = $this->post_model->getPostFrontPage($param);
		$data['pagination_links'] = $pagination_link;
		$data['category'] = $category;
		$this->load->view('front/blog', $data);
	}


	public function category($id, $page = 1)
	{


		// recent post initiation
		$r_post_param['offset'] = 5;
		$r_post_param['limit'] = 0;
		$data['recent_posts'] = $this->post_model->getRecentPost($r_post_param);

		$category_name = $this->category_model->getCategory($id);
		if (empty($category_name)) {
			redirect(base_url('blog'));
		}


		// home page integration 
		$param['category'] = $id;
		$perpage = 4;
		$param['offset'] = $perpage;
		$param['limit'] = ($page * $perpage) - $perpage;
		$config['base_url'] = base_url('blog/category/' . $id);
		$config['uri_segment'] = 4;
		$config['total_rows'] = $this->post_model->getPostCount($param);
		$config['per_page'] = $perpage;
		$config['use_page_numbers'] = true;
		$param['order_by'] = 'asc';


		$config['full_tag_open'] = '<ul class="pagination blog-pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$category = $this->category_model->getAllCategory();
		// footer recent post 
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);

		$data['posts'] = $this->post_model->getPostFrontPage($param);
		$data['pagination_links'] = $pagination_link;
		$data['category'] = $category;
		$data['category_name'] = $category_name;
		$this->load->view('front/category', $data);
	}

	public function detail($id)
	{
		$r_post_param['offset'] = 5;
		$r_post_param['limit'] = 0;
		$data['recent_posts'] = $this->post_model->getRecentPost($r_post_param);

		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);

		$post = $this->post_model->getPostUsingId($id);

		if (empty($post)) {
			redirect(base_url('blog'));
		} else if (!empty($post)) {
			$related_post_param['offset'] = 6;
			$related_post_param['limit'] = 0;
			$related_post_param['category_id'] = $post['cat_id'];
			$latest_post = $this->post_model->getPostUsingCategoryId($related_post_param);
			if (!empty($latest_post)) {
				$data['latest_posts'] = $latest_post;
			}
		}

		// user comment 
		$data['comment'] = $this->comment_model->getCommentUsingPostId($id);
		$param['status'] = 1;
		$data['category'] = $this->category_model->getAllCategory($param);
		$data['post'] = $post;

		$this->load->view('front/detail', $data);
	}

	public function insertUserComment()
	{

		if (isset($_POST['form']) && $_POST['form'] == 'USER_COMMENT_FORM' && $_POST['form'] !== '') {


			$this->form_validation->set_rules('name', ' name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('comment', 'comment', 'trim|required|min_length[3]');
			if ($this->form_validation->run() == true) {

				$data = ([
					'name' => $this->input->post('name'),
					'post_id' => $this->input->post('post_id'),
					'comment' => $this->input->post('comment'),
					'created_at' => date("d-F-Y h:i:A"),
				]);

				$result = $this->comment_model->insertNewComment($data);
				if ($result) {
					$response = (['status' => true, 'msg' => 'Yoy Comment submit successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {
				$response['name_error'] = strip_tags(form_error('name'));
				$response['comment_error'] = strip_tags(form_error('comment'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			redirect(base_url('blog'));
		}
	}
}

?>
