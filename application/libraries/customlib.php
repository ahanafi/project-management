<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customlib
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function is_login($name)
	{
		if ($this->ci->session->has_userdata($name)) {
			return true;
		} else {
			return false;
		}
	}

	public function check_id($table, $id)
	{
		if ($this->ci->db->get_where($table, array('id' => $id))->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function generateUid()
	{
		$randStr = md5(uniqid(rand(), true));
		$str = substr($randStr, 0,6);
		return $str;
	}

	public function cek_project_jadi($id)
	{
		$sql = $this->db->get_where('jadi', array('id_project' => $id));
		if ($sql->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function id_date($date)
	{
		$tanggal = str_replace("-", "/", $date);
		die($tanggal);
	}
	

}

/* End of file customlib.php */
/* Location: ./application/libraries/customlib.php */
