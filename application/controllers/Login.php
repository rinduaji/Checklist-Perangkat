<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DataLogin');
		if ($this->uri->segment(2)) {
			return;
		}
		if ($this->session->userdata('masuk')) {
			$this->session->set_flashdata('dahLogin', 'Anda Sudah Login, klik logout untuk keluar');
			redirect('home');
		}
	}

	public function index()
	{
		
		if ($this->input->post('login')) {
			// if ($this->DataLogin->getLogin()) {
			// 	$flashArray = array(
			// 		'pesan' => 'Login Berhasil',
			// 		'status'=> TRUE
			// 	);
			// 	$this->session->set_flashdata($flashArray);
			// 	$array = array(
			// 		'masuk' => TRUE
			// 	);				
			// 	$this->session->set_userdata( $array );
			// 	redirect('home');
			// } else {
			// 	$flashArray = array(
			// 		'pesan' => 'Username dan Password Salah',
			// 		'status'=> FALSE
			// 	);
			// 	$this->session->set_flashdata($flashArray);
			// }
			if ($this->DataLogin->getLogin() == 'Admin') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'Admin',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home');
			} else if ($this->DataLogin->getLogin() == 'IT') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'IT',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home/homeIT');
			} else if ($this->DataLogin->getLogin() == 'ME') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'ME',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home/homeME');
			} else if ($this->DataLogin->getLogin() == 'Team Leader') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'Team Leader',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home/homeTL');
			} else if ($this->DataLogin->getLogin() == 'Security') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'Security',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home/homeSecurity');
			} else if ($this->DataLogin->getLogin() == 'OB' || $this->DataLogin->getLogin() == 'Team Leader OB') {
				$flashArray = array(
					'pesan' => 'Login Berhasil',
					'status' => TRUE
				);
				$this->session->set_flashdata($flashArray);
				$array = array(
					'jabatan' => 'OB',
					'masuk' => TRUE,
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata($array);
				redirect('home/homeOB');
			} else {
				$flashArray = array(
					'pesan' => 'Username dan Password Salah',
					'status' => FALSE
				);
				$this->session->set_flashdata($flashArray);
			}
		}
		$this->load->view('Login/halamanLogin');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */