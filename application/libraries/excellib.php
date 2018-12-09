<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Load library phpexcel
require_once(APPPATH."/third_party/PHPExcel.php");

class Excellib extends PHPExcel
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	

}

/* End of file Excel.php */
/* Location: ./application/libraries/Excel.php */
