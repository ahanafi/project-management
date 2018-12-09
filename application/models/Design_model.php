<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design_model extends CI_Model {


	public function all_design()
	{
		return $this->db->get_where('project')->result();
	}

	public function design_all()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('terkirim !=', '0');
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}		
	}

	public function get_design()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('design !=', 'none');
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function design_id($id)
	{
		$sql = $this->db->get_where('project', array('id' => $id));
		if ($sql->num_rows() > 0) {
			return $sql->row();
		} else {
			return false;
		}
	}
		
	public function check_design($id_project)
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('design', 'none');
		$this->db->where('id', $id_project);
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) { //Ada datanya!
			return true;
		} else {
			return false;
		}
	}

	public function count_none_design()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('design', 'none');
		$this->db->where('terkirim', 1);
		$sql = $this->db->get();
		return $sql->num_rows();
	}

	public function count_design()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('design !=', 'none');
		$sql = $this->db->get();
		return $sql->num_rows();
	}


}

/* End of file Design_model.php */
/* Location: ./application/models/Design_model.php */