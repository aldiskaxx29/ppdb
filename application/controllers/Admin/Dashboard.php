<?php
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		not_auth_check();
		check_page_admin($_SESSION['role_id']);
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/Dashboard', $data);
		$this->load->view('template_admin/footer');
	}
}
