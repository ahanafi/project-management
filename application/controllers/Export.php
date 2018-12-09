<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	private $array_dev = array("Engineering", "PPIC", "Produksi", "QC");

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('pdflib', 'excellib'));
		if (!$this->customlib->is_login('logged_in')) {
			redirect(base_url('auth'),'refresh');
		}
	}

	public function index()
	{
		redirect(base_url('dashboard'),'refresh');
	}

	public function export_pdf($page)
	{
		$data['no'] = 1;
		$devisi = $this->session->devisi;
		if ($page == "master") {
			$data[$page] = $this->Project->project_all();
			$data['title'] = "DATA MASTER";
			$html = $this->load->view('export/master_pdf', $data, true);
			$this->pdflib->generate($html, "Report-Data-Master-".date('Ymd'));
			//$this->load->view('export/master_pdf', $data);
		} else if ($page == "project") {
			$data['title'] = "DATA PROJECT";
			//$data[$page] = $this->Project->project_devisi($devisi);
			$data[$page] = $this->Project->project_all();
			$html = $this->load->view('export/project_pdf', $data, true);
			//$this->load->view('export/project_pdf', $data);
			$this->pdflib->generate($html, "Report-Data-Project-".date('Ymd'));
		}
	}

	public function design_pdf()
	{
		$devisi = $this->session->devisi;
		if (in_array($devisi, $this->array_dev)) {
			$data['no'] =1;
			$data['title'] = "DATA PROJECT";
			$data['design'] = $this->Design->get_design();
			$html = $this->load->view('export/project_design', $data, TRUE);
			//$this->load->view('export/project_design', $data);
			$this->pdflib->generate($html, "Report-Data-Master-".date('Ymd'));
		} else {
			redirect(base_url('dashboard'),'refresh');
		}
	}

	public function barang_jadi_pdf()
	{
		$devisi = $this->session->devisi;
		if ($devisi != "Gudang") {
			redirect(base_url('dashboard'),'refresh');
		} else {
			$data['no'] = 1;
			$data['title'] = "DATA BARANG JADI";
			$data['pro'] = $this->Project->project_full();
			//$this->load->view('export/barang_jadi', $data, FALSE);
			$html = $this->load->view('export/barang_jadi', $data, TRUE);
			$this->pdflib->generate($html, "Data-Barang-Jadi-".date('Ymd'));
		}
	}

	public function barang_jadi_excel()
	{
		$filename = "DATA BARANG JADI";
		$objPHPExcel = new PHPExcel();
		$activeSheet = $objPHPExcel->getActiveSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		//Formating MergeCells
		$activeSheet->mergeCells('A1:I2');
		$activeSheet->mergeCells('A3:B3');
		$activeSheet->mergeCells('G3:I3');

		//Style center
		$centerAlign = array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			);

		$activeSheet->getStyle('A1')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A3')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('G3')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A4:H4')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('D:I')->getAlignment()->applyFromArray($centerAlign);
		$activeSheet->getStyle('A')->getAlignment()->applyFromArray($centerAlign);

		//Color bg and text
		$activeSheet->getStyle('A4:I4')
					->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('0000AEEF');
		
		$activeSheet->getStyle('A4:I4')
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
		$activeSheet->getColumnDimension('D')->setWidth(15);
		$activeSheet->getColumnDimension('E')->setWidth(15);
		$activeSheet->getColumnDimension('G')->setWidth(15);
		$activeSheet->getColumnDimension('H')->setWidth(15);

		//Style Font
		$activeSheet->getStyle('A1')->getFont()->setSize(14);
		$activeSheet->getStyle('A1:A3')->getFont()->setBold(true);
		$activeSheet->getStyle('A4:I4')->getFont()->setBold(true);
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
		$activeSheet->setCellValue('I4', "Posisi");

		//Count Total daata
		$total_count = $this->Project->count_full();
		$data = $this->Project->project_full();
		$total_row = 5+$total_count;
		$no = 1;

		/* Start Looping data from database! */
		$i = 5;
		for ($j=0; $j < $total_count; $j++) { 
			$activeSheet->setCellValue('A'.$i, $no++);
			$activeSheet->setCellValue('B'.$i, $data[$j]->no);
			$activeSheet->setCellValue('C'.$i, $data[$j]->spesifikasi);
			$activeSheet->setCellValue('D'.$i, $data[$j]->tanggal_terima);
			$activeSheet->setCellValue('E'.$i, $data[$j]->deltime);
			$activeSheet->setCellValue('F'.$i, $data[$j]->qty);
			$activeSheet->setCellValue('G'.$i, $data[$j]->customer);
			$activeSheet->setCellValue('H'.$i, $data[$j]->status);
			$activeSheet->setCellValue('I'.$i, $data[$j]->nama_rak);
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
		$activeSheet->getStyle('A4:I'.$i)->applyFromArray($arrayStyle);

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

	public function design_excel()
	{
		$filename = "DATA DESIGN";
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
		$activeSheet->getStyle('A:I')->getAlignment()->applyFromArray($centerAlign);
		//$activeSheet->getStyle('A')->getAlignment()->applyFromArray($centerAlign);

		//Color bg and text
		$activeSheet->getStyle('A4:I4')
					->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('0000AEEF');
		
		$activeSheet->getStyle('A4:I4')
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
		$activeSheet->getColumnDimension('I')->setWidth(15);

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
		$activeSheet->setCellValue('I4', "Gambar");

		//Count Total daata
		$total_count = $this->Design->count_design();
		$data = $this->Design->get_design();
		$total_row = 5+$total_count;
		$no = 1;

		/* Start Looping data from database! */
		$i = 5;
		for ($j=0; $j < $total_count; $j++) { 
			
			$activeSheet->getRowDimension($i)->setRowHeight(79.5);

			$activeSheet->setCellValue('A'.$i, $no++);
			$activeSheet->setCellValue('B'.$i, $data[$j]->no);
			$activeSheet->setCellValue('C'.$i, $data[$j]->spesifikasi);
			$activeSheet->setCellValue('D'.$i, id_date($data[$j]->tanggal_terima));
			$activeSheet->setCellValue('E'.$i, id_date($data[$j]->deltime));
			$activeSheet->setCellValue('F'.$i, $data[$j]->qty);
			$activeSheet->setCellValue('G'.$i, $data[$j]->customer);
			$activeSheet->setCellValue('H'.$i, $data[$j]->status);
			
			//Image Handler
			$imageHanlder = new PHPExcel_Worksheet_Drawing();
			$imageHanlder->setWorksheet($activeSheet);
			$imageFile = "././images/project_images/";
			if ($data[$j]->design == "none") {
				$imageFile .= "no_pict.png";
			} else {
				$imageFile .= $data[$j]->design;
			}
			$imageHanlder->setPath($imageFile);
			$imageHanlder->setHeight(95);
			$imageHanlder->setCoordinates('I'.$i);
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
		$activeSheet->getStyle('A4:I'.$i)->applyFromArray($arrayStyle);

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

	public function export_excel($page)
	{
		$filename = "DATA ".strtoupper($page);
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
		$activeSheet->getColumnDimension('D')->setWidth(15);
		$activeSheet->getColumnDimension('E')->setWidth(15);
		$activeSheet->getColumnDimension('G')->setWidth(15);
		$activeSheet->getColumnDimension('H')->setWidth(15);

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

}

/* End of file Export.php */
/* Location: ./application/controllers/Export.php */