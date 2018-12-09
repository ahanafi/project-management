<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$devisi   = $this->input->post('devisi');
		$condition = array(
				'username' 	=> $username,
				'devisi' 	=> $devisi
			);
		$sql = $this->db->get_where('users', $condition);
		if ($sql->num_rows() > 0) {
			$data = $sql->row();
			if (password_verify($password, $data->password)) {
				$data_session = array(
						'id'		=> $data->id,
						'username' 	=> $data->username,
						'password' 	=> $data->password,
						'devisi'	=> $data->devisi,
						'logged_in'	=> TRUE
					);
				$this->session->set_userdata($data_session);
				return true;
			}
		} else {
			return false;
		}


	}

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */