<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('category_model');
		$this->load->model('slider_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('image_lib');
		 // prevent from Browser Cache
		 $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		 $this->output->set_header('Pragma: no-cache');
		$admin = $this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata(['error' => 'warning', 'msg' => 'session has been expired ']);
			redirect(base_url() . 'admin/login/index');
		}
	}


	public function index()
	{
		$slider['slider'] = $this->slider_model->getAllSlider();
		$category['category'] = $this->category_model->getAllCategory();
		$new_array = array_merge($slider, $category);
		$this->load->view('admin/header');
		$this->load->view('admin/slider/list', $new_array);
		$this->load->view('admin/footer');
	}

	public function create()
	{

		if (isset($_POST['form']) && $_POST['form'] == 'ADD_NEW_SLIDER_FORM') {

			$config['upload_path']          = './public/admin/uploads/slider/';
			$config['allowed_types']        = 'jpg|gif|png|jpeg';
			$config['encrypt_name']        = true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->form_validation->set_rules('tittle', 'Slider Tittle', 'trim|required');
			$this->form_validation->set_rules('cate_id', 'Slider category', 'trim|required');

			if ($this->form_validation->run() == true) {

				if (!empty($_FILES['image']['name'])) {
					if ($this->upload->do_upload('image')) {

						$data_img = $this->upload->data();

						$data = ([
							'cat_id' => $this->input->post('cate_id'),
							'tittle' => $this->input->post('tittle'),
							'image' => $data_img['file_name'],
							'created_at' => date("d-F-Y h:i:A"),
						]);

						$result = $this->slider_model->insertSliderData($data);

						$config_img = array(
							'image_library' => 'gd2',
							'allowed_types' => 'jpg|jpeg|png',
							'source_image' => './public/admin/uploads/slider/' . $data_img['file_name'],
							'new_image' => './public/admin/uploads/slider/thumb/' . $data_img['file_name'],
							'create_thumb' => FALSE,
							'maintain_ratio' => TRUE,
							'width' => 1920,
							'height' => 649,
							'quality' => 50,
						);
						$this->image_lib->initialize($config_img);
						$this->image_lib->resize();
						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}
						$this->image_lib->clear();
						if ($result) {
							$response = (['status' => true, 'msg' => 'Slider  insert successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					} else {
						$image_error = $this->upload->display_errors();
						$response['slider_image_error'] = $image_error;
						$response['status'] = 'form_error';
					}
				}
			} else {
				$response['slider_tittle_error'] = strip_tags(form_error('tittle'));
				$response['slider_category_error'] = strip_tags(form_error('cate_id'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/slider/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function status_update()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'SLIDER_STATUS_CHANGE') {
			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('value')) || !is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$active_status = ($this->input->post('value') == 1) ? 0 : 1;
				$change_status = $this->slider_model->statusChange($this->input->post('id'), $active_status);
				if ($change_status) {
					$response = (['status' => true, 'msg' => 'Slider status change successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/slider/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function delete()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'DELETE_SLIDER_FORM') {

			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$slider = $this->slider_model->getSlider($this->input->post('id'));

				if (!empty($slider)) {
					if (file_exists('./public/admin/uploads/slider/' . $slider['image']) == true) {
						unlink('./public/admin/uploads/slider/' . $slider['image']);
					}
					if (file_exists('./public/admin/uploads/slider/thumb/' . $slider['image'])) {
						unlink('./public/admin/uploads/slider/thumb/' . $slider['image']);
					}

					$delete_record = $this->slider_model->delete($this->input->post('id'));;
					if ($delete_record == true) {
						$response = (['status' => true, 'msg' => 'Slider record delete successfully']);
					} else {
						$response = (['status' => false, 'msg' => 'Something Went Wrong']);
					}
				} else {
					$response = (['status' => false, 'msg' => 'Slider not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/slider/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function showSlider()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'GET_SLIDER_DATA') {
			if (!empty($this->input->post('id'))) {

				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}

				$slider = $this->slider_model->getSlider($this->input->post('id'));
				$category = $this->category_model->getAllCategory();

				if (!empty($slider)) {
					$response = (['status' => true, 'data' => $slider, 'category' => $category]);
				} else {
					$response = (['status' => false, 'msg' => 'slider not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Wrong credential']);
			}
			echo json_encode($response);
		} else {
			$slider['slider'] = $this->slider_model->getAllSlider();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($slider, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/slider/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function update()
	{
		if (isset($_POST['form']) && $_POST['form'] = 'UPDATE_SLIDER_FORM') {
			$config['upload_path']          = './public/admin/uploads/slider/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name']        = true;
			$this->load->library('upload', $config);

			$this->form_validation->set_rules('tittle', 'Post Tittle', 'trim|required');
			$this->form_validation->set_rules('cate_id', 'Post category', 'trim|required');

			if ($this->form_validation->run() == true) {
				$slider = $this->slider_model->getSlider($this->input->post('id'));

				if (!empty($slider)) {
					if (!empty($_FILES['image']['name'])) {
						if ($this->upload->do_upload('image')) {
							$data_post = $this->upload->data();
							$data = ([
								'cat_id' => $this->input->post('cate_id'),
								'tittle' => $this->input->post('tittle'),
								'image' => $data_post['file_name'],
								'updated_at' => date("d-F-Y h:i:A"),
							]);

							$result = $this->slider_model->updateSlider($this->input->post('id'), $data);

							$config_img = array(
								'image_library' => 'gd2',
								'allowed_types' => 'jpg|jpeg|png',
								'source_image' => './public/admin/uploads/slider/' . $data_post['file_name'],
								'new_image' => './public/admin/uploads/slider/thumb/' . $data_post['file_name'],
								'create_thumb' => FALSE,
								'maintain_ratio' => TRUE,
								'width' => 1920,
								'height' => 649,
								'quality' => 50,
							);
							$this->image_lib->initialize($config_img);
							$this->image_lib->resize();
							if (!$this->image_lib->resize()) {
								echo $this->image_lib->display_errors();
							}
							$this->image_lib->clear();

							if ($result) {
								if (file_exists('./public/admin/uploads/slider/' . $slider['image']) == true) {
									unlink('./public/admin/uploads/slider/' . $slider['image']);
								}
								if (file_exists('./public/admin/uploads/slider/thumb/' . $slider['image'])) {
									unlink('./public/admin/uploads/slider/thumb/' . $slider['image']);
								}

								$response = (['status' => true, 'msg' => 'Slider update successfully']);
							} else {
								$response = (['status' => false, 'msg' => 'Something Went Wrong']);
							}
						} else {
							$image_error = $this->upload->display_errors();
							$response['update_slider_img_error'] = $image_error;
							$response['status'] = 'form_error';
						}
					} else {
						$data = ([
							'cat_id' => $this->input->post('cate_id'),
							'tittle' => $this->input->post('tittle'),
							'updated_at' => date("d-F-Y h:i:A"),
						]);

						$result = $this->slider_model->updateSlider($this->input->post('id'), $data);
						if ($result) {
							$response = (['status' => true, 'msg' => 'Slider update successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					}
				} else {
					$response = (['status' => false, 'msg' => 'Slider not found']);
				}
			} else {
				$response['update_Slider_tittle_error'] = strip_tags(form_error('tittle'));
				$response['update_slider_category_error'] = strip_tags(form_error('cate_id'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			echo 'hello';
		}
	}
}
