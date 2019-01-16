<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAC extends CI_Model {

	public function get($byBulan = '', $byTahun = '', $byID = '')
	{
		if ($byBulan != '') {
			$this->db->where('MONTH(tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(tanggal)', $byTahun);
		}
		if ($byID != '') {
			$this->db->where('id_checklist_ac', $byID);
		}
		return $this->db->get('checklist_ac')->result();
	}

	public function insert()
	{
		// if (!is_null($checklist_ac = $this->db->select_max('id_checklist_ac')->get('checklist_ac')->result())) {
		// 	$id_checklist_ac = $checklist_ac[0]->id_checklist_ac + 1;
		// } else {
		// 	$id_checklist_ac = 1;
		// }

		$data = array(
			'id_checklist_ac'	=> $this->input->post('id_checklist_ac'),
			'ruangan'			=> $this->input->post('ruangan'),
			'tanggal'			=> date('Y-m-d'),
			'sts_ac_pagi'		=> $this->input->post('sts_ac_pagi'),
			'temp_pagi'			=> $this->input->post('temp_pagi'),
			'pic_pagi'			=> $this->input->post('pic_pagi'),
			'keterangan_pagi'	=> $this->input->post('keterangan_pagi'),
			'sts_ac_malam'		=> $this->input->post('sts_ac_malam'),
			'temp_malam'		=> $this->input->post('temp_malam'),
			'pic_malam'			=> $this->input->post('pic_malam'),
			'keterangan_malam'	=> $this->input->post('keterangan_malam')
		);

		// echo var_dump($data);
		// die();

		if ($this->db->insert('checklist_ac', $data)) {
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
		redirect('checklist/ac');
	}

	public function edit()
	{
		$data = array(
			'id_checklist_ac'	=> $this->input->post('id_checklist_ac'),
			'ruangan'			=> $this->input->post('ruangan'),
			'tanggal'			=> date('Y-m-d'),
			'sts_ac_pagi'		=> $this->input->post('sts_ac_pagi'),
			'temp_pagi'			=> $this->input->post('temp_pagi'),
			'pic_pagi'			=> $this->input->post('pic_pagi'),
			'keterangan_pagi'	=> $this->input->post('keterangan_pagi'),
			'sts_ac_malam'		=> $this->input->post('sts_ac_malam'),
			'temp_malam'		=> $this->input->post('temp_malam'),
			'pic_malam'			=> $this->input->post('pic_malam'),
			'keterangan_malam'	=> $this->input->post('keterangan_malam')
		);

		// echo var_dump($data);
		// die();

		$this->db->where('id_checklist_ac', $this->input->post('id_checklist_ac'));

		if ($this->db->update('checklist_ac', $data)) {
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
		redirect('checklist/ac');
	}

	public function delete($id)
	{
		$this->db->where('id_checklist_ac', $id);
		// $this->db->delete('checklist_ac');

		if ($this->db->delete('checklist_ac')) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Dihapus',
				'status'=> TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Dihapus',
				'status'=> FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/ac');
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */