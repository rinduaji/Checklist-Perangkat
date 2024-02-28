<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPC extends CI_Model
{
	public $pc_id;

	public function get($byBulan = '', $byTahun = '', $byShift = '', $byID = '')
	{
		$this->db->select('a.id_checklist_pc, a.pc_id, a.tanggal, a.shift, a.nama_petugas, a.M1, a.M2, a.CPU, a.jumlah, a.TL, b.paraf AS paraf_tl, 
		 a.IT, c.paraf AS paraf_it, a.keterangan, a.gambar,a.`status`');
		$this->db->from('checklist_pc a');
		$this->db->join('login b', 'a.TL = b.username', 'left');
		$this->db->join('login c', 'a.IT = c.username', 'left');
		if ($byBulan != '') {
			$this->db->where('MONTH(a.tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(a.tanggal)', $byTahun);
		}
		// 		if ($byShift != '') {
		// 			$this->db->where('a.shift', $byShift);
		// 		}
		if ($byID != '') {
			$this->db->where('a.id_checklist_pc', $byID);
		}

		$this->db->order_by('a.tanggal', 'desc');
		return $this->db->get()->result();
	}

	public function getTL($byBulan = '', $byTahun = '', $byShift = '', $byID = '')
	{
		$this->db->select('a.id_checklist_pc, a.pc_id, a.tanggal, a.shift, a.nama_petugas, a.M1, a.M2, a.CPU, a.jumlah, a.TL, b.paraf AS paraf_tl, 
		 a.IT, c.paraf AS paraf_it, a.keterangan, a.gambar,a.`status`');
		$this->db->from('checklist_pc a');
		$this->db->join('login b', 'a.TL = b.username', 'left');
		$this->db->join('login c', 'a.IT = c.username', 'left');
		if ($byBulan != '') {
			$this->db->where('MONTH(a.tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(a.tanggal)', $byTahun);
		}
		// 		if ($byShift != '') {
		// 			$this->db->where('a.shift', $byShift);
		// 		}
		if ($byID != '') {
			$this->db->where('a.id_checklist_pc', $byID);
		}

		$this->db->order_by('a.tanggal', 'desc');
		return $this->db->get()->result();
	}

	public function getIT($byBulan = '', $byTahun = '', $byShift = '', $byID = '')
	{
		$this->db->select('a.id_checklist_pc, a.pc_id, a.tanggal, a.shift, a.nama_petugas, a.M1, a.M2, a.CPU, a.jumlah, a.TL, b.paraf AS paraf_tl, 
		 a.IT, c.paraf AS paraf_it, a.keterangan, a.gambar,a.`status`');
		$this->db->from('checklist_pc a');
		$this->db->join('login b', 'a.TL = b.username', 'left');
		$this->db->join('login c', 'a.IT = c.username', 'left');
		if ($byBulan != '') {
			$this->db->where('MONTH(a.tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(a.tanggal)', $byTahun);
		}
		// 		if ($byShift != '') {
		// 			$this->db->where('a.shift', $byShift);
		// 		}
		if ($byID != '') {
			$this->db->where('a.id_checklist_pc', $byID);
		}

		$this->db->order_by('a.tanggal', 'desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('checklist_pc', ["id_checklist_pc" => $this->input->post('id_checklist_pc')])->row();
	}

	public function insert()
	{
		// if (!is_null($checklist_pc = $this->db->select_max('id_checklist_pc')->get('checklist_pc')->result())) {
		// 	$id_checklist_pc = $checklist_pc[0]->id_checklist_pc + 1;
		// } else {
		// 	$id_checklist_pc = 1;
		// }
		$this->db->select_max('id_checklist_pc');
		$angka_tertinggi = $this->db->get('checklist_pc');
		$res2 = $angka_tertinggi->result_array();
		$angka1 = $res2[0]['id_checklist_pc'];
		$this->pc_id = $angka1 + 1;
		$M1 = ($this->input->post('M1')) ? 'cek' : 'kosong';
		$M2 = ($this->input->post('M2')) ? 'cek' : 'kosong';
		$CPU = ($this->input->post('CPU')) ? 'cek' : 'kosong';
		$jumlah = $this->input->post('jumlah');
		$status = 'Approve TL';

		$data = array(
			'id_checklist_pc'	=> $this->input->post('id_checklist_pc'),
			'pc_id'				=> $this->input->post('pc_id'),
			'tanggal'			=> date('Y-m-d'),
			'shift'				=> 'malam',
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'M1'				=> $M1,
			'M2'				=> $M2,
			'CPU'				=> $CPU,
			'jumlah'			=> $jumlah,
			'TL'				=> $this->input->post('TL'),
			'IT'				=> $this->input->post('IT'),
			'keterangan'		=> $this->input->post('keterangan'),
			'status'			=> $status,
			'gambar'			=> $this->_uploadImage(),
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('checklist_pc', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Ditambahkan',
				'status' => TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Ditambahkan',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/pc');
	}

	public function edit()
	{
		$this->pc_id = $this->input->post('id_checklist_pc');
		$M1 = ($this->input->post('M1')) ? 'cek' : 'kosong';
		$M2 = ($this->input->post('M2')) ? 'cek' : 'kosong';
		$CPU = ($this->input->post('CPU')) ? 'cek' : 'kosong';
		$jumlah = $this->input->post('jumlah');
		$status = 'Approve TL';

		$data = array(
			'pc_id'				=> $this->input->post('pc_id'),
			'shift'				=> $this->input->post('shift'),
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'M1'				=> $M1,
			'M2'				=> $M2,
			'CPU'				=> $CPU,
			'jumlah'			=> $jumlah,
			'TL'				=> $this->input->post('TL'),
			'IT'				=> $this->input->post('IT'),
			'keterangan'		=> $this->input->post('keterangan'),
			'gambar'			=> $this->_uploadImage(),
			'status'			=> $status
		);

		if (!empty($_FILES["image"]["name"])) {
			$data['gambar'] = $this->_uploadImage();
		} else {
			$pc = $this->getById($this->input->post('id_checklist_pc'));
			$data['gambar'] = $pc->gambar;
		}

		// echo var_dump($data);
		// die();

		$this->db->where('id_checklist_pc', $this->input->post('id_checklist_pc'));

		if ($this->db->update('checklist_pc', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Diupdate',
				'status' => TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Diupdate',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/pc');
	}

	public function editApproveIT($id)
	{
		$data = array(
			'status'			=> 'Approve IT'
		);

		$this->db->where('id_checklist_pc', $id);

		if ($this->db->update('checklist_pc', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Diupdate',
				'status' => TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Diupdate',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('Checklist_TL/pc');
	}

	public function editClosed($id)
	{
		$data = array(
			'status'			=> 'Closed'
		);

		$this->db->where('id_checklist_pc', $id);

		if ($this->db->update('checklist_pc', $data)) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Diupdate',
				'status' => TRUE
			);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Diupdate',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('Checklist_IT/pc');
	}

	public function delete($id)
	{

		$this->db->where('id_checklist_pc', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('checklist_pc')) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Dihapus',
				'status' => TRUE
			);
			$this->_deleteImage($id);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Dihapus',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklist/pc');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads/PC/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = $this->pc_id;
		$config['overwrite']			= true;
		$config['max_size']             = 1024;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			print_r($this->upload->display_errors());
			exit();
			return "default.jpg";
		} else {
			return $this->upload->data("file_name");
		}
	}

	private function _deleteImage($id)
	{
		$pc = $this->getById($id);
		if ($pc->gambar != "default.jpg") {
			$filename = explode(".", $pc->gambar)[0];
			return array_map('unlink', glob(FCPATH . "uploads/PC/$filename.*"));
		}
	}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */