<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdflib
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function generate($html, $filename)
	{
		define('DOMPDF_ENABLE_AUTOLOAD', false);
		require_once("./vendor/dompdf/dompdf/autoload.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->setPaper('A4', 'Landscape');
	    $dompdf->load_html($html);
	    $dompdf->render();
	    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
	}

	

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
