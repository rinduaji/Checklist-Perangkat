<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataFap extends CI_Model
{
	public $id_fap;

	public function get($byBulan = '', $byTahun = '',  $byID = '')
	{
		$this->db->select('id_fap, bulan_tahun, jenis, file');
		$this->db->from('fap');
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
			$this->db->where('id_fap', $byID);
		}

		$this->db->order_by('bulan_tahun', 'desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('fap', ["id_fap" => $this->input->post('id_fap')])->row();
	}

	public function insert()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_fap'	=> $this->input->post('id_fap'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'jenis'		=> $this->input->post('jenis'),
			'file'			=> $this->_uploadImage(),
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('fap', $data)) {
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
		redirect('checklist/fap');
	}

	public function edit()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_fap'				=> $this->input->post('id_fap'),
			'jenis'				=> $this->input->post('jenis'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'file'			=> $this->_uploadImage(),
		);

		if (!empty($_FILES["image"]["name"])) {
			$data['file'] = $this->_uploadImage();
		} else {
			$fap = $this->getById($this->input->post('id_fap'));
			$data['file'] = $fap->file;
		}

		// echo var_dump($data);
		// die();

		$this->db->where('id_fap', $this->input->post('id_fap'));

		if ($this->db->update('fap', $data)) {
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
		redirect('checklist/fap');
	}

	
	public function delete($id)
	{

		$this->db->where('id_fap', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('fap')) {
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
		redirect('checklist/fap');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads/fap/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = $this->id_fap;
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
		$fap = $this->getById($id);
		if ($fap->fap != "default.jpg") {
			$filename = explode(".", $fap->fap)[0];
			return array_map('unlink', glob(FCPATH . "uploads/fap/$filename.*"));
		}
	}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */