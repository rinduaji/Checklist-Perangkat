<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPetugas extends CI_Model
{

	public function get($id = '')
	{
		if ($id != '') {
			$this->db->where('id_petugas', $id);
		}
		return $this->db->get('petugas')->result();
	}

	public function get_tl($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->where('jabatan', 'Team Leader');
		return $this->db->get('login')->result();
	}

	public function get_it($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->where('jabatan', 'IT');
		return $this->db->get('login')->result();
	}

	public function get_me($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->where('jabatan', 'ME');
		return $this->db->get('login')->result();
	}

	public function getInsfected($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->where('jabatan', 'ME');
		return $this->db->get('login')->result();
	}

	public function getTlSpvKebersihan($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->where('jabatan', 'Team Leader OB');
		return $this->db->get('login')->result();
	}

	public function getNamaUserKebersihan($id = '')
	{
		if ($id != '') {
			$this->db->where('id_login', $id);
		}
		$this->db->not_like('jabatan', 'OB');
		return $this->db->get('login')->result();
	}
}

/* End of file dataPetugas.php */
/* Location: ./application/models/dataPetugas.php */