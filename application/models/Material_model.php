<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {

	public function insert_req($data)
	{
		if($this->db->insert('pesan_material', $data)){
			echo "<script>
					alert('Yosh! Data permintaaan material telah terkirim!');
					window.location='".base_url('dashboard')."';
				  </script>";
		} else {
			echo "<script>
					alert('Oops!! Data permintaaan material gagal terkirim!');
					window.location='".base_url('material/send_request')."';
				  </script>";
		}
	}

	public function delete($id, $dev)
	{
		if ($this->db->delete('material_'.$dev, array('id' => $id))) {
			echo "<script>
					alert('Yosh! Data material berhasil dihapus!');
					window.location='".base_url('material')."';
				</script>";
		} else {
			echo "<script>
					alert('Oops! Data material gagal dihapus!');
					window.location='".base_url('material')."';
				</script>";
		}
	}
	
	public function all_material()
	{
		return $this->db->get('material')->result();
	}

	public function get_all($dev)
	{
		return $this->db->get('material_'.$dev)->result();
	}

	public function material_id($id, $dev)
	{
		return $this->db->get_where('material_'.$dev, array('id' => $id))->row();
	}
 
	public function insert($data, $dev)
	{
		if($this->db->insert('material_'.$dev, $data)){
			echo "<script>
					alert('Yosh! Data material berhasil disimpan!');
					window.location='".base_url('material')."';
				  </script>";
		} else {
			echo "<script>
					alert('Oops!! Data material gagal disimpan!');
					window.location='".base_url('material')."';
				  </script>";
		}
	}

	public function update($data, $id, $dev)
	{
		$this->db->where('id', $id);
		if ($this->db->update('material_'.$dev, $data)) {
			echo "<script>
					alert('Yosh! Data material berhasil disimpan!');
					window.location='".base_url('material')."';
				</script>";
		} else {
			echo "<script>
					alert('Oops! Data material gagal disimpan!');
					window.location='".base_url('material')."';
				</script>";
		}
	}

	public function req_material()
	{
		return $this->db->get('pesan_material')->result();
	}

	public function material_dev($devisi)
	{
		$this->db->select('*');
		$this->db->from('material_'.$devisi);
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

}

/* End of file Material_model.php */
/* Location: ./application/models/Material_model.php */