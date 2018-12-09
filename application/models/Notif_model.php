<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif_model extends CI_Model {

	public function by_marketing()
	{
		$sql = $this->db->get_where('project', array('terkirim' => 1));
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function nothing_design()
	{
		$sql = $this->db->get_where('project', array('design' => 'none', 'terkirim' => 1));
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function sent_gudang()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('terkirim', 2);
		$this->db->where('design !=', 'none');
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}
	

}

/* End of file Notif_model.php */
/* Location: ./application/models/Notif_model.php */