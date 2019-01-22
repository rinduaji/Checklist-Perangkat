<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataCCTV extends CI_Model {

	public function get($bulan = '', $tahun = '', $shift = '', $id_ruangan = '')
	{
		$this->db->select('
			c.id_cctv,
			r.lantai, r.nama_ruangan,
			c.keterangan
		');
		// for ($i = 1; $i <= 31; $i++) {
		// 	$this->db->select('tgl'.$i.'.kondisi as t'.$i);
		// }
		$this->db->from('cctv c');
		$this->db->join('ruangan r', 'c.id_ruangan = r.id_ruangan', 'inner');
		// for ($i = 1; $i <= 31; $i++) {
		// 	$this->db->join('(SELECT c.id_cctv, cc.kondisi FROM cctv c, checklist_cctv cc WHERE c.id_cctv = cc.id_cctv AND cc.tanggal = "2019-01-'.$i.'") as tgl'.$i.'', 'tgl'.$i.'.id_cctv = c.id_cctv', 'left');
		// }
		
		if ($bulan != '') {
			$this->db->where('MONTH(c.tanggal)', $bulan);
		}
		if ($tahun != '') {
			$this->db->where('YEAR(c.tanggal)', $tahun);
		}
		if ($shift != '') {
			$this->db->where('c.shift', $shift);
		}

		// $this->db->where('c.id_ruangan', $id_ruangan);

		return $this->db->get()->result();
	}

	public function getBulan($id)
	{
		$this->db->select('MONTH(tanggal)');
		$this->db->where('id_cctv', $id);
		return $this->db->get('cctv')->result();
	}

	public function getChecklist($id_cctv)
	{
		$this->db->select('kondisi, DAY(tanggal) as tanggal');
		$this->db->where('id_cctv', $id_cctv);
		$this->db->order_by('tanggal', 'asc');
		return $this->db->get('checklist_cctv')->result();
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */