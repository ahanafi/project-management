<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function send_by_marketing()
	{
		$data['projects'] = $this->Notif->by_marketing();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('notif/by_marketing');
		$this->load->view('templates/footer');
	}

	public function no_design()
	{
		$data['projects'] = $this->Notif->nothing_design();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('notif/no_design');
		$this->load->view('templates/footer');
	}

	public function sent_to_gudang()
	{
		$data['projects'] = $this->Notif->sent_gudang();
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('notif/to_gudang');
		$this->load->view('templates/footer');
	}

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */