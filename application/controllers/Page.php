
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('post_model');
		$this->load->model('category_model');
		$this->load->model('slider_model');
		$this->load->model('home_model');
		$this->load->helper('text');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
	}

	public function service()
	{
		$data['category'] = $this->category_model->getAllCategory();
		// footer recent post 
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);
		$this->load->view('front/service', $data);
	}

	public function about()
	{
		$data['category'] = $this->category_model->getAllCategory();
		// footer recent post 
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);
		$this->load->view('front/about', $data);
	}



	public function contact()
	{
		$data['slider'] = $this->slider_model->getAllSlider();
		$data['category'] = $this->category_model->getAllCategory();
		$r_post_param['offset'] = 4;
		$r_post_param['limit'] = 0;
		$data['recent_post'] = $this->post_model->getRecentPost($r_post_param);
		$this->load->view('front/contact', $data);
	}

	public function insertGetInTouch()
	{

		if (isset($_POST['form']) && $_POST['form'] == 'GET_IN_TOUCH_FORM') {



			$this->form_validation->set_rules('name', ' name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('last_name', 'last Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('email', 'email Address', 'trim|required|valid_email|is_unique[touches.email]');
			$this->form_validation->set_rules('subject', 'subject', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('desc', 'description', 'trim|required|min_length[10]');

			if ($this->form_validation->run() == true) {

				$data = ([
					'email' => $this->input->post('email'),
					'f_name' => $this->input->post('name'),
					'l_name' => $this->input->post('last_name'),
					'subject' => $this->input->post('subject'),
					'desc' => $this->input->post('desc'),
					'created_at' => date("d-F-Y h:i:A"),
				]);

				$result = $this->home_model->insertGetInTouch($data);
				if ($result) {
					$response = (['status' => true, 'msg' => 'submit successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {
				$response['name_error'] = strip_tags(form_error('name'));
				$response['l_name_error'] = strip_tags(form_error('last_name'));
				$response['email_error'] = strip_tags(form_error('email'));
				$response['subject_error'] = strip_tags(form_error('subject'));
				$response['desc_error'] = strip_tags(form_error('desc'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('front/home', $new_array);
		}
	}

	public function newsLetter()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'NEWS_LETTER_EMAIL_FORM') {
			$this->form_validation->set_rules('email', 'email Address', 'trim|required|valid_email|is_unique[newsletter.email]');
			if ($this->form_validation->run() == true) {

				$data = ([
					'email' => $this->input->post('email'),
					'created_at' => date("d-F-Y h:i:A"),
				]);

				$result = $this->home_model->insertNewsLetter($data);
				if ($result) {
					$response = (['status' => true, 'msg' => 'submit successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {

				$response['email_error'] = strip_tags(form_error('email'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('front/home', $new_array);
		}
	}
}
?>
