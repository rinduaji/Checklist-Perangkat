<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataKebersihan extends CI_Model
{
	public $id_check_kebersihan;

	public function getKebersihan($byBulan = '', $byTahun = '', $byShift = '', $byID = '')
	{
		$this->db->select('a.id_check_kebersihan, a.tanggal, a.jam, a.lantai_operasional, a.id_ruangan, b.nama_ruangan, a.pic, a.lantai, a.dinding, a.list, a.kaca, a.plafon, 
		 a.furniture, a.ws, a.pc, a.ac, a.telephone, a.aksesoris, a.kap_lampu, a.tempat_sampah, a.kursi_staff, a.meja_staff, a.insfected, a.tl_spv, a.nama_user, a.ttd_user, a.keterangan');
		$this->db->from('checklist_kebersihan a');
		$this->db->join('ruangan b', 'a.id_ruangan = b.id_ruangan');
		if ($byBulan != '') {
			$this->db->where('MONTH(a.tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(a.tanggal)', $byTahun);
		}
		if ($byShift != '') {
			$this->db->where('a.jam', urldecode($byShift));
		}
		if ($byID != '') {
			$this->db->where('a.id_check_kebersihan', $byID);
		}

		$this->db->order_by('a.tanggal', 'desc');
		return $this->db->get()->result();
	}

	public function getLaporanKebersihan($byBulan = '', $byTahun = '', $byShift = '', $byLantai = '', $byID = '')
	{
		$this->db->select('a.id_check_kebersihan, a.tanggal, a.jam, a.lantai_operasional, a.id_ruangan, b.nama_ruangan, a.pic, a.lantai, a.dinding, a.list, a.kaca, a.plafon, 
		 a.furniture, a.ws, a.pc, a.ac, a.telephone, a.aksesoris, a.kap_lampu, a.tempat_sampah, a.kursi_staff, a.meja_staff, a.insfected, a.tl_spv, a.nama_user, a.ttd_user, a.keterangan');
		$this->db->from('checklist_kebersihan a');
		$this->db->join('ruangan b', 'a.id_ruangan = b.id_ruangan');
		if ($byBulan != '') {
			$this->db->where('MONTH(a.tanggal)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(a.tanggal)', $byTahun);
		}
		if ($byShift != '') {
			$this->db->where('a.jam', urldecode($byShift));
		}
		if ($byLantai != '') {
			$this->db->where('a.lantai_operasional', $byLantai);
		}
		if ($byID != '') {
			$this->db->where('a.id_check_kebersihan', $byID);
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
		return $this->db->get_where('checklist_kebersihan', ["id_check_kebersihan" => $this->input->post('id_check_kebersihan')])->row();
	}

	public function getTTDUserKebersihan($username) {
		$this->db->where('username', $username);
		return $this->db->get('login')->row();
	}

	public function insert()
	{
		
		$ttd_user = $this->getTTDUserKebersihan($this->input->post('nama_user'))->paraf;
		
		$data = array(
			'tanggal'			=> $this->input->post('tanggal'),
			'jam'				=> $this->input->post('jam'),
			'lantai_operasional'=> $this->input->post('lantai_operasional'),
			'id_ruangan'		=> $this->input->post('id_ruangan'),
			'pic'				=> $this->input->post('pic'),
			'lantai'				=> $this->input->post('lantai'),
			'dinding'				=> $this->input->post('dinding'),
			'list'				=> $this->input->post('list'),
			'kaca'			=> $this->input->post('kaca'),
			'plafon'				=> $this->input->post('plafon'),
			'furniture'				=> $this->input->post('furniture'),
			'ws'		=> $this->input->post('ws'),
			'pc'			=> $this->input->post('pc'),
			'ac'			=> $this->input->post('ac'),
			'telephone'				=> $this->input->post('telephone'),
			'aksesoris'			=> $this->input->post('aksesoris'),
			'kap_lampu'				=> $this->input->post('kap_lampu'),
			'tempat_sampah'				=> $this->input->post('tempat_sampah'),
			'kursi_staff'		=> $this->input->post('kursi_staff'),
			'meja_staff'			=> $this->input->post('meja_staff'),
			'insfected'			=> $this->input->post('insfected'),
			'tl_spv'				=> $this->input->post('tl_spv'),
			'nama_user'			=> $this->input->post('nama_user'),
			'ttd_user'				=> $ttd_user,
			'keterangan'				=> $this->input->post('keterangan'),
		);
		// print_r($data);
		// die();

		if ($this->db->insert('checklist_kebersihan', $data)) {
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
		redirect('checklistOB/kebersihan');
	}

	public function edit()
	{
		$ttd_user = $this->getTTDUserKebersihan($this->input->post('nama_user'))->paraf;
		$this->id_check_kebersihan = $this->input->post('id_check_kebersihan');
		// $M1 = ($this->input->post('M1')) ? 'cek' : 'kosong';
		// $M2 = ($this->input->post('M2')) ? 'cek' : 'kosong';
		// $CPU = ($this->input->post('CPU')) ? 'cek' : 'kosong';
		// $jumlah = $this->input->post('jumlah');
		// $status = 'Approve TL';

		$data = array(
			'tanggal'			=> $this->input->post('tanggal'),
			'jam'				=> $this->input->post('jam'),
			'lantai_operasional'=> $this->input->post('lantai_operasional'),
			'id_ruangan'		=> $this->input->post('id_ruangan'),
			'pic'				=> $this->input->post('pic'),
			'lantai'				=> $this->input->post('lantai'),
			'dinding'				=> $this->input->post('dinding'),
			'list'				=> $this->input->post('list'),
			'kaca'			=> $this->input->post('kaca'),
			'plafon'				=> $this->input->post('plafon'),
			'furniture'				=> $this->input->post('furniture'),
			'ws'		=> $this->input->post('ws'),
			'pc'			=> $this->input->post('pc'),
			'ac'			=> $this->input->post('ac'),
			'telephone'				=> $this->input->post('telephone'),
			'aksesoris'			=> $this->input->post('aksesoris'),
			'kap_lampu'				=> $this->input->post('kap_lampu'),
			'tempat_sampah'				=> $this->input->post('tempat_sampah'),
			'kursi_staff'		=> $this->input->post('kursi_staff'),
			'meja_staff'			=> $this->input->post('meja_staff'),
			'insfected'			=> $this->input->post('insfected'),
			'tl_spv'				=> $this->input->post('tl_spv'),
			'nama_user'			=> $this->input->post('nama_user'),
			'ttd_user'				=> $ttd_user,
			'keterangan'				=> $this->input->post('keterangan'),
		);
		// print_r($this->input->post('id_check_kebersihan'));
		// die();

		// if (!empty($_FILES["image"]["name"])) {
		// 	$data['gambar'] = $this->_uploadImage();
		// } else {
		// 	$pc = $this->getById($this->input->post('id_checklist_pc'));
		// 	$data['gambar'] = $pc->gambar;
		// }

		// echo var_dump($data);
		// die();

		$this->db->where('id_check_kebersihan', $this->input->post('id_check_kebersihan'));

		if ($this->db->update('checklist_kebersihan', $data)) {
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
		redirect('checklistOB/kebersihan');
	}

	public function editApproveIT($id)
	{
		$data = array(
			'status'			=> 'Approve IT'
		);

		$this->db->where('id_check_kebersihan', $id);

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

		$this->db->where('id_check_kebersihan', $id);

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

		$this->db->where('id_check_kebersihan', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('checklist_kebersihan')) {
			$flashArray = array(
				'pesan' => 'Data Berhasil Dihapus',
				'status' => TRUE
			);
			// $this->_deleteImage($id);
		} else {
			$flashArray = array(
				'pesan' => 'Data Gagal Dihapus',
				'status' => FALSE
			);
		}

		$this->session->set_flashdata($flashArray);
		redirect('checklistOB/kebersihan');
	}

	// private function _uploadImage()
	// {
	// 	$config['upload_path']          = './uploads/PC/';
	// 	$config['allowed_types']        = 'gif|jpg|png|jpeg';
	// 	$config['file_name']            = $this->pc_id;
	// 	$config['overwrite']			= true;
	// 	$config['max_size']             = 1024;

	// 	$this->load->library('upload', $config);
	// 	$this->upload->initialize($config);
	// 	if (!$this->upload->do_upload('image')) {
	// 		print_r($this->upload->display_errors());
	// 		exit();
	// 		return "default.jpg";
	// 	} else {
	// 		return $this->upload->data("file_name");
	// 	}
	// }

	// private function _deleteImage($id)
	// {
	// 	$pc = $this->getById($id);
	// 	if ($pc->gambar != "default.jpg") {
	// 		$filename = explode(".", $pc->gambar)[0];
	// 		return array_map('unlink', glob(FCPATH . "uploads/PC/$filename.*"));
	// 	}
	// }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */