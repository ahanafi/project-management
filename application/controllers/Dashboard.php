<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $array_dev = array("Engineering", "PPIC", "Produksi", "QC");

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['racks'] = $this->Rack->rack_all();
		$data['projects'] = $this->Project->project_all();
		$data['by_marketing'] = $this->Project->count_sent(1);
		$data['to_gudang'] = $this->Project->count_sent(2);
		$data['no_design'] = $this->Design->count_none_design();
		$data['no'] = 1;		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}

	public function master()
	{
		$data['racks'] = $this->Rack->rack_all();
		$data['no'] = 1;
		$dev_arr = array("Marketing", "Engineering", "Gudang", "PPIC", "Produksi", "QC");
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$devisi = $this->session->devisi;
		if (in_array($devisi, $dev_arr)) {
			$dev = strtolower($devisi);
			if ($devisi == "Gudang") {
				$data['projects'] = $this->Project->project_full();
			} else {
				$data['projects'] = $this->Project->project_all();
			}
			$this->load->view('master/master_'.$dev, $data);
		} else {
			redirect(base_url('dashboard'),'refresh');
		}

		/*
		// =============== Before revision ============ //

		if ($devisi != "Gudang") {
			if ($devisi == "Marketing") {
				$data['projects'] = $this->Project->project_all();
				$this->load->view('dashboard/master_marketing', $data);
			} else {
				$data['projects'] = $this->Project->project_all();
				$this->load->view('dashboard/master_engineering', $data);
			}
		} else {
			$data['projects'] = $this->Project->project_full();
			$this->load->view('project/jadi', $data);
		}
		*/
		$this->load->view('templates/footer');		
	}

	public function project()
	{
		$devisi = $this->session->devisi;
		$data['racks'] = $this->Rack->rack_all();
		$data['no'] = 1;
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		 
		if ($devisi == "Marketing") {
			$data['projects'] = $this->Project->project_devisi($devisi);
			$this->load->view('dashboard/project_marketing', $data);
		} elseif(in_array($devisi, $this->array_dev)) {
			$data['projects'] = $this->Project->project_devisi($devisi, TRUE);
			$this->load->view('dashboard/project', $data);
		} else {
			$data['projects'] = $this->Project->project_jadi();
			$this->load->view('dashboard/project_gudang', $data);
		}
		$this->load->view('templates/footer');
	}

	public function design()
	{
		$devisi = $this->session->devisi;
		if (in_array($devisi, $this->array_dev)) {
			$data['design'] = $this->Design->design_all();
			$data['no'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('design/index');
			$this->load->view('templates/footer');
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function rack()
	{
		if ($this->session->devisi != "Gudang") {
			redirect(base_url('dashboard'));
		} else {
			$data['racks'] = $this->Rack->rack_all();
			$data['no'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard/rack');
			$this->load->view('templates/footer');
		}
	}

	public function request_material()
	{
		$devisi = $this->session->devisi;
		if (in_array($devisi, $this->array_dev)) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('material/req_material');
			$this->load->view('templates/footer');
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function revise()
	{
		$devisi = $this->session->devisi;
		if (in_array($devisi, $this->array_dev)) {
			$data['projects'] = $this->Project->project_revisi();
			$data['no'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('project/revisi');
			$this->load->view('templates/footer');
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function requests()
	{
		if ($this->session->devisi != "Gudang") {
			redirect(base_url('dashboard'));
		} else {
			$data['materials'] = $this->Material->req_material();
			$data['no'] = 1;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('material/requests');
			$this->load->view('templates/footer');
		}
	}

	public function graphic_sale()
	{
		$devisi = $this->session->devisi;
		if ($devisi != "Marketing") {
			redirect(base_url('dashboard'),'refresh');
		} else {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('chart/graph_sale');
			$this->load->view('templates/footer');
		}
	}

	public function show_chart()
	{
		$devisi = $this->session->devisi;
		if ($devisi != "Marketing") {
			redirect(base_url('dashboard'),'refresh');
		} else {
			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('tanggal_awal', 'Tanggal Awal', 'required');
				$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Awal', 'required');
				$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('templates/header');
					$this->load->view('templates/sidebar');
					$this->load->view('chart/graph_sale');
					$this->load->view('templates/footer');
				} else {
					//Berdasarkan type/spesifikasi project
					$post = $this->input->post();
					$total_no = $this->Project->list_spec()->num_rows();
					$no_project = $this->Project->list_spec()->result();
					
					/* Initialize array variable */
					$numb_array = array();
					$label = array(
						0 => 'Spesifikasi',
						1 => 'Jumlah');
					$result_numb_array = array();
					$result = array($label);

					/* Start input value to array variable */
					for ($i=0; $i < $total_no; $i++) { 
						$numb_array[] = $no_project[$i]->spesifikasi;
						$result_numb_array[] = $this->Project->count_spec(
								$no_project[$i]->spesifikasi,
								$post['tanggal_awal'],
								$post['tanggal_akhir']
							);
						$result[] = [$numb_array[$i], $result_numb_array[$i]];
					}

					/* Convert array variable to json object */

					$data['jumlah'] = array_sum($result_numb_array);
					if ($data['jumlah'] > 0) {
						$data['result'] = json_encode($result);
					} else {
						$data['result'] = json_encode($label);
					}


					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('chart/result_chart');
					$this->load->view('templates/footer');
				}
			} else {
				redirect(base_url('dashboard/graphic_sale'),'refresh');
			}
		}
	}

	public function delete_request()
	{
		$id = $this->uri->segment(3);
		if (empty($id)) {
			redirect(base_url('dashboard/requests'),'refresh');
		} else {
			return $this->Project->delete_request($id);
		}
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */