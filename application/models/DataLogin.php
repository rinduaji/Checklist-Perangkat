<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataLogin extends CI_Model
{

	public function getLogin()
	{
		foreach ($this->db->get('login')->result() as $value) {
			if (strtolower($this->input->post('username')) == strtolower($value->username) && md5($this->input->post('password')) == $value->password) {
				return $value->jabatan;
			}
		}
		return false;
	}
}

/* End of file dataLogin.php */
/* Location: ./application/models/dataLogin.php */