<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function insert($data)
	{
		if($this->db->insert('project', $data)){
			echo "<script type='text/javascript'>
				alert('Yosh! Berhasil menambahkan data project baru!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Oops!, Gagal menambahkan data project baru!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		}
	}

	public function insert_design($id, $data)
	{
		$this->db->where('id', $id);
		if($this->db->update('project', $data)){
			echo "<script type='text/javascript'>
				alert('Yosh! Images berasil diupload!');
				window.location='".base_url('design')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Oops! Images gagal diupload!');
				window.location='".base_url('design')."';
			</script>";
		}
	}

	public function cek_nomor_project($nomor)
	{
		$sql = $this->db->get_where('project', array('no' => $nomor));
		if ($sql->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function project_all()
	{
		return $this->db->get('project')->result();
	}

	public function project_devisi($dev, $sent = NULL)
	{
		if ($sent != NULL) {
			$this->db->select('*');
			$this->db->from('project');
			$this->db->where("devisi = '$dev'");
			$this->db->or_where("terkirim = 1");
			$sql = $this->db->get();		
		} else {
			$sql = $this->db->get_where('project', array('devisi' => $dev));
		}
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function checkSend($id)
	{
		return $this->db->get_where('project', array('terkirim' => 1));
	}

	public function project_id($id)
	{
		return $this->db->get_where('project', array('id' => $id))->row();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('project', $data)) {
			echo "<script type='text/javascript'>
				alert('Yosh! Data project berhasil diperbarui!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Oops!! Data project gagal diperbarui!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		}
	}

	public function delete($id)
	{
		if ($this->db->delete('project', array('id'=>$id))) {
			echo "<script type='text/javascript'>
				alert('Yosh! Data project berhasil dihapus!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Oops!! Data project gagal dihapus!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		}
	}
	
	public function send_project($id)
	{
		$data = array('terkirim' => 1);
		$this->db->where('id', $id);
		if ($this->db->update('project', $data)){
			echo "<script type='text/javascript'>
				alert('Yosh! Data project berhasil dikirim ke devisi Engineering!');
				window.location='".base_url('dashboard/master')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Yosh! Data project gagal dikirim!');
				window.location='".base_url('dashboard/master')."';
			</script>";
		}
	}

	public function send_revisi($id, $data)
	{
		$update = array('revisi' => 1);
		$this->db->where('id', $id);
		if ($this->db->update('project', $update)){
			if($this->db->insert('revisi', $data)){
				echo "<script type='text/javascript'>
					alert('Yosh! Data project berhasil dikirim untuk direvisi!');
					window.location='".base_url('dashboard/master')."';
				</script>";
			} else {
				echo "<script type='text/javascript'>
					alert('Yosh! Data project gagal dikirim!');
					window.location='".base_url('dashboard/master')."';
				</script>";
			}
		} else {
			return false;
		}
	}

	public function cancel_revisi($id)
	{
		$cancel = array('revisi' => 0);
		$this->db->where('id', $id);
		$removeRevisi = $this->db->update('project', $cancel);
		$deleteRevisi = $this->db->delete('revisi', array('id_project' => $id));
		if ($removeRevisi && $deleteRevisi) {
			echo "<script type='text/javascript'>
				alert('Yosh! Data project berhasil dibatalkan untuk revisi!');
				window.location='".base_url('dashboard/master')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Yosh! Data project gagal undo revisi!');
				window.location='".base_url('dashboard/master')."';
			</script>";
		}
	}

	public function project_revisi()
	{
		$this->db->select('app_project.id, customer, keterangan, no');
		$this->db->from('project');
		$this->db->join('revisi', "app_project.id = app_revisi.id_project");
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function end($id)
	{
		$data = array(
				'terkirim' => 2
			);
		$this->db->where('id', $id);
		if ($this->db->update('project', $data)) {
				echo "<script type='text/javascript'>
					alert('Yosh! Data project berhasil dikirim ke devisi gudang!');
					window.location='".base_url('dashboard/master')."';
				</script>";
			} else {
				echo "<script type='text/javascript'>
					alert('Yosh! Data project gagal dikirim!');
					window.location='".base_url('dashboard/master')."';
				</script>";
			}
	}

	public function project_jadi()
	{
		//SELECT * FROM app_jadi RIGHT JOIN app_project ON app_project.id = app_jadi.id_project WHERE terkirim = 2

		$this->db->select('*');
		$this->db->from('jadi');
		$this->db->join('project', 'app_project.id = app_jadi.id_project', 'right');
		//$this->db->join('rack', 'app_rack.id = app_jadi.id_rack');
		$this->db->where('terkirim', 2);

		$sql = $this->db->get();
		//print_r($sql);
		//$sql = $this->db->get_where('project', array('terkirim' => 2));
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function cek_project_jadi($id_project)
	{
		$sql = $this->db->get_where('jadi', array('id_project', $id_project));
		if ($sql->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function count_full()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('jadi', 'app_project.id = app_jadi.id_project');
		$this->db->join('rack', 'app_rack.id = app_jadi.id_rack');
		$sql = $this->db->get();
		return $sql->num_rows();
	}

	public function project_full()
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('jadi', 'app_project.id = app_jadi.id_project');
		$this->db->join('rack', 'app_rack.id = app_jadi.id_rack');
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function set_position($data)
	{
		if ($this->db->insert('jadi', $data)) {
			echo "<script type='text/javascript'>
				alert('Yosh! Data posisi project berhasil disimpan!');
				window.location='".base_url('dashboard/project')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Yosh! Data posisi project gagal disimpan!');
				window.location='".base_url('project/position/'.$data['id'])."';
			</script>";
		}
	}

	public function rack_project($id_rack)
	{
		$this->db->select('*');
		$this->db->from('jadi');
		$this->db->join('project', "app_jadi.id_project = app_project.id");
		$this->db->join('rack', "app_jadi.id_rack = app_rack.id");
		$this->db->where('id_rack', $id_rack);
		$sql = $this->db->get();
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function count_all()
	{
		return $this->db->get('project')->num_rows();
		
	}

	public function count_sent($type)
	{
		$sql = $this->db->get_where('project', array('terkirim' => $type));
		return $sql->num_rows();
	}

	public function list_spec()
	{
		$this->db->select('DISTINCT(spesifikasi)');
		$this->db->from('project');
		$sql = $this->db->get();
		/*if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}*/
		return $sql;
	}

	public function count_spec($number, $tanggal_awal, $tanggal_akhir)
	{
		//SELECT COUNT(*) FROM app_project WHERE `tanggal_terima` BETWEEN '2017-01-01' AND '2017-01-31' AND `spesifikasi` = 'CTB-12, 200/2A, 15VA CL 0.2'

		$this->db->select('*');
		$this->db->from('project');
/*		$this->db->where('tanggal_terima >=', $tanggal_awal);
		$this->db->where('tanggal_terima <=', $tanggal_akhir);*/
		$this->db->where("tanggal_terima BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ");
		$this->db->where('spesifikasi', $number);
		$sql = $this->db->get();
		return $sql->num_rows();
	}

	public function delete_request($id)
	{
		if ($this->db->delete('pesan_material', array('id'=>$id))) {
			echo "<script type='text/javascript'>
				alert('Yosh! Data permintaan material berhasil dihapus!');
				window.location='".base_url('dashboard/requests')."';
			</script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Oops!! Data permintaan material gagal dihapus!');
				window.location='".base_url('dashboard/requests')."';
			</script>";
		}
	}

	public function devisi_insert($data, $dev)
	{
		if ($this->db->insert('project_'.$dev, $data)) {
			echo "
				<script>
					alert('Yosh! Data project berhasil disimpan!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		} else {
			echo "
				<script>
					alert('Oops! Data project gagal disimpan!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		}
	}

	public function devisi_update($data, $dev, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update('project_'.$dev, $data)) {
			echo "
				<script>
					alert('Yosh! Data project berhasil diperbarui!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		} else {
			echo "
				<script>
					alert('Oops! Data project gagal diperbarui!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		}
	}

	public function devisi_delete($dev, $id)
	{
		if ($this->db->delete('project_'.$dev, array('id' => $id))) {
			echo "
				<script>
					alert('Yosh! Data project berhasil dihapus!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		} else {
			echo "
				<script>
					alert('Oops! Data project gagal dihapus!');
					window.location='".base_url('project/devisi/'.$dev)."';
				</script>";
		}
	}

	public function get_devisi($devisi)
	{
		$sql = $this->db->get('project_'.$devisi);
		if ($sql->num_rows() > 0) {
			return $sql->result();
		} else {
			return false;
		}
	}

	public function get_dev_id($dev, $id)
	{
		$sql = $this->db->get_where('project_'.$dev, array('id' =>  $id));
		if ($sql->num_rows() > 0) {
			return $sql->row();
		}
	}
}

/* End of file Project_model.php */
/* Location: ./application/models/Project_model.php */