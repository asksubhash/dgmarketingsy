<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('category_model');
		$this->load->model('slider_model');
		$this->load->model('post_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
	}

	public function index()
	{
		$r_post_param['offset'] = 6;
		$r_post_param['limit'] = 0;
		$data['recent_posts'] = $this->post_model->getRecentPost($r_post_param);
		$data['slider'] = $this->slider_model->getAllSlider();

		// footer recent post 
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);


		$data['category'] = $this->category_model->getAllCategory();
		$this->load->view('front/home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
