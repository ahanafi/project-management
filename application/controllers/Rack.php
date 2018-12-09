<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rack extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->customlib->is_login('logged_in')) {
			if ($this->session->devisi != "Gudang") {
				redirect(base_url('dashboard'),'refresh');
			}
		} else {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function index()
	{
		$data['racks'] = $this->Rack->rack_all();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/rack');
		$this->load->view('templates/footer');
	}

	public function add()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('nama_rak', 'Nama rak', 'required|min_length[5]');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			if ($this->form_validation->run() == FALSE) {
				$data['modal'] = true;
				$data['racks'] = $this->Rack->rack_all();
				$data['no'] = 1;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('dashboard/rack');
				$this->load->view('templates/header');
			} else {
				$data = array(
						'id' => NULL,
						'nama_rak' => $this->input->post('nama_rak')
					);
				$this->Rack->insert($data);
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard/rack'),'refresh');
		} else {
			if ($this->customlib->check_id('rack', $id)) {
				$data['rack'] = $this->Rack->rack_id($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('rack/update_rack');
				$this->load->view('templates/footer');
			} else {
				redirect(base_url('dashboard/rack'),'refresh');
			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard/rack'),'refresh');
		} else {
			if ($this->customlib->check_id('rack', $id)) {
				if ($this->input->post('update')) {
					$this->form_validation->set_rules('nama_rak', 'Nama Rak', 'required');
					$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
					if ($this->form_validation->run() == FALSE) {
						$data['rack'] = $this->Rack->rack_id($id);
						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('rack/update_rack');
						$this->load->view('templates/footer');
					} else {
						$this->Rack->update($id, array('nama_rak' => $this->input->post('nama_rak')));
					}
				} else {
					redirect(base_url('dashboard/rack'),'refresh');	
				}
			} else {
				redirect(base_url('dashboard/rack'),'refresh');
			}
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard/rack'),'refresh');
		} else {
			if ($this->customlib->check_id('rack', $id)) {
				return $this->Rack->delete($id);
			} else {
				redirect(base_url('dashboard/rack'),'refresh');
			}
		}
	}

	public function show_projects()
	{
		$id_rack = $this->uri->segment(3);
		if (!$id_rack) {
			redirect(base_url('dashboard/rack'),'refresh');
		} else {
			if ($this->customlib->check_id('rack', $id_rack)) {
				$data['no'] = 1;
				$data['projects'] = $this->Project->rack_project($id_rack);
				$data['rack'] = $this->Rack->rack_id($id_rack);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('rack/show_projects');
				$this->load->view('templates/footer');
			} else {
				redirect(base_url('dashboard/rack'),'refresh');
			}
		}
	}

}

/* End of file Rack.php */
/* Location: ./application/controllers/Rack.php */