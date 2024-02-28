<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMeVendor extends CI_Model
{
	public $id_me_vendor;

	public function get($byBulan = '', $byTahun = '',  $byID = '')
	{
		$this->db->select('id_me_vendor, bulan_tahun, jenis, file');
		$this->db->from('me_vendor');
		if ($byBulan != '') {
			$this->db->where('MONTH(bulan_tahun)', $byBulan);
		}
		if ($byTahun != '') {
			$this->db->where('YEAR(bulan_tahun)', $byTahun);
		}
		// 		if ($byShift != '') {
		// 			$this->db->where('a.shift', $byShift);
		// 		}
		if ($byID != '') {
			$this->db->where('id_me_vendor', $byID);
		}

		$this->db->order_by('bulan_tahun', 'desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('me_vendor', ["id_me_vendor" => $this->input->post('id_me_vendor')])->row();
	}

	public function insert()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_me_vendor'	=> $this->input->post('id_me_vendor'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'jenis'		=> $this->input->post('jenis'),
			'file'			=> $this->_uploadImage(),
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('me_vendor', $data)) {
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
		redirect('checklist/me_vendor');
	}

	public function edit()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_me_vendor'				=> $this->input->post('id_me_vendor'),
			'jenis'				=> $this->input->post('jenis'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'file'			=> $this->_uploadImage(),
		);

		if (!empty($_FILES["image"]["name"])) {
			$data['file'] = $this->_uploadImage();
		} else {
			$me_vendor = $this->getById($this->input->post('id_me_vendor'));
			$data['file'] = $me_vendor->file;
		}

		// echo var_dump($data);
		// die();

		$this->db->where('id_me_vendor', $this->input->post('id_me_vendor'));

		if ($this->db->update('me_vendor', $data)) {
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
		redirect('checklist/me_vendor');
	}

	
	public function delete($id)
	{

		$this->db->where('id_me_vendor', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('me_vendor')) {
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
		redirect('checklist/me_vendor');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads/me_vendor/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = $this->id_me_vendor;
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
		$me_vendor = $this->getById($id);
		if ($me_vendor->me_vendor != "default.jpg") {
			$filename = explode(".", $me_vendor->me_vendor)[0];
			return array_map('unlink', glob(FCPATH . "uploads/me_vendor/$filename.*"));
		}
	}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */