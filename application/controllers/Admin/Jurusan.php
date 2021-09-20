<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_admin($_SESSION['role_id']);
        $this->load->model('M_jurusan', 'jurusan');
    }

    // List all your items
    public function index()
    {
        $data = [
            'title' => 'Jurusan',
            'jurusan' => $this->jurusan->index(),
            'view'  => 'admin/jurusan/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'trim|required|is_unique[tb_jurusan.nama_jurusan]', [
            'required'  => 'Nama Jurusan Harus Diisi',
            'is_unique' => 'Nama Jurusan Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->jurusan->insert($this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect(site_url('admin/jurusan'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/jurusan'), 'refresh');
        }
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'trim|required', [
            'required'  => 'Nama Jurusan Harus Diisi',
            'is_unique' => 'Nama Jurusan Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->jurusan->update($this->input->post('id'), $this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/jurusan'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/jurusan'), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $this->jurusan->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect(site_url('admin/jurusan'), 'refresh');
    }
}

/* End of file Jurusan.php */
