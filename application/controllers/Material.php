<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	private $array_dev = array("Marketing", "Engineering", "Gudang", "PPIC", "Produksi", "QC");

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function index()
	{
		$marketing = $this->Material->get_all("marketing");
		$engineering = $this->Material->get_all("engineering");
		$gudang = $this->Material->get_all("gudang");
		$ppic = $this->Material->get_all("ppic");
		$qc = $this->Material->get_all("qc");
		$produksi = $this->Material->get_all("produksi");

		$material = $marketing;
		$material = array_merge($material, $engineering, $gudang, $ppic, $qc, $produksi);
		$data['material'] = $material;
		$data['no'] = 1;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('material/list_material');
		$this->load->view('templates/footer');
	}

	public function add()
	{
		if ($this->input->post()) {
			$devisi = $this->session->devisi;
			$this->form_validation->set_rules('nama', 'Nama material', 'required');
			$this->form_validation->set_rules('spesifikasi', 'Spesifikasi material', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
			if ($this->form_validation->run() == FALSE) {
				$data['modal'] = true;
				$data['material'] = $this->Material->all_material();
				$data['no']=1;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('material/list_material');
				$this->load->view('templates/footer');		
			} else {
				$data = array(
						'id' => NULL,
						'nama' => $this->input->post('nama'),
						'spesifikasi' => $this->input->post('spesifikasi'),
						'devisi' => $devisi
					);
				$dev = strtolower($devisi);
				return $this->Material->insert($data, $dev);
			}
		} else {
			redirect(base_url('material'));
		}
	}

	public function edit()
	{
		$devisi = $this->uri->segment(3);
		$id 	= $this->uri->segment(4);
		$dev_ses= strtolower($this->session->devisi);
		$id     = intval($id);
		if (!$devisi || !$id) {
			redirect(base_url('material'));
		} else {
			$array_dev = array();
			foreach ($this->array_dev as $dev) {
				$array_dev[] = strtolower($dev);
			}
			if (in_array($devisi, $array_dev)) {
				if ($devisi == $dev_ses) {
					if ($this->customlib->check_id('material_'.$dev, $id)) {
						$data['mat'] = $this->Material->material_id($id, $devisi);

						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('material/edit_material');
						$this->load->view('templates/footer');
					} else {
						redirect(base_url('material'),'refresh');
					}
				} else {
					redirect(base_url('material'),'refresh');
				}
			} else {
				redirect(base_url('material'));
			}
		}
	}

	public function update($id)
	{
		if (!$id) {
			redirect(base_url('material'));
		} else {
			$dev = $this->input->post('devisi');
			if (in_array($dev, $this->array_dev)) {

				if ($this->customlib->check_id('material_'.$dev, $id)) {
					$this->form_validation->set_rules('nama', 'Nama Material', 'required');
					$this->form_validation->set_rules('spesifikasi', 'Spesifikasi material', 'required');
					$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

					if ($this->form_validation->run() == FALSE) {
						$data['mat'] = $this->Material->material_id($id);
						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('material/edit_material');
						$this->load->view('templates/footer');
					} else {
						$data = array(
								'nama'	=> $this->input->post('nama'),
								'spesifikasi'=> $this->input->post('spesifikasi')
							);					
						
						return $this->Material->update($data, $id, $dev);
					}
				} else {
					redirect(base_url('material'));	
				}
			}else {
				echo "<script>
						alert('Oops! Devisi material tidak dikenal! Gagal update!');
						window.location='".base_url('material')."';
					</script>";
			}
		}
	}

	public function send_request()
	{
		$this->form_validation->set_rules('nama', 'Nama Material', 'required');
		$this->form_validation->set_rules('type', 'Tipe Material', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan material', 'required');
		$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard/req_material');
			$this->load->view('templates/footer');
		} else {
			$data = array(
					'id'			=> NULL,
					'nama_material' => $this->input->post('nama'),
					'type'			=> $this->input->post('type'),
					'keterangan'	=> $this->input->post('keterangan')
				);
			$this->Material->insert_req($data);
		}
	}

	public function delete($dev, $id)
	{
		if (!$id || !$dev) {
			redirect(base_url('material'));
		} else {
			if ($this->customlib->check_id('material_'.$dev, $id)) {
				return $this->Material->delete($id, $dev);
			} else {
				redirect(base_url('material'));
			}
		}
	}

	public function devisi()
	{
		$devisi = $this->uri->segment(3);
		if (!$devisi) {
			redirect(base_url('material'),'refresh');
		} else {
			$devisi = strtolower($devisi);
			foreach ($this->array_dev as $dev) {
				$arr_dev[] = strtolower($dev);
			}
			if (in_array($devisi, $arr_dev)) {
				$data['materials'] = $this->Material->material_dev($devisi);
				$data['no'] = 1;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('material/list_dev_material');
				$this->load->view('templates/footer');
			} else {
				$data['code'] = 404;
				$data['text'] = "Maaf, Halaman tidak dapat ditemukan!";
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('templates/footer');
				$this->load->view('errors/404');
			}
		}
	}

}

/* End of file Material.php */
/* Location: ./application/controllers/Material.php */