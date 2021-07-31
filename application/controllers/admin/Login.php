
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


public function __construct(){
        parent::__construct();
		 // prevent from Browser Cache
	 $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	 $this->output->set_header('Pragma: no-cache');
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
	public function index(){

		$this->load->view('admin/login');
		
	}

	public function authenticate(){
	
		
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
	
		if($this->form_validation->run()==true){

			$email=$this->input->post('email',TRUE);
                        $password=$this->input->post('password',TRUE);

                        // get data admin tble
                        $admin=$this->admin_model->getByUserEmail($email);
                        
			if(!empty($admin)){
				  
				if (password_verify($password,$admin['password'] )) {
					
					$admin_data['admin_name']=$admin['name'];
					$admin_data['admin_id']=$admin['id'];
					$admin_data['admin_email']=$admin['email'];
					
					$this->session->set_userdata('admin',$admin_data);
					
					$this->load->view('admin/header');
				        $this->load->view('admin/dashboard');
				        $this->load->view('admin/footer');

				}else{
					
					$this->session->set_flashdata(['icon'=> 'warning','msg'=> 'password is incorect']);
			                   redirect(base_url().'admin/login/index');	
				}

			  }else{

				$this->session->set_flashdata([ 'icon'=> 'error','msg'=> 'Either username or password is incorect']);
			         redirect(base_url().'admin/login/index');
			 }

		}else{
			$this->load->view('admin/login');
		}
	}

	public function logOut(){

		$this->session->unset_userdata('admin');
		$this->session->set_flashdata(['icon'=> 'success','msg'=> 'you are log out successfully']);
		redirect(base_url().'admin/login/index');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */
?>