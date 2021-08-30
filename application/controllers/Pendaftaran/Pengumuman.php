<?php

class Pengumuman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		not_auth_check();
		$this->load->model('m_pembayaran', 'pembayaran');
	}

	public function index()
	{
		$check = $this->checkKelengkapanBiodata();
		$user = $this->m_user->byEmail($this->session->userdata('email'));
		$data = [
			'title'	=> 'Pengumuman',
			'check' => $check,
			'user'	=> $user,
			'view' 	=> 'pendaftaran/pengumuman'
		];
		$this->load->view('pendaftaran/template/app', $data);
	}

	private function checkKelengkapanBiodata()
	{
		$user = $this->m_user->checkBiodata();
		if (in_array(null, $user) || in_array("", $user)) {
			return true;
		} else {
			return false;
		}
	}
}
