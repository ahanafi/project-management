<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rack_model extends CI_Model {

	public function rack_all()
	{
		return $this->db->get('rack')->result();
	}

	public function rack_id($id)
	{
		$sql = $this->db->get_where('rack', array('id' => $id));
		if ($sql->num_rows() > 0) {
			return $sql->row();
		} else {
			return false;
		}
	}
	
	public function insert($data)
	{
		if ($this->db->insert('rack', $data)) {
			echo "<script>
				alert('Yosh! Data rak berhasil disimpan!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		} else {
			echo "<script>
				alert('Oops! Data rak gagal disimpan!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		}
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('rack', $data)){
			echo "<script>
				alert('Yosh! Data rak berhasil disimpan!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		} else {
			echo "<script>
				alert('Oops! Data rak gagal disimpan!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		}
	}

	public function delete($id)
	{
		if ($this->db->delete('rack', array('id' => $id))) {
			echo "<script>
				alert('Yosh! Data rack berhasil dihapus!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		} else {
			echo "<script>
				alert('Oops! Data rack gagal dihapus!');
				window.location='".base_url('dashboard/rack')."';
			</script>";
		}
	}
}

/* End of file Rack_model.php */
/* Location: ./application/models/Rack_model.php */