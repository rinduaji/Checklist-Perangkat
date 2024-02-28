<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPenilaianVendor extends CI_Model
{
	public $id_penilaian_vendor;

	public function get($byTahun = '',  $byID = '')
	{
		$this->db->select('id_penilaian_vendor, bulan_tahun, jenis, file');
		$this->db->from('penilaian_vendor');
		
		if ($byTahun != '') {
			$this->db->where('YEAR(bulan_tahun)', $byTahun);
		}
		// 		if ($byShift != '') {
		// 			$this->db->where('a.shift', $byShift);
		// 		}
		if ($byID != '') {
			$this->db->where('id_penilaian_vendor', $byID);
		}

		$this->db->order_by('bulan_tahun', 'desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('penilaian_vendor', ["id_penilaian_vendor" => $this->input->post('id_penilaian_vendor')])->row();
	}

	public function insert()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_penilaian_vendor'	=> $this->input->post('id_penilaian_vendor'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'jenis'		=> $this->input->post('jenis'),
			'file'			=> $this->_uploadImage(),
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('penilaian_vendor', $data)) {
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
		redirect('checklist/penilaian_vendor');
	}

	public function edit()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_penilaian_vendor'				=> $this->input->post('id_penilaian_vendor'),
			'jenis'				=> $this->input->post('jenis'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'file'			=> $this->_uploadImage(),
		);

		if (!empty($_FILES["image"]["name"])) {
			$data['file'] = $this->_uploadImage();
		} else {
			$penilaian_vendor = $this->getById($this->input->post('id_penilaian_vendor'));
			$data['file'] = $penilaian_vendor->file;
		}

		// echo var_dump($data);
		// die();

		$this->db->where('id_penilaian_vendor', $this->input->post('id_penilaian_vendor'));

		if ($this->db->update('penilaian_vendor', $data)) {
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
		redirect('checklist/penilaian_vendor');
	}

	
	public function delete($id)
	{

		$this->db->where('id_penilaian_vendor', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('penilaian_vendor')) {
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
		redirect('checklist/penilaian_vendor');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads/penilaian_vendor/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = $this->id_penilaian_vendor;
		$config['overwrite']			= true;
		$config['max_size']             = 204800;

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
		$penilaian_vendor = $this->getById($id);
		if ($penilaian_vendor->penilaian_vendor != "default.jpg") {
			$filename = explode(".", $penilaian_vendor->penilaian_vendor)[0];
			return array_map('unlink', glob(FCPATH . "uploads/penilaian_vendor/$filename.*"));
		}
	}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */