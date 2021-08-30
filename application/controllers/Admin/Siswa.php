<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user', 'user');
        $this->load->model('M_kelas', 'kelas');
        $this->load->model('M_jurusan', 'jurusan');
        not_auth_check();
    }

    // List all your items
    public function index()
    {
        $data = [
            'title'     => 'User',
            'user'      => $this->user->siswa(),
            'kelas'     => $this->kelas->index(),
            'jurusan'   => $this->jurusan->index(),
            'view'      => 'admin/siswa/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
    }

    //Update one item
    public function update($id)
    {
    }

    //Delete one item
    public function delete($id)
    {
    }
}

/* End of file Siswa.php */
