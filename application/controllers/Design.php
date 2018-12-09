<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {

	private $array_dev = array("Engineering", "PPIC", "Produksi", "QC", "Marketing");

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		//$data['design'] = $this->Design->get_design();
		$data['design'] = $this->Design->design_all();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		if($this->session->devisi != "Marketing") {
			$this->load->view('design/design_produksi');
		} else {
			$this->load->view('design/index');
		}
		$this->load->view('templates/footer');
	}

	public function upload()
	{
		$devisi = $this->session->devisi;
		$id = $this->uri->segment(3);
		if (in_array($devisi, $this->array_dev)) {
			if (!$id) {
				redirect(base_url('design'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					$data['p'] = $this->Project->project_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('design/form_upload');
					$this->load->view('templates/footer');
				} else {
					redirect(base_url('design'),'refresh');
				}
			}
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function upload_proccess($id)
	{
		if (!$id) {
			redirect(base_url('dashboard/design'),'refresh');
		} else {
			$check_id = $this->customlib->check_id('project', $id);
			if ($check_id) {
				$uid = $this->customlib->generateUid();
				$date = date('Ymd');
				$extFile = explode("/", $_FILES['userfile']['type']);
				$ext = $extFile[1];
				
				$config['upload_path'] = './images/project_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '100';
				$config['file_name'] = $uid."-".$date.".".$ext;
				
				$this->load->library('upload');
				$this->upload->initialize($config);
							
				if ( ! $this->upload->do_upload('userfile')){
					echo $this->upload->display_errors();
				} else {
					$upload_data = $this->upload->data();
					$data = array('design' => $config['file_name']);
					$this->Project->insert_design($id, $data);
				}
			}
		}
	}

	public function change_image()
	{
		$devisi = $this->session->devisi;
		$id = $this->uri->segment(3);
		if (in_array($devisi, $this->array_dev)) {
			if (!$id) {
				redirect(base_url('design'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					$data['p'] = $this->Project->project_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('design/form_change_image');
					$this->load->view('templates/footer');
				} else {
					redirect(base_url('design'),'refresh');
				}
			}
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function change_proccess($id)
	{
		if (!$id) {
			redirect(base_url('dashboard/design'),'refresh');
		} else {
			$check_id = $this->customlib->check_id('project', $id);
			if ($check_id) {
				$uid = $this->customlib->generateUid();
				$date = date('Ymd');
				$extFile = explode("/", $_FILES['userfile']['type']);
				$ext = $extFile[1];
				
				$config['upload_path'] = './images/project_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '100';
				$config['file_name'] = $uid."-".$date.".".$ext;
				
				$this->load->library('upload');
				$this->upload->initialize($config);
							
				if ( ! $this->upload->do_upload('userfile')){
					echo $this->upload->display_errors();
				} else {
					$upload_data = $this->upload->data();
					$data = array('design' => $config['file_name']);
					$this->Project->insert_design($id, $data);
				}
			}
		}
	}

}

/* End of file Design.php */
/* Location: ./application/controllers/Design.php */