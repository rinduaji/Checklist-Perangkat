<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataLogin extends CI_Model {

	public function getLogin()
	{
		foreach ($this->db->get('login')->result() as $value) {
			if ($this->input->post('username') == $value->username && md5($this->input->post('password')) == $value->password) {
				return true;
			}
		}
		return false;
	}

}

/* End of file dataLogin.php */
/* Location: ./application/models/dataLogin.php */