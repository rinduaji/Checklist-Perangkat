<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	}

	public function index()
	{
		$this->load->view('Home/viewHome');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */