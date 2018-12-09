<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	public function index()
	{
		$data = array(
				'code' => 404,
				'text' => 'Maaf! Halaman tidak ditemukan'
				//'text' => 'Oops! Page Not Found.'
			);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('errors/404');
	}

	public function forbidden()
	{
		$data = array(
				'code' => 403,
				'text' => 'Maaf! Direktori tidak dapat diakses!'
				//'text' => 'Oops! Access forbidden.'
			);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('errors/404');
	}

	public function server_error()
	{
		$data = array(
				'code' => 500,
				'text' => 'Maaf! Server bermasalah!'
				//'text' => 'Oops! Page Not Found.'
			);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('errors/500');
	}

}

/* End of file Errors.php */
/* Location: ./application/controllers/Errors.php */