<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_auth_check();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('template_siswa/header', $data);
        $this->load->view('template_siswa/sidebar');
        $this->load->view('template_siswa/topbar');
        $this->load->view('admin/Dashboard', $data);
        $this->load->view('template_siswa/footer');
    }
}
