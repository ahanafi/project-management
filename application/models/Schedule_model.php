<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	protected $table = "schedule";

	public function get_schedules()
	{
		return $this->db->get($this->table)->result();
	}

	public function insert($data)
	{
		if ($this->db->insert($this->table, $data)) {
			echo "
				<script>
					alert('Yosh! Berhasil menambahkan data baru!');
					window.location='".base_url($this->table)."'
				</script>";
		} else {
			echo "
				<script>
					alert('Oops! Gagal menambahkan data!');
					window.location='".base_url($this->table)."'
				</script>";
		}
	}

	public function schedule_id($id)
	{
		$sql = $this->db->get_where('schedule', array('id' => $id));
		if ($sql->num_rows() > 0) {
			return $sql->row();
		}
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update('schedule', $data)) {
			echo "
				<script>
					alert('Yosh! Data berhasil diperbarui!');
					window.location='".base_url($this->table)."'
				</script>";
		} else {
			echo "
				<script>
					alert('Oops! Data gagal diperbarui!');
					window.location='".base_url($this->table)."'
				</script>";
		}
	}

	public function delete($id)
	{
		if ($this->db->delete('schedule', array('id' => $id))) {
			echo "
				<script>
					alert('Yosh! Data berhasil dihapus!');
					window.location='".base_url($this->table)."'
				</script>";
		} else {
			echo "
				<script>
					alert('Yosh! Data gagal dihapus!');
					window.location='".base_url($this->table)."'
				</script>";
		}
	}

}

/* End of file Schedule_model.php */
/* Location: ./application/models/Schedule_model.php */