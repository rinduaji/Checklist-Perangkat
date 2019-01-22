<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataUPS extends CI_Model {

	public function get($byBulan = '', $byTahun = '', $byID = '')
	{
		if ($byBulan != '') {
			$this->db->where('MONTH(tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(tanggal)', $byTahun);
		}
		if ($byID != '') {
			$this->db->where('id_checklist_ups', $byID);
		}
		return $this->db->get('checklist_ups')->result();
	}

	public function insert()
	{
		$data = array(
			'id_checklist_ups'	=> $this->input->post('id_checklist_ups'),
			'tanggal'			=> date('Y-m-d'),
			'lokasi'			=> $this->input->post('lokasi'),
			'merk'				=> $this->input->post('merk'),
			'type'				=> $this->input->post('type'),
			'input'				=> $this->input->post('input'),
			'output'			=> $this->input->post('output'),
			'baterai_time'		=> $this->input->post('baterai_time'),
			'petugas'			=> $this->input->post('petugas'),
			'keterangan'		=> $this->input->post('keterangan')
		);

		// echo var_dump($data);
		// die();

		if ($this->db->insert('checklist_ups', $data)) {
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
		redirect('checklist/ups');
	}

	public function edit()
	{
		$data = array(
			'id_checklist_ups'	=> $this->input->post('id_checklist_ups'),
			'tanggal'			=> date('Y-m-d'),
			'lokasi'			=> $this->input->post('lokasi'),
			'merk'				=> $this->input->post('merk'),
			'type'				=> $this->input->post('type'),
			'input'				=> $this->input->post('input'),
			'output'			=> $this->input->post('output'),
			'baterai_time'		=> $this->input->post('baterai_time'),
			'petugas'			=> $this->input->post('petugas'),
			'keterangan'		=> $this->input->post('keterangan')
		);

		// echo var_dump($data);
		// die();

		$this->db->where('id_checklist_ups', $this->input->post('id_checklist_ups'));

		if ($this->db->update('checklist_ups', $data)) {
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
		redirect('checklist/ups');
	}

	public function delete($id)
	{
		$this->db->where('id_checklist_ups', $id);
		// $this->db->delete('checklist_ups');

		if ($this->db->delete('checklist_ups')) {
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
		redirect('checklist/ups');
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */