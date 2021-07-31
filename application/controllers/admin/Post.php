

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('post_model');
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
		$post['post'] = $this->post_model->getAllPost();
		$category['category'] = $this->category_model->getAllCategory();
		$new_array = array_merge($post, $category);
		$this->load->view('admin/header');
		$this->load->view('admin/post/list', $new_array);
		$this->load->view('admin/footer');
	}

	public function create()
	{

		if (isset($_POST['form']) && $_POST['form'] == 'ADD_NEW_POST_FORM') {

			$config['upload_path']          = './public/admin/uploads/post/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name']        = true;
			$this->load->library('upload', $config);

			$this->form_validation->set_rules('tittle', 'Post Tittle', 'trim|required');
			$this->form_validation->set_rules('cate_id', 'Post category', 'trim|required');
			$this->form_validation->set_rules('author', 'Post author', 'trim|required');
			$this->form_validation->set_rules('meta', 'Post meta tags', 'trim|required');
			$this->form_validation->set_rules('slug', 'Post slug ', 'trim|required');
			$this->form_validation->set_rules('desc', 'Post content', 'trim|required');

			if ($this->form_validation->run() == true) {

				if (!empty($_FILES['image']['name'])) {
					if ($this->upload->do_upload('image')) {
						$data = $this->upload->data();
						$data = ([
							'author_name' => $this->input->post('author'),
							'cat_id' => $this->input->post('cate_id'),
							'tittle' => $this->input->post('tittle'),
							'meta_tittle' => $this->input->post('meta'),
							'slug' => $this->input->post('slug'),
							'desc' => $this->input->post('desc'),
							'image' => $data['file_name'],
							'created_at' => date('Y-m-d H:i:s'),
						]);

						$result = $this->post_model->insertPostData($data);
						if ($result) {
							$response = (['status' => true, 'msg' => 'Post  insert successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					} else {
						$image_error = $this->upload->display_errors();
						$response['post_image_error'] = $image_error;
						$response['status'] = 'form_error';
					}
				}
			} else {
				$response['post_tittle_error'] = strip_tags(form_error('tittle'));
				$response['post_category_error'] = strip_tags(form_error('cate_id'));
				$response['post_meta_error'] = strip_tags(form_error('meta'));
				$response['post_slug_error'] = strip_tags(form_error('slug'));
				$response['post_desc_error'] = strip_tags(form_error('desc'));
				$response['post_author_error'] = strip_tags(form_error('author'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			$post['post'] = $this->post_model->getAllPost();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($post, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/post/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function status_update()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'POST_STATUS_CHANGE') {
			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('value')) || !is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$active_status = ($this->input->post('value') == 1) ? 0 : 1;
				$change_status = $this->post_model->statusChange($this->input->post('id'), $active_status);
				if ($change_status) {
					$response = (['status' => true, 'msg' => 'Post status change successfully']);
				} else {
					$response = (['status' => false, 'msg' => 'Something Went Wrong']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$post['post'] = $this->post_model->getAllPost();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($post, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/post/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function delete()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'DELETE_POST_FORM') {

			if (!empty($this->input->post('id'))) {
				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}
				$post = $this->post_model->getPost($this->input->post('id'));

				if (!empty($post)) {
					if (file_exists('./public/admin/uploads/post/' . $post['image']) == true) {
						unlink('./public/admin/uploads/post/' . $post['image']);
					}

					$delete_record = $this->post_model->delete($this->input->post('id'));;
					if ($delete_record == true) {
						$response = (['status' => true, 'msg' => 'Post record delete successfully']);
					} else {
						$response = (['status' => false, 'msg' => 'Something Went Wrong']);
					}
				} else {
					$response = (['status' => false, 'msg' => 'Post not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$post['post'] = $this->post_model->getAllPost();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($post, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/post/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function showPost()
	{
		if (isset($_POST['form']) && $_POST['form'] == 'GET_POST_DATA') {
			if (!empty($this->input->post('id'))) {

				if (!is_numeric($this->input->post('id'))) {
					$response = ([
						'status' => false,
						'msg' => 'Invalid values provided. Please check value type.'
					]);
				}

				$post = $this->post_model->getPost($this->input->post('id'));
				$category = $this->category_model->getAllCategory();

				if (!empty($post)) {
					$response = (['status' => true, 'data' => $post, 'category' => $category]);
				} else {
					$response = (['status' => false, 'msg' => 'post not found']);
				}
			} else {
				$response = (['status' => false, 'msg' => 'Field required']);
			}
			echo json_encode($response);
		} else {
			$post['post'] = $this->post_model->getAllPost();
			$category['category'] = $this->category_model->getAllCategory();
			$new_array = array_merge($post, $category);
			$this->load->view('admin/header');
			$this->load->view('admin/post/list', $new_array);
			$this->load->view('admin/footer');
		}
	}

	public function update()
	{
		if (isset($_POST['form']) && $_POST['form'] = 'UPDATE_POST_FORM') {
			$config['upload_path']          = './public/admin/uploads/post/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name']        = true;
			$this->load->library('upload', $config);

			$this->form_validation->set_rules('tittle', 'Post Tittle', 'trim|required');
			$this->form_validation->set_rules('cate_id', 'Post category', 'trim|required');
			$this->form_validation->set_rules('author', 'Post author', 'trim|required');
			$this->form_validation->set_rules('meta', 'Post meta tags', 'trim|required');
			$this->form_validation->set_rules('slug', 'Post slug ', 'trim|required');
			$this->form_validation->set_rules('desc', 'Post content', 'trim|required');

			if ($this->form_validation->run() == true) {
				$post = $this->post_model->getPost($this->input->post('id'));

				if (!empty($post)) {
					if (!empty($_FILES['image']['name'])) {
						if ($this->upload->do_upload('image')) {
							$data = $this->upload->data();
							$data = ([
								'author_name' => $this->input->post('author'),
								'cat_id' => $this->input->post('cate_id'),
								'tittle' => $this->input->post('tittle'),
								'meta_tittle' => $this->input->post('meta'),
								'slug' => $this->input->post('slug'),
								'desc' => $this->input->post('desc'),
								'image' => $data['file_name'],
								'updated_at' => date('Y-m-d H:i:s'),
							]);

							$result = $this->post_model->updatePost($this->input->post('id'), $data);
							if ($result) {
								if (file_exists('./public/admin/uploads/post/' . $post['image']) == true) {
									unlink('./public/admin/uploads/post/' . $post['image']);
								}
								$response = (['status' => true, 'msg' => 'post update successfully']);
							} else {
								$response = (['status' => false, 'msg' => 'Something Went Wrong']);
							}
						} else {
							$image_error = $this->upload->display_errors();
							$response['update_post_img_error'] = $image_error;
							$response['status'] = 'form_error';
						}
					} else {
						$data = ([
							'author_name' => $this->input->post('author'),
							'cat_id' => $this->input->post('cate_id'),
							'tittle' => $this->input->post('tittle'),
							'meta_tittle' => $this->input->post('meta'),
							'slug' => $this->input->post('slug'),
							'desc' => $this->input->post('desc'),
							'updated_at' => date('Y-m-d H:i:s'),
						]);

						$result = $this->post_model->updatePost($this->input->post('id'), $data);
						if ($result) {
							$response = (['status' => true, 'msg' => 'post update successfully']);
						} else {
							$response = (['status' => false, 'msg' => 'Something Went Wrong']);
						}
					}
				} else {
					$response = (['status' => false, 'msg' => 'post not found']);
				}
			} else {
				$response['update_post_tittle_error'] = strip_tags(form_error('tittle'));
				$response['update_post_category_error'] = strip_tags(form_error('cate_id'));
				$response['update_post_meta_error'] = strip_tags(form_error('meta'));
				$response['update_post_slug_error'] = strip_tags(form_error('slug'));
				$response['update_post_desc_error'] = strip_tags(form_error('desc'));
				$response['update_post_author_error'] = strip_tags(form_error('author'));
				$response['status'] = 'form_error';
			}
			echo json_encode($response);
		} else {
			echo 'hello';
		}
	}
}

?>
