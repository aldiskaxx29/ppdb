<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_kepsek($_SESSION['role_id']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('template_kepsek/header', $data);
        $this->load->view('template_kepsek/sidebar');
        $this->load->view('template_kepsek/topbar');
        $this->load->view('kepsek/dashboard', $data);
        $this->load->view('template_kepsek/footer');
    }
}
