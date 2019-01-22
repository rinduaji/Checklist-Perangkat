<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPC extends CI_Model {

	public function get($byBulan = '', $byTahun = '', $byShift = '', $byID = '')
	{
		if ($byBulan != '') {
			$this->db->where('MONTH(tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(tanggal)', $byTahun);
		}
		if ($byShift != '') {
			$this->db->where('shift', $byShift);
		}
		if ($byID != '') {
			$this->db->where('id_checklist_pc', $byID);
		}
		return $this->db->get('checklist_pc')->result();
	}

	public function insert()
	{
		// if (!is_null($checklist_pc = $this->db->select_max('id_checklist_pc')->get('checklist_pc')->result())) {
		// 	$id_checklist_pc = $checklist_pc[0]->id_checklist_pc + 1;
		// } else {
		// 	$id_checklist_pc = 1;
		// }

		$M1 = ($this->input->post('M1')) ? 'cek' : 'kosong';
		$M2 = ($this->input->post('M2')) ? 'cek' : 'kosong';
		$CPU = ($this->input->post('CPU')) ? 'cek' : 'kosong';

		$data = array(
			'id_checklist_pc'	=> $this->input->post('id_checklist_pc'),
			'pc_id'				=> $this->input->post('pc_id'),
			'tanggal'			=> date('Y-m-d'),
			'shift'				=> $this->input->post('shift'),
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'M1'				=> $M1,
			'M2'				=> $M2,
			'CPU'				=> $CPU,
			'TL'				=> $this->input->post('TL'),
			'IT'				=> $this->input->post('IT'),
			'keterangan'		=> $this->input->post('keterangan')
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('checklist_pc', $data)) {
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
		redirect('checklist/pc');
	}

	public function edit()
	{
		$M1 = ($this->input->post('M1')) ? 'cek' : 'kosong';
		$M2 = ($this->input->post('M2')) ? 'cek' : 'kosong';
		$CPU = ($this->input->post('CPU')) ? 'cek' : 'kosong';

		$data = array(
			'pc_id'				=> $this->input->post('pc_id'),
			'shift'				=> $this->input->post('shift'),
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'M1'				=> $M1,
			'M2'				=> $M2,
			'CPU'				=> $CPU,
			'TL'				=> $this->input->post('TL'),
			'IT'				=> $this->input->post('IT'),
			'keterangan'		=> $this->input->post('keterangan')
		);

		// echo var_dump($data);
		// die();

		$this->db->where('id_checklist_pc', $this->input->post('id_checklist_pc'));

		if ($this->db->update('checklist_pc', $data)) {
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
		redirect('checklist/pc');
	}

	public function delete($id)
	{
		$this->db->where('id_checklist_pc', $id);
		// $this->db->delete('checklist_pc');

		if ($this->db->delete('checklist_pc')) {
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
		redirect('checklist/pc');
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */