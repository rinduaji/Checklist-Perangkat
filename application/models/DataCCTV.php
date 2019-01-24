<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataCCTV extends CI_Model {

	// public function get($bulan = '', $tahun = '', $shift = '', $id_ruangan = '')
	// {
	// 	$this->db->select('
	// 		c.id_cctv,
	// 		r.lantai, r.nama_ruangan,
	// 		c.keterangan
	// 		');
	// 	// for ($i = 1; $i <= 31; $i++) {
	// 	// 	$this->db->select('tgl'.$i.'.kondisi as t'.$i);
	// 	// }
	// 	$this->db->from('cctv c');
	// 	$this->db->join('ruangan r', 'c.id_ruangan = r.id_ruangan', 'inner');
	// 	// for ($i = 1; $i <= 31; $i++) {
	// 	// 	$this->db->join('(SELECT c.id_cctv, cc.kondisi FROM cctv c, checklist_cctv cc WHERE c.id_cctv = cc.id_cctv AND cc.tanggal = "2019-01-'.$i.'") as tgl'.$i.'', 'tgl'.$i.'.id_cctv = c.id_cctv', 'left');
	// 	// }
		
	// 	if ($bulan != '') {
	// 		$this->db->where('MONTH(c.tanggal)', $bulan);
	// 	}
	// 	if ($tahun != '') {
	// 		$this->db->where('YEAR(c.tanggal)', $tahun);
	// 	}
	// 	if ($shift != '') {
	// 		$this->db->where('c.shift', $shift);
	// 	}

	// 	// $this->db->where('c.id_ruangan', $id_ruangan);

	// 	return $this->db->get()->result();
	// }

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

	public function getCCTV($bulan = '', $tahun = '', $shift = '', $id ='')
	{
		if ($bulan != '') {
			$this->db->where('MONTH(tanggal)', $bulan);
		}
		if ($tahun != '') {
			$this->db->where('YEAR(tanggal)', $tahun);
		}
		if ($shift != '') {
			$this->db->where('shift', $shift);
		}
		if ($id != '') {
			$this->db->where('id_check_cctv', $id);
		}

		$this->db->join('ruangan r', 'r.id_ruangan = cc.id_ruangan');

		return $this->db->get('check_cctv cc')->result();
	}

	public function insertBulanan()
	{
		$this->db->select('id_check_cctv');
		$this->db->where('MONTH(tanggal)', date('m'));
		$this->db->where('YEAR(tanggal)', date('Y'));

		$row = $this->db->get('check_cctv')->num_rows();

		if ($row == 0) {
			$query = "INSERT INTO `check_cctv` VALUES
				(NULL, '1', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '2', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '3', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '4', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '5', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '6', 'pagi', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '1', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '2', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '3', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '4', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '5', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '6', 'sore', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '1', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '2', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '3', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '4', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '5', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
				(NULL, '6', 'malam', '".date('Y-m-d')."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')
			";

			$this->db->query($query);
		}
	}

	public function insert()
	{
		$data = array(
			'tgl'.date('d')	=> $this->input->post('kondisi')
		);

		// echo json_encode($data);
		// die();

		$this->db->where('MONTH(tanggal)', date('m'));
		$this->db->where('YEAR(tanggal)', date('Y'));
		$this->db->where('shift', $this->input->post('shift'));
		$this->db->where('id_ruangan', $this->input->post('id_ruangan'));

		if ($this->db->update('check_cctv', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Ditambahkan',
				'status'=> TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Ditambahkan',
				'status'=> FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/cctv');
	}

	public function edit()
	{
		$id_check_cctv = $this->input->post('id_check_cctv');
		$tanggal_edit = $this->input->post('tanggal_edit');
		
		if ($tanggal_edit < 10) {
			$tanggal_edit = '0'.$this->input->post('tanggal_edit');
		}

		if (!empty($tanggal_edit)) {
			$data = array(
				'tgl'.$tanggal_edit	=> $this->input->post('kondisi')
			);
		} else {
			$data = array(
				'keterangan'	=> $this->input->post('keterangan')
			);			
		}

		// echo json_encode($data);
		// die();

		$this->db->where('id_check_cctv', $id_check_cctv);

		if ($this->db->update('check_cctv', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Diupdate',
				'status'=> TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Diupdate',
				'status'=> FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/cctv');
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */