<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataHydrant extends CI_Model
{
	public $id_hydrant;

	public function get($byBulan = '', $byTahun = '',  $byID = '')
	{
		$this->db->select('id_hydrant, bulan_tahun, jenis, file');
		$this->db->from('hydrant');
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
			$this->db->where('id_hydrant', $byID);
		}

		$this->db->order_by('bulan_tahun', 'desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('hydrant', ["id_hydrant" => $this->input->post('id_hydrant')])->row();
	}

	public function insert()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_hydrant'	=> $this->input->post('id_hydrant'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'jenis'		=> $this->input->post('jenis'),
			'file'			=> $this->_uploadImage(),
		);
		// echo var_dump($data);
		// die();

		if ($this->db->insert('hydrant', $data)) {
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
		redirect('checklist/hydrant');
	}

	public function edit()
	{
		$date=date_create($this->input->post('bulan_tahun'));

		$data = array(
			'id_hydrant'				=> $this->input->post('id_hydrant'),
			'jenis'				=> $this->input->post('jenis'),
			'bulan_tahun'		=> date_format($date,"Y-m-d"),
			'file'			=> $this->_uploadImage(),
		);

		if (!empty($_FILES["image"]["name"])) {
			$data['file'] = $this->_uploadImage();
		} else {
			$hydrant = $this->getById($this->input->post('id_hydrant'));
			$data['file'] = $hydrant->file;
		}

		// echo var_dump($data);
		// die();

		$this->db->where('id_hydrant', $this->input->post('id_hydrant'));

		if ($this->db->update('hydrant', $data)) {
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
		redirect('checklist/hydrant');
	}

	
	public function delete($id)
	{

		$this->db->where('id_hydrant', $id);
		// $this->db->delete('checklist_pc');
		if ($this->db->delete('hydrant')) {
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
		redirect('checklist/hydrant');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads/hydrant/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = $this->id_hydrant;
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
		$hydrant = $this->getById($id);
		if ($hydrant->hydrant != "default.jpg") {
			$filename = explode(".", $hydrant->hydrant)[0];
			return array_map('unlink', glob(FCPATH . "uploads/hydrant/$filename.*"));
		}
	}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */