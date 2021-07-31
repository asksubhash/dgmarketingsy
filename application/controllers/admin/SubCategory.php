<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('SubCategory_model');
		$this->load->model('category_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$admin = $this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata(['error' => 'warning', 'msg' => 'session has been expired ']);
			redirect(base_url() . 'admin/login/index');
		}
	}

	public function index()
	{
		

		$this->load->view('admin/header');
		$subcategory['subcategory'] = $this->SubCategory_model->getAllSubCategory();
		$this->load->view('admin/subcategory/list',$subcategory);
		$this->load->view('admin/footer');
		
	}

}

/* End of file SubCategory.php */
/* Location: ./application/controllers/admin/SubCategory.php */
