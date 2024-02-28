<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataRuangan extends CI_Model {

	public function get($lantai = '', $bagian = '', $id = '')
	{
		if ($lantai != '') {
			$this->db->where('lantai', $lantai);
		}
		if ($bagian != '') {
			$this->db->where('bagian', $bagian);
		}
		if ($id != '') {
			$this->db->where('id_ruangan', $id);
		}

		$this->db->order_by('lantai', 'asc');
		return $this->db->get('ruangan')->result();
	}

	public function getLantaiOps($lantai = '', $bagian = '', $id = '') {
		$this->db->distinct();
		$this->db->select('lantai');

		$this->db->order_by('lantai', 'asc');
		return $this->db->get('ruangan')->result();
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */