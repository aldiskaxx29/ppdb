<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kelas', 'kelas');
        not_auth_check();
    }

    // List all your items
    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'kelas' => $this->kelas->index(),
            'view'  => 'admin/kelas/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required', [
            'required'  => 'Nama Kelas Harus Diisi',
            'is_unique' => 'Nama Kelas Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->kelas->insert($this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect(site_url('admin/kelas'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/kelas'), 'refresh');
        }
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required', [
            'required'  => 'Nama Kelas Harus Diisi',
            'is_unique' => 'Nama Kelas Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->kelas->update($this->input->post('id'), $this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/kelas'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/kelas'), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $this->kelas->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect(site_url('admin/kelas'), 'refresh');
    }
}

/* End of file Kelas.php */
