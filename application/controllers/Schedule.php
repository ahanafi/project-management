<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	private $arr_dev = array("PPIC", "QC", "Produksi");

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'));
		}
		$dev = $this->session->devisi;
		if (!in_array($dev, $this->arr_dev)) {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function index()
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$form_rules = array(
					array(
							'field' => 'no',
							'label' => 'No. Project',
							'rules' => 'required'
						),
					array(
							'field' => 'spesifikasi',
							'label' => 'Spesifikasi',
							'rules' => 'required'
						),
					array(
							'field' => 'tanggal_mulai',
							'label' => 'Tanggal mulai',
							'rules' => 'required'
						),
					array(
							'field' => 'tanggal_selesai',
							'label' => 'Tanggal selesai',
							'rules' => 'required'
						),
					array(
							'field' => 'deltime',
							'label' => 'Deltime',
							'rules' => 'required'
						),
				);
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$data['schedule'] = $this->Schedule->get_schedules();
				$data['no'] = 1;
				$data['modal'] = TRUE;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('schedule/list_schedule');
				$this->load->view('templates/footer');
			} else {
				$data = array(
						'id'	=> NULL,
						'no'	=> $post['no'],
						'spesifikasi'	=> $post['spesifikasi'],
						'tanggal_mulai'	=> $post['tanggal_mulai'],
						'tanggal_selesai'	=> $post['tanggal_selesai'],
						'deltime'	=> $post['deltime']
					);
				return $this->Schedule->insert($data);
			}
		} else {
			$data['schedule'] = $this->Schedule->get_schedules();
			$data['no'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('schedule/list_schedule');
			$this->load->view('templates/footer');
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!empty(trim($id))) {
			if ($this->customlib->check_id('schedule', $id)) {
				if ($this->input->post()) {
					$form_rules = array(
							array(
									'field' => 'no',
									'label' => 'No. Project',
									'rules' => 'required'
								),
							array(
									'field' => 'spesifikasi',
									'label' => 'Spesifikasi',
									'rules' => 'required'
								),
							array(
									'field' => 'tanggal_mulai',
									'label' => 'Tanggal mulai',
									'rules' => 'required'
								),
							array(
									'field' => 'tanggal_selesai',
									'label' => 'Tanggal selesai',
									'rules' => 'required'
								),
							array(
									'field' => 'deltime',
									'label' => 'Deltime',
									'rules' => 'required'
								),
						);
					$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
					$this->form_validation->set_rules($form_rules);
					if ($this->form_validation->run() == FALSE) {
						$data['sc'] = $this->Schedule->schedule_id($id);
						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('schedule/edit_schedule');
						$this->load->view('templates/footer');						
					} else {
						$post = $this->input->post();
						$data = array(
								'no'				=> $post['no'],
								'spesifikasi'		=> $post['spesifikasi'],
								'tanggal_mulai'		=> $post['tanggal_mulai'],
								'tanggal_selesai'	=> $post['tanggal_selesai'],
								'deltime'			=> $post['deltime']
							);
						return $this->Schedule->update($data, $id);
					}
				} else {
					$data['sc'] = $this->Schedule->schedule_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('schedule/edit_schedule');
					$this->load->view('templates/footer');
				}
			} else {
				redirect(base_url('schedule'),'refresh');
			}
		} else {
			redirect(base_url('schedule'),'refresh');
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		if (!empty(trim($id))) {
			if ($this->customlib->check_id('schedule', $id)) {
				return $this->Schedule->delete($id);
			} else {
				redirect(base_url('schedule'),'refresh');
			}
		} else {
			redirect(base_url('schedule'),'refresh');
		}
	}

}

/* End of file Schedule.php */
/* Location: ./application/controllers/Schedule.php */