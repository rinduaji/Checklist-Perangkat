<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {
	var $bulan = array(
		"Januari"   => "1",
		"Februari"  => "2",
		"Maret"     => "3",
		"April"     => "4",
		"Mei"       => "5",
		"Juni"      => "6",
		"Juli"      => "7",
		"Agustus"   => "8",
		"September" => "9",
		"Oktober"   => "10",
		"November"  => "11",
		"Desember"  => "12"
	);

	var $tahun = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('masuk')) {
			$flashArray = array(
				'pesan' => 'Anda Belum Login, Silahkan Login terlebih dahulu',
				'status'=> FALSE
			);
			$this->session->set_flashdata($flashArray);
			redirect('login');
		}
		$initTahun = 2000;
		for ($i = 0; $i < 100; $i++) {
			$this->tahun[$i] = $initTahun++;
		}
		$this->load->model('DataPetugas');
		$this->load->model('DataPC');
		$this->load->model('DataAC');
	}

	public function index()
	{
		redirect('home');
	}

	public function pc_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataPC->get('','',$id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataPC->get($bulan,$tahun);
		}  else {
			$data = $this->DataPC->get();
		}
		echo json_encode($data);
	}

	public function ac_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataAC->get('','',$id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataAC->get($bulan,$tahun);
		}  else {
			$data = $this->DataAC->get();
		}
		echo json_encode($data);
	}

	public function pc()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/pc', $data);
	}

	public function ac()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/ac', $data);
	}

	public function ups()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/ups', $data);
	}

	public function tambah($bagian)
	{
		if ($bagian=="pc") {
			$this->DataPC->insert();
		} else if ($bagian=="ac") {
			$this->DataAC->insert();
		}
	}

	public function edit($bagian)
	{
		if ($bagian=="pc") {
			$this->DataPC->edit();
		} else if ($bagian=="ac") {
			$this->DataAC->edit();
		}
	}

	public function hapus($bagian, $id)
	{
		if ($bagian=="pc") {
			$this->DataPC->delete($id);
		} else if ($bagian=="ac") {
			$this->DataAC->delete($id);
		}
	}
}

/* End of file checklist.php */
/* Location: ./application/controllers/checklist.php */