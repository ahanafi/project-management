<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['customer'] = $this->Customer->all_customer();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('customer/list_customer');
		$this->load->view('templates/footer');
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama Customer', 'required');
			$this->form_validation->set_rules('telp', 'No. Telo', 'required|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header');
				$this->load->view('templates/sidebar');
				$this->load->view('customer/add_customer');
				$this->load->view('templates/footer');
			} else {
				$data = array(
						'id'	=> NULL,
						'nama'	=> $this->input->post('nama'),
						'telp'	=> $this->input->post('telp'),
						'alamat'=> $this->input->post('alamat')
					);
				return $this->Customer->insert($data);
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('customer/add_customer');
			$this->load->view('templates/footer');
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('customer'));
		} else {
			if ($this->customlib->check_id('customer', $id)) {
				$data['cust'] = $this->Customer->customer_id($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('customer/edit_customer');
				$this->load->view('templates/footer');
			} else {
				redirect(base_url('customer'),'refresh');
			}
		}
	}

	public function update($id)
	{
		if (!$id) {
			redirect(base_url('customer'));
		} else {
			if ($this->customlib->check_id('customer', $id)) {
				$this->form_validation->set_rules('nama', 'Nama Customer', 'required');
				$this->form_validation->set_rules('telp', 'No. Telo', 'required|numeric');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
				$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

				if ($this->form_validation->run() == FALSE) {
					$data['cust'] = $this->Customer->customer_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('customer/edit_customer');
					$this->load->view('templates/footer');
				} else {
					$data = array(
							'nama'	=> $this->input->post('nama'),
							'telp'	=> $this->input->post('telp'),
							'alamat'=> $this->input->post('alamat')
						);
					return $this->Customer->update($data, $id);
				}
			}
		}
	}

	public function delete($id)
	{
		if (!$id) {
			redirect(base_url('customer'));
		} else {
			if ($this->customlib->check_id('customer', $id)) {
				$this->Customer->delete($id);
			} else {
				redirect(base_url('customer'));
			}
		}
	}

}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */