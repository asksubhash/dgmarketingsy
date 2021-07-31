

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{


	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('category_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		 // prevent from Browser Cache
		 $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		 $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		 $this->output->set_header('Pragma: no-cache');
		 $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$admin = $this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata(['error' => 'warning', 'msg' => 'session has been expired ']);
			redirect(base_url() . 'admin/login/index');
		}
	}

	public function index()
	{

		$this->load->view('admin/header');
		$category['category'] = $this->category_model->getAllCategory();
		$this->load->view('admin/category/list', $category);
		$this->load->view('admin/footer');
	}

	public function create()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'CATEGORY_INSERT_FORM') {

			$config['upload_path']          = './public/admin/uploads/category/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name']        = true;
			$this->load->library('upload', $config);

			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('category_desc', 'Category Description', 'trim|required');

			if ($this->form_validation->run() == true) {

				if (!empty($_FILES['image']['name'])) {
					if ($this->upload->do_upload('image')) {

						$data = $this->upload->data();
						$data = ([
							'name' => $this->input->post('category_name'),
							'desc' => $this->input->post('category_desc'),
							'image' => $data['file_name'],
							'created_at' => date("d-F-Y h:i:A"),
						]);

						$result = $this->category_model->insertCategoryData($data);
						if ($result) {
							$response = (['status' => true, 'msg' => 'category insert successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					} else {
						$image_error = $this->upload->display_errors();
						$response['category_image_error'] = $image_error;
						$response['status'] = 'form_error';
					}
				} else {
					$data = ([
						'name' => $this->input->post('category_name'),
						'desc' => $this->input->post('category_desc'),
						'created_at' => date("d-F-Y h:i:A"),
					]);
					$result = $this->category_model->insertCategoryData($data);
					if ($result) {
						$response = (['status' => true, 'msg' => 'category insert successfully']);
					} else {
						$response = (['status' => false, 'msg' => 'Something Went Wrong']);
					}
				}
			} else {
				$response['category_name_error'] = strip_tags(form_error('category_name'));
				$response['category_desc_error'] = strip_tags(form_error('category_desc'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$this->load->view('admin/header');
			$category['category'] = $this->category_model->getAllCategory();
			$this->load->view('admin/category/list', $category);
			$this->load->view('admin/footer');
		}
	}

	public function status_update()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'CATEGORY_STATUS_CHANGE') {
			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('value')) || !is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$active_status = ($this->input->post('value') == 1) ? 0 : 1;
				$change_status = $this->category_model->statusChange($this->input->post('id'), $active_status);
				if ($change_status) {
					$response = (['status' => true, 'msg' => 'category status change successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$this->load->view('admin/header');
			$category['category'] = $this->category_model->getAllCategory();
			$this->load->view('admin/category/list', $category);
			$this->load->view('admin/footer');
		}
	}

	public function delete()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'DELETE_CATEGORY_FORM') {

			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$category = $this->category_model->getCategory($this->input->post('id'));

				if (!empty($category)) {
					if (file_exists('./public/admin/uploads/category/' . $category['image'])) {
						unlink('./public/admin/uploads/category/' . $category['image']);
					}

					$delete_record = $this->category_model->delete($this->input->post('id'));;
					if ($delete_record == true) {
						$response = (['status' => true, 'msg' => 'Category record delete successfully']);
					} else {
						$response = (['status' => false, 'msg' => 'Something Went Wrong']);
					}
				} else {
					$response = (['status' => false, 'msg' => 'Category not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$this->load->view('admin/header');
			$category['category'] = $this->category_model->getAllCategory();
			$this->load->view('admin/category/list', $category);
			$this->load->view('admin/footer');
		}
	}

	public function showCategory()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'GET_CATEGORY_DATA') {
			if (!empty($this->input->post('id'))) {

				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}

				$category = $this->category_model->getCategory($this->input->post('id'));
				if (!empty($category)) {
					$response = (['status' => true, 'data' => $category]);
				} else {
					$response = (['status' => false, 'msg' => 'category not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$this->load->view('admin/header');
			$category['category'] = $this->category_model->getAllCategory();
			$this->load->view('admin/category/list', $category);
			$this->load->view('admin/footer');
		}
	}

	public function update()
	{
		if (isset($_POST['form']) && $_POST['form'] = 'CATEGORY_UPDATE_FORM') {
			$config['upload_path']          = './public/admin/uploads/category/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name']        = true;
			$this->load->library('upload', $config);

			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('category_desc', 'Category Description', 'trim|required');

			if ($this->form_validation->run() == true) {


				$category = $this->category_model->getCategory($this->input->post('id'));

				if (!empty($category)) {

					if (!empty($_FILES['image']['name'])) {
						if ($this->upload->do_upload('image')) {

							$data = $this->upload->data();
							$data = ([
								'name' => $this->input->post('category_name'),
								'desc' => $this->input->post('category_desc'),
								'image' => $data['file_name'],
								'updated_at' => date("d-F-Y h:i:A"),
							]);

							$result = $this->category_model->updateCategory($this->input->post('id'), $data);
							if ($result) {
								if (file_exists('./public/admin/uploads/category/' . $category['image'])) {
									unlink('./public/admin/uploads/category/' . $category['image']);
								}
								$response = (['status' => true, 'msg' => 'category update successfully']);
							} else {
								$response = (['status' => false, 'msg' => 'Something Went Wrong']);
							}
						} else {
							$image_error = $this->upload->display_errors();
							$response['category_image_error'] = $image_error;
							$response['status'] = 'form_error';
						}
					} else {
						$data = ([
							'name' => $this->input->post('category_name'),
							'desc' => $this->input->post('category_desc'),
							'updated_at' => date("d-F-Y h:i:A"),
						]);
						$result = $this->category_model->updateCategory($this->input->post('id'), $data);
						if ($result) {
							$response = (['status' => true, 'msg' => 'category update successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					}
				} else {
					$response = (['status' => false, 'msg' => 'Category not found']);
				}
			} else {
				$response['category_name_error'] = strip_tags(form_error('category_name'));
				$response['category_desc_error'] = strip_tags(form_error('category_desc'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$this->load->view('admin/header');
			$category['category'] = $this->category_model->getAllCategory();
			$this->load->view('admin/category/list', $category);
			$this->load->view('admin/footer');
		}
	}
}

?>
