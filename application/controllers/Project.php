<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	private $array_dev = array("Engineering", "PPIC", "Produksi", "QC");

	public function __construct()
	{
		parent::__construct();
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function index()
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

	public function add()
	{
		if ($this->input->post('submit')) {
			$form_rules = array(
					array('field' => 'no','label'=>'Nomor Project','rules'=>'required'),
					array('field' => 'spesifikasi','label' => 'Spesifikasi','rules'=>'required'),
					array('field' => 'tanggal_terima','label' => 'Tanggal terima','rules'=>'required'),
					array('field' => 'deltime','label' => 'Deltime','rules'=>'required'),
					array('field' => 'qty','label' => 'Quantity','rules'=>'required|integer'),
					array('field' => 'customer','label' => 'Customer','rules'=>'required'),
					array('field' => 'status','label' => 'Status','rules'=>'required')
				);
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$data['modal'] = true;
				$data['racks'] = $this->Rack_model->rack_all();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('dashboard/project');
				$this->load->view('templates/footer');
			} else {
				$post = $this->input->post();
				$data = array(
						'id'			=> NULL,
						'no' 			=> $post['no'],
						'spesifikasi'	=> $post['spesifikasi'],
						'tanggal_terima'=> $post['tanggal_terima'],
						'deltime'		=> $post['deltime'],
						'qty'			=> $post['qty'],
						'customer'		=> $post['customer'],
						'devisi'  		=> $this->session->devisi,
						'status'		=> $post['status']
					);
				if ($this->Project->cek_nomor_project($data['no'])) {
					echo "<script type='text/javascript'>
						alert('Oops! Nomor project telah terpakai, silahkan ganti yang lain!');
						window.location='".base_url('dashboard/project')."';
					</script>";
				} else {
					$this->Project->insert($data);
				}
			}
		} else {
			redirect(base_url('dashboard/project'));
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard'),'refresh');
		} else {
			if ($this->customlib->check_id('project', $id)) {
				$data['racks'] = $this->Rack->rack_all();
				$data['p'] = $this->Project->project_id($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('project/form_update');
				$this->load->view('templates/footer');
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard'),'refresh');
		} else {
			if ($this->customlib->check_id('project', $id)) {
				if ($this->input->post('update')) {
					$form_rules = array(
							array('field' => 'no','label'=>'Nomor Project','rules'=>'required'),
							array('field' => 'spesifikasi','label' => 'Spesifikasi','rules'=>'required'),
							array('field' => 'tanggal_terima','label' => 'Tanggal terima','rules'=>'required'),
							array('field' => 'deltime','label' => 'Deltime','rules'=>'required'),
							array('field' => 'qty','label' => 'Quantity','rules'=>'required|integer'),
							array('field' => 'customer','label' => 'Customer','rules'=>'required'),
							array('field' => 'status','label' => 'Status','rules'=>'required')
						);
					$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
					$this->form_validation->set_rules($form_rules);
					if ($this->form_validation->run() == FALSE) {
						$data['racks'] = $this->Rack->rack_all();
						$data['p'] = $this->Project->project_id($id);
						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('project/form_update');
						$this->load->view('templates/footer');
					} else {
						$post = $this->input->post();
						$data = array(
								'no' 			=> $post['no'],
								'spesifikasi'	=> $post['spesifikasi'],
								'tanggal_terima'=> $post['tanggal_terima'],
								'deltime'		=> $post['deltime'],
								'qty'			=> $post['qty'],
								'customer'		=> $post['customer'],
								'status'		=> $post['status']
							);
						$this->Project->update($id, $data);
					}
				} else {
					redirect(base_url('dashboard'),'refresh');
				}
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		}
	}

	public function delete($id)
	{
		if (!$id) {
			redirect(base_url('dashboard/project'),'refresh');
		} else {
			if ($this->customlib->check_id('project', $id)) {
				$this->Project->delete($id);
			} else {
				redirect(base_url('dashboard/project'),'refresh');
			}
		}
	}

	public function revisi()
	{
		if ($this->session->devisi != "Marketing") {
			redirect(base_url('dashboard/master'),'refresh');
		} else {
			$id = $this->uri->segment(3);
			if (!$id) {
				redirect(base_url('dashboard/master'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					$data['p'] = $this->Project->project_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('project/form_revisi');
					$this->load->view('templates/footer');
				} else {
					redirect(base_url('dashboard/master'),'refresh');
				}
			}
		}
	}

	public function undo_revisi()
	{
		if ($this->session->devisi != "Marketing") {
			redirect(base_url('dashboard/master'),'refresh');
		} else {
			$id = $this->uri->segment(3);
			if (!$id) {
				redirect(base_url('dashboard/master'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					return $this->Project->cancel_revisi($id);
				} else {
					redirect(base_url('dashboard/master'),'refresh');
				}
			}
		}
	}

	public function send()
	{
		$id = $this->uri->segment(3);
		if (!$id) {
			redirect(base_url('dashboard/master'),'refresh');
		} else {
			if ($this->customlib->check_id('project', $id)) {
				$this->Project->send_project($id);
			} else {
				redirect(base_url('dashboard/master'),'refresh');
			}
		}
	}

	public function send_end()
	{
		$devisi = $this->session->devisi;
		if ($devisi == "Marketing" || $devisi == "Gudang") {
			redirect(base_url('dashboard'),'refresh');
		} else {
			$id = $this->uri->segment(3);
			if (!$id) {
				redirect(base_url('dashboard/master'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					if ($this->Design->check_design($id)) {
						echo "<script>
								alert('Silahkan upload design untuk project terlebih dahulu!');
								window.location='".base_url('dashboard/design')."';
							  </script>";
					} else {
						return $this->Project->end($id);
					}
				} else {
					redirect(base_url('dashboard/master'),'refresh');
				}
			}
		}
	}

	public function send_revisi()
	{
		if ($this->input->post('send_revisi')) {
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			if ($this->form_validation->run() == FALSE) {
				$data['p'] = $this->Project->project_id($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('project/form_revisi');
				$this->load->view('templates/footer');
			} else {
				$data = array(
						'id' => NULL,
						'id_project' => $this->input->post('id_project'),
						'keterangan' => $this->input->post('keterangan')
					);
				$this->Project->send_revisi($data['id_project'], $data);
			}
		} else {
			redirect(base_url('dashboard/master'),'refresh');
		}
	}

	public function position()
	{
		if ($this->session->devisi != "Gudang") {
			redirect(base_url('dashboard'),'refresh');
		} else {
			$id = $this->uri->segment(3);
			if (!$id) {
				redirect(base_url('dashboard/project'),'refresh');
			} else {
				if ($this->customlib->check_id('project', $id)) {
					$data['racks'] = $this->Rack->rack_all();
					$data['p'] = $this->Project->project_id($id);
					$this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar');
					$this->load->view('project/position');
					$this->load->view('templates/footer');
				} else {
					redirect(base_url('dashboard/project'),'refresh');
				}
			}
		}
	}

	public function set_position()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('posisi', 'Posisi', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			$id_project = $this->input->post('id_project');
			if ($this->form_validation->run() == FALSE) {
				$data['racks'] = $this->Rack->rack_all();
				$data['p'] = $this->Project->project_id($id_project);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('project/position');
				$this->load->view('templates/footer');
			} else {
				$data = array(
						'id' => NULL,
						'id_project' => $id_project,
						'id_rack' => $this->input->post('posisi')
					);
				$this->Project->set_position($data);
			}
		} else {
			redirect(base_url('dashboard/project'),'refresh');
		}
	}

	public function devisi()
	{
		$arr_dev = array('PPIC', 'Produksi', 'QC');
		$dev = $this->session->devisi;

		/* Checking who is logged in now */
		if (in_array($dev, $arr_dev) || $dev == "Engineering") {
			$dev_uri = $this->uri->segment(3);
			$dev_arr = array();
			foreach ($arr_dev as $ardev) {
				$dev_arr[] = strtolower($ardev);
			}

			/* Checking the data would to show */
			if (in_array($dev_uri, $dev_arr)) {
				$data['project'] = $this->Project->get_devisi($dev_uri);
				$data['no'] = 1;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('p_devisi/list_project');
				$this->load->view('templates/footer');
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function dev_insert()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('no', 'No. Project', 'required');
			$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'required');
			$this->form_validation->set_rules('tanggal_terima', 'Tanggal terima', 'required');
			$this->form_validation->set_rules('deltime', 'Deltime', 'required');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

			if ($this->form_validation->run() === FALSE) {
				$data['modal'] = TRUE;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('p_devisi/list_project');
				$this->load->view('templates/footer');
			} else {
				$post = $this->input->post();
				$dev  = strtolower($this->session->devisi);
				$data = array(
						'id'			=> NULL,
						'no'			=> $post['no'],
						'spesifikasi'	=> $post['spesifikasi'],
						'tanggal_terima'=> $post['tanggal_terima'],
						'deltime'		=> $post['deltime'],
						'keterangan'	=> $post['keterangan']
					);
				return $this->Project->devisi_insert($data, $dev);
			}

		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function dev_edit()
	{
		$arr_dev = array('PPIC', 'Produksi', 'QC');
		$dev = $this->session->devisi;

		/* Checking session of user */
		if (in_array($dev, $arr_dev)) {
			$dev_arr = array();
			foreach ($arr_dev as $adev) {
				$dev_arr[] = strtolower($adev);
			}

			$dev_uri = $this->uri->segment(3);
			$dev_id  = $this->uri->segment(4);
			/*  Checking uri segment */
			if (in_array($dev_uri, $dev_arr)) {
				if (!empty(trim($dev_id))) {
					if ($this->customlib->check_id('project_'.$dev_uri, $dev_id)) {

						$data['p'] = $this->Project->get_dev_id($dev_uri, $dev_id);
						$this->load->view('templates/header', $data);
						$this->load->view('templates/sidebar');
						$this->load->view('p_devisi/edit_project');
						$this->load->view('templates/footer');
					} else {
						redirect(base_url('project/devisi'),'refresh');
					}
				} else {
					redirect(base_url('project/devisi'),'refresh');
				}
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function dev_update()
	{
		if ($this->input->post()) {
			$arr_dev = array('PPIC', 'Produksi', 'QC');
			$dev = $this->session->devisi;

			/* Checking session of user */
			if (in_array($dev, $arr_dev)) {
				$dev_arr = array();
				foreach ($arr_dev as $adev) {
					$dev_arr[] = strtolower($adev);
				}

				$dev_uri = $this->uri->segment(3);
				$dev_id  = $this->uri->segment(4);
				/*  Checking uri segment */
				if (in_array($dev_uri, $dev_arr)) {
					if (!empty(trim($dev_id))) {
						if ($this->customlib->check_id('project_'.$dev_uri, $dev_id)) {
							$this->form_validation->set_rules('no', 'No. Project', 'required');
							$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'required');
							$this->form_validation->set_rules('tanggal_terima', 'Tanggal terima', 'required');
							$this->form_validation->set_rules('deltime', 'Deltime', 'required');
							$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

							if ($this->form_validation->run() === FALSE) {
								$data['p'] = $this->Project->get_dev_id($dev_uri, $dev_id);
								$this->load->view('templates/header', $data);
								$this->load->view('templates/sidebar');
								$this->load->view('p_devisi/edit_project');
								$this->load->view('templates/footer');
							} else {
								$post = $this->input->post();
								$dev  = strtolower($this->session->devisi);
								$data = array(
										'no'			=> $post['no'],
										'spesifikasi'	=> $post['spesifikasi'],
										'tanggal_terima'=> $post['tanggal_terima'],
										'deltime'		=> $post['deltime'],
										'keterangan'	=> $post['keterangan']
									);
								return $this->Project->devisi_update($data, $dev, $dev_id);
							}
						} else {
							redirect(base_url('project/devisi'),'refresh');
						}
					} else {
						redirect(base_url('project/devisi'),'refresh');
					}
				} else {
					redirect(base_url('dashboard'),'refresh');
				}
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		} else {
			redirect(base_url('project/devisi'),'refresh');
		}
	}

	public function dev_delete()
	{
	$arr_dev = array('PPIC', 'Produksi', 'QC');
		$dev = $this->session->devisi;

		/* Checking session of user */
		if (in_array($dev, $arr_dev)) {
			$dev_arr = array();
			foreach ($arr_dev as $adev) {
				$dev_arr[] = strtolower($adev);
			}

			$dev_uri = $this->uri->segment(3);
			$dev_id  = $this->uri->segment(4);
			/*  Checking uri segment */
			if (in_array($dev_uri, $dev_arr)) {
				if (!empty(trim($dev_id))) {
					if ($this->customlib->check_id('project_'.$dev_uri, $dev_id)) {
						return $this->Project->devisi_delete($dev_uri, $dev_id);
					} else {
						redirect(base_url('project/devisi'),'refresh');
					}
				} else {
					redirect(base_url('project/devisi'),'refresh');
				}
			} else {
				redirect(base_url('dashboard'),'refresh');
			}
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}




	public function export_pdf($page)
	{
		$this->load->library(array('pdflib', 'excellib'));
		$data['no'] = 1;
		
		if ($page == "master") {
			$data[$page] = $this->Project->project_all();
			$data['title'] = "MASTER DATA";
			$html = $this->load->view('export/master_pdf', $data, true);
			$this->pdflib->generate($html, "Report-Data-Master-".date('Ymd'));
			//$this->load->view('export/master_pdf', $data);
		} else if ($page == "project") {
			$data['title'] = "DATA PROJECT";
			$html = $this->load->view('export/project_pdf', $data, true);
			$this->pdflib->generate($html, "Report-Data-Project-".date('Ymd'));
		}
	}

	public function export_excel($page)
	{
		$filename = "DATA ".strtoupper($page);
		$this->load->library(array('pdflib', 'excellib'));
		$objPHPExcel = new PHPExcel();
		$activeSheet = $objPHPExcel->getActiveSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		//Formating MergeCells
		$activeSheet->mergeCells('A1:H2');
		$activeSheet->mergeCells('A3:B3');
		$activeSheet->mergeCells('G3:H3');

		//Style center
		$centerAlign = array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			);

		$activeSheet->getStyle('A1')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A3')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('G3')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A4:H4')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('D:H')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A')->getAlignment()->applyFromArray($centerAlign);

		//Color bg and text
		$activeSheet->getStyle('A4:H4')
					->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('0000AEEF');
		
		$activeSheet->getStyle('A4:H4')
					->getFont()
					->getColor()
					->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		//Height and Width
		/* Height */
		$activeSheet->getRowDimension('3')->setRowHeight(30);
		$activeSheet->getRowDimension('4')->setRowHeight(30);
		
		/* Width */
		$activeSheet->getColumnDimension('A')->setWidth(5);
		$activeSheet->getColumnDimension('B')->setWidth(16.5);
		$activeSheet->getColumnDimension('C')->setAutoSize(true);
		$activeSheet->getColumnDimension('D')->setWidth(13);
		$activeSheet->getColumnDimension('E')->setWidth(13);
		$activeSheet->getColumnDimension('G')->setWidth(15);
		$activeSheet->getColumnDimension('H')->setWidth(10);

		//Style Font
		$activeSheet->getStyle('A1')->getFont()->setSize(14);
		$activeSheet->getStyle('A1:A3')->getFont()->setBold(true);
		$activeSheet->getStyle('A4:H4')->getFont()->setBold(true);
		$activeSheet->getStyle('G3')->getFont()->setItalic(true);
		$activeSheet->getStyle('G3')->getAlignment()->setWrapText(true);

		//Value of cell
		$uname = $this->session->username;
		$devisi = $this->session->devisi;
		$date = "Export on : ".date('Y-m-d H:i:s')." by ".ucwords($uname)." (".$devisi.")";
		$activeSheet->setCellValue('A1', "PROJECT MANAGEMENT APP");
		$activeSheet->setCellValue('A3', $filename);
		$activeSheet->setCellValue('G3', $date);

		//Value table
		$activeSheet->setCellValue('A4', "NO.");
		$activeSheet->setCellValue('B4', "No. Project");
		$activeSheet->setCellValue('C4', "Spesifikasi");
		$activeSheet->setCellValue('D4', "Tanggal terima");
		$activeSheet->setCellValue('E4', "Deltime");
		$activeSheet->setCellValue('F4', "QTY");
		$activeSheet->setCellValue('G4', "Customer");
		$activeSheet->setCellValue('H4', "Status");

		//Count Total daata
		$total_count = $this->Project->count_all();
		$data = $this->Project->project_all();
		$total_row = 5+$total_count;
		$no = 1;
		$prevData = 0;
		
		/* Start Looping data from database! */
		$i = 5;
		for ($j=0; $j < $total_count; $j++) { 
			//if($prevData != $data[$j]->id) {
			$activeSheet->setCellValue('A'.$i, $no++);
			$activeSheet->setCellValue('B'.$i, $data[$j]->no);
			$activeSheet->setCellValue('C'.$i, $data[$j]->spesifikasi);
			$activeSheet->setCellValue('D'.$i, $data[$j]->tanggal_terima);
			$activeSheet->setCellValue('E'.$i, $data[$j]->deltime);
			$activeSheet->setCellValue('F'.$i, $data[$j]->qty);
			$activeSheet->setCellValue('G'.$i, $data[$j]->customer);
			$activeSheet->setCellValue('H'.$i, $data[$j]->status);
			$prevData = $data[$j]->id;
			//}
			$i++;
		}

		$activeSheet->getPageSetup()
					->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$activeSheet->getPageSetup()
					->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		/* Border Style */
		$arrayStyle = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'top' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'bottom' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'left' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'right' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'vertical' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'horizontal' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
				'allborders' =>  array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				),
			)
		);

		$i = $i-1;
		$activeSheet->getStyle('A4:H'.$i)->applyFromArray($arrayStyle);

		/*//*/
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header("Content-Disposition: attachment;filename='".$filename.".xlsx");
        //unduh file
        $objWriter->save("php://output");
        //*/
	}

	public function detail($id)
	{
		$data['p'] = $this->Project->project_id($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('project/detail_project');
		$this->load->view('templates/footer');
	}
}

/* End of file Project.php */
/* Location: ./application/controllers/Project.php */