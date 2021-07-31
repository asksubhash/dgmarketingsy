

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('user_model');
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
		$data['newsletter'] = $this->user_model->getAllNewsLetterUser();

		$this->load->view('admin/user/list', $data);
		$this->load->view('admin/footer');
	}
}

?>
