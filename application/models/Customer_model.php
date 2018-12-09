<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function all_customer()
	{
		return $this->db->get('customer')->result();
	}

	public function customer_id($id)
	{
		return $this->db->get_where('customer', array('id' => $id))->row();
	}

	public function insert($data)
	{
		if ($this->db->insert('customer', $data)) {
			echo "<script>
					alert('Yosh! Data customer berhasil disimpan!');
					window.location='".base_url('customer')."';
				</script>";
		} else {
			echo "<script>
					alert('Oops! Data customer gagal disimpan!');
					window.location='".base_url('customer')."';
				</script>";
		}
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update('customer', $data)) {
			echo "<script>
					alert('Yosh! Data customer berhasil disimpan!');
					window.location='".base_url('customer')."';
				</script>";
		} else {
			echo "<script>
					alert('Oops! Data customer gagal disimpan!');
					window.location='".base_url('customer')."';
				</script>";
		}
	}
	
	public function delete($id)
	{
		if ($this->db->delete('customer', array('id' => $id))) {
			echo "<script>
					alert('Yosh! Data customer berhasil dihapus!');
					window.location='".base_url('customer')."';
				</script>";
		} else {
			echo "<script>
					alert('Oops! Data customer gagal dihapus!');
					window.location='".base_url('customer')."';
				</script>";
		}
	}

}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */