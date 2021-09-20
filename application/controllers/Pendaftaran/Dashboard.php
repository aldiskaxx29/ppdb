<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->load->view('pendaftaran/template/header', $data);
		$this->load->view('pendaftaran/template/sidebar');
		$this->load->view('pendaftaran/template/topbar', $data);
		$this->load->view('pendaftaran/calon_siswa/Dashboard', $data);
		$this->load->view('pendaftaran/template/footer');
	}
}
