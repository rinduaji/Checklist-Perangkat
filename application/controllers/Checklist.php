<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist extends CI_Controller
{
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
				'status' => FALSE
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
		$this->load->model('DataUPS');
		$this->load->model('DataRuangan');
		$this->load->model('DataCCTV');
		$this->load->model('DataApar');
		$this->load->model('DataLift');
		$this->load->model('DataGenset');
		$this->load->model('DataHydrant');
		$this->load->model('DataFap');
		$this->load->model('DataPenilaianVendor');
		$this->load->model('DataMeVendor');
		$this->load->model('DataKebersihan');
		// echo date('01-m-Y');

		// die();

	}

	public function index()
	{
		redirect('home');
	}

	public function pc_list($bulan = '', $tahun = '', $shift = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope' && $shift == 'nope') {
			$data = $this->DataPC->get('', '', '', $id);
		} else if ($bulan != '' && $tahun != '' && $shift != '') {
			$data = $this->DataPC->get($bulan, $tahun, $shift);
		} else {
			$data = $this->DataPC->get();
		}
		echo json_encode($data);
	}

	public function ac_list($bulan = '', $tahun = '', $id_ruangan = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope' && $id_ruangan == 'nope') {
			$data = $this->DataAC->get('', '', '', $id);
		} else if ($bulan != '' && $tahun != '' && $id_ruangan != '') {
			$data = $this->DataAC->get($bulan, $tahun, $id_ruangan);
		} else {
			$data = $this->DataAC->get();
		}
		echo json_encode($data);
	}

	public function ups_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataUPS->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataUPS->get($bulan, $tahun);
		} else {
			$data = $this->DataUPS->get();
		}
		echo json_encode($data);
	}

	public function apar_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataApar->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataApar->get($bulan, $tahun);
		} else {
			$data = $this->DataApar->get();
		}
		echo json_encode($data);
	}

	public function lift_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataLift->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataLift->get($bulan, $tahun);
		} else {
			$data = $this->DataLift->get();
		}
		echo json_encode($data);
	}


	public function genset_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataGenset->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataGenset->get($bulan, $tahun);
		} else {
			$data = $this->DataGenset->get();
		}
		echo json_encode($data);
	}

	public function hydrant_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataHydrant->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataHydrant->get($bulan, $tahun);
		} else {
			$data = $this->DataHydrant->get();
		}
		echo json_encode($data);
	}

	public function fap_list($bulan = '', $tahun = '', $id = '')
	{
		if ($bulan == 'nope' && $tahun == 'nope') {
			$data = $this->DataFap->get('', '', $id);
		} else if ($bulan != '' && $tahun != '') {
			$data = $this->DataFap->get($bulan, $tahun);
		} else {
			$data = $this->DataFap->get();
		}
		echo json_encode($data);
	}

	public function penilaian_vendor_list($tahun = '', $id = '')
	{
		if ($tahun == 'nope') {
			$data = $this->DataPenilaianVendor->get($tahun, $id);
		} else if ($tahun != '') {
			$data = $this->DataPenilaianVendor->get($tahun);
		} else {
			$data = $this->DataPenilaianVendor->get();
		}
		echo json_encode($data);
	}

	public function me_vendor_list($tahun = '', $id = '')
	{
		if ($tahun == 'nope') {
			$data = $this->DataMeVendor->get($tahun, $id);
		} else if ($tahun != '') {
			$data = $this->DataMeVendor->get($tahun);
		} else {
			$data = $this->DataMeVendor->get();
		}
		echo json_encode($data);
	}

	public function ruangan_list($lantai = '', $bagian = '')
	{
		if ($lantai != '' && $bagian != '') {
			$data = $this->DataRuangan->get($lantai, $bagian);
		} else {
			$data = $this->DataRuangan->get();
		}
		echo json_encode($data);
	}

	// public function cctv_list($bulan = '', $tahun = '', $shift = '')
	// {
	// 	// if ($bulan != '' && $tahun != '' && $shift != '') {
	// 	// 	$data = $this->DataCCTV->get($bulan,$tahun,$shift);
	// 	// } else {
	// 	// 	$data = array(
	// 	// 		'pesan' => 'Error : expected parameter cctv_list(bulan/tahun/shift)',
	// 	// 		'status' => FALSE
	// 	// 	);
	// 	// }
	// 	$data2 = array();
	// 	$data1 = $this->DataCCTV->get($bulan,$tahun,$shift);
	// 	foreach ($data1 as $d1) {
	// 		$data2[] = $this->DataCCTV->getChecklist($d1->id_cctv);
	// 	}
	// 	$data = array(
	// 		'data1' => $data1,
	// 		'data2' => $data2
	// 	);
	// 	// $data = $this->DataCCTV->getBulan(1);
	// 	echo json_encode($data);
	// }

	// public function cctv_checklist($id_cctv)
	// {
	// 	if ($id_cctv != '') {
	// 		$data = $this->DataCCTV->getChecklist($id_cctv);
	// 	} else {
	// 		$data = array(
	// 			'pesan' => 'Error',
	// 			'status' => FALSE
	// 		);
	// 	}
	// 	// $data = $this->DataCCTV->getBulan(1);
	// 	echo json_encode($data);
	// }

	public function cctv_list($bulan = '', $tahun = '', $shift = '', $id = '')
	{
		if ($id != '') {
			$data = $this->DataCCTV->getCCTV('', '', '', $id);
		} else if ($bulan != '' && $tahun != '' && $shift != '') {
			$data = $this->DataCCTV->getCCTV($bulan, $tahun, $shift);
		} else {
			$data = array(
				'pesan' => 'Error : expected parameter cctv_list(bulan/tahun/shift/id(optional))',
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function kebersihan_list($bulan = '', $tahun = '', $jam = '', $id = '')
	{
		if ($id != '') {
			$data = $this->DataKebersihan->getKebersihan('', '', '', $id);
		} else if ($bulan != '' && $tahun != '' && $jam != '') {
			$data = $this->DataKebersihan->getKebersihan($bulan, $tahun, $jam);
		} else {
			$data = array(
				'pesan' => 'Error : expected parameter cctv_list(bulan/tahun/jam/id(optional))',
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function pc()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/pc', $data);
	}

	public function pcIT()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/pcIT', $data);
	}

	public function pcTL()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/pcTL', $data);
	}

	public function ac()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['ruangan'] = $this->DataRuangan->get('', 'ac');
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

	public function cctv()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['ruangan'] = $this->DataRuangan->get('', 'cctv');
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/cctv', $data);
	}

	public function apar()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/apar', $data);
	}

	public function lift()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/lift', $data);
	}

	public function genset()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/genset', $data);
	}

	public function hydrant()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/hydrant', $data);
	}

	public function fap()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/fap', $data);
	}

	public function penilaian_vendor()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/penilaian_vendor', $data);
	}

	public function me_vendor()
	{
		$data['petugas'] = $this->DataPetugas->get();
		$data['nama_tl'] = $this->DataPetugas->get_tl();
		$data['nama_it'] = $this->DataPetugas->get_it();
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/me_vendor', $data);
	}

	public function kebersihan()
	{
		$data['list_insfected'] = $this->DataPetugas->getInsfected();
		$data['list_tl_spv'] = $this->DataPetugas->getTlSpvKebersihan();
		$data['list_nama_user'] = $this->DataPetugas->getNamaUserKebersihan();
		$data['ruangan'] = $this->DataRuangan->get('', 'kebersihan');
		$data['lantai_ops'] = $this->DataRuangan->getLantaiOps('', 'kebersihan');
		$data['bulan'] = $this->bulan;
		$data['tahun'] = $this->tahun;
		$this->load->view('checklist/kebersihan', $data);
	}

	// public function coba()
	// {
	// 	$data['petugas'] = $this->DataPetugas->get();
	// 	$data['ruangan'] = $this->DataRuangan->get('','cctv');
	// 	$data['bulan'] = $this->bulan;
	// 	$data['tahun'] = $this->tahun;
	// 	$this->load->view('checklist/coba', $data);
	// }

	public function tambah($bagian)
	{
		if ($bagian == "pc") {
			$this->DataPC->insert();
		} else if ($bagian == "ac") {
			$this->DataAC->insert();
		} else if ($bagian == "ups") {
			$this->DataUPS->insert();
		} else if ($bagian == "cctv") {
			$this->DataCCTV->insert();
		} else if ($bagian == "apar") {
			$this->DataApar->insert();
		} else if ($bagian == "lift") {
			$this->DataLift->insert();
		} else if ($bagian == "genset") {
			$this->DataGenset->insert();
		} else if ($bagian == "hydrant") {
			$this->DataHydrant->insert();
		} else if ($bagian == "fap") {
			$this->DataFap->insert();
		} else if ($bagian == "penilaian_vendor") {
			$this->DataPenilaianVendor->insert();
		} else if ($bagian == "me_vendor") {
			$this->DataMeVendor->insert();
		} else if ($bagian == "kebersihan") {
			$this->DataKebersihan->insert();
		}
	}

	public function edit($bagian)
	{
		if ($bagian == "pc") {
			$this->DataPC->edit();
		} else if ($bagian == "ac") {
			$this->DataAC->edit();
		} else if ($bagian == "ups") {
			$this->DataUPS->edit();
		} else if ($bagian == "cctv") {
			$this->DataCCTV->edit();
		} else if ($bagian == "apar") {
			$this->DataApar->edit();
		} else if ($bagian == "lift") {
			$this->DataLift->edit();
		} else if ($bagian == "genset") {
			$this->DataGenset->edit();
		} else if ($bagian == "hydrant") {
			$this->DataHydrant->edit();
		} else if ($bagian == "fap") {
			$this->DataFap->edit();
		} else if ($bagian == "penilaian_vendor") {
			$this->DataPenilaianVendor->edit();
		} else if ($bagian == "me_vendor") {
			$this->DataMeVendor->edit();
		} else if ($bagian == "kebersihan") {
			$this->DataKebersihan->edit();
		}
		
	}

	public function hapus($bagian, $id)
	{
		if ($bagian == "pc") {
			$this->DataPC->delete($id);
		} else if ($bagian == "ac") {
			$this->DataAC->delete($id);
		} else if ($bagian == "ups") {
			$this->DataUPS->delete($id);
		} else if ($bagian == "apar") {
			$this->DataApar->delete($id);
		} else if ($bagian == "lift") {
			$this->DataLift->delete($id);
		} else if ($bagian == "genset") {
			$this->DataGenset->delete($id);
		} else if ($bagian == "hydrant") {
			$this->DataHydrant->delete($id);
		} else if ($bagian == "fap") {
			$this->DataFap->delete($id);
		} else if ($bagian == "penilaian_vendor") {
			$this->DataPenilaianVendor->delete($id);
		} else if ($bagian == "me_vendor") {
			$this->DataMeVendor->delete($id);
		} else if ($bagian == "kebersihan") {
			$this->DataKebersihan->delete($id);
		}
	}
}

/* End of file checklist.php */
/* Location: ./application/controllers/checklist.php */