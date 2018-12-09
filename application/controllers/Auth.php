<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_Model');
		//echo password_hash("123456", PASSWORD_DEFAULT);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect(base_url('dashboard'));
		} else {
			$this->load->view('auth/form_login');
		}
	}

	public function login()
	{
		if ($this->input->post('login')) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('devisi', 'Devisi', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('auth/form_login');
			} else {
				$login = $this->Auth_Model->login();
				if ($login) {
					redirect(base_url('dashboard'));
				} else {
					/*echo "<script type='text/javascript'>
							alert('Login Gagal! Silahkan ulangi lagi!');
							window.location='".base_url('auth')."';
						</script>";*/
					$data['modal'] = true;
					$this->load->view('auth/form_login', $data);
				}
			}
		} else {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */