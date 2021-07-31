
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		 // prevent from Browser Cache
		 $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		 $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		 $this->output->set_header('Pragma: no-cache');
		 $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$this->load->library("session");
		$admin = $this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata(['error' => 'warning', 'msg' => 'session has been expired ']);
			redirect(base_url() . 'admin/login/index');
		}
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
}


?>
