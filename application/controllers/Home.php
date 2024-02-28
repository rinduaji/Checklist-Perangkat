<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

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
	}

	public function index()
	{
		$this->load->view('Home/viewHome');
	}

	public function homeIT()
	{
		$this->load->view('Home/viewHomeIT');
	}

	public function homeTL()
	{
		$this->load->view('Home/viewHomeTL');
	}

	public function homeME()
	{
		$this->load->view('Home/viewHomeME');
	}

	public function homeSecurity()
	{
		$this->load->view('Home/viewHomeSecurity');
	}

	public function homeOB()
	{
		$this->load->view('Home/viewHomeOB');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */