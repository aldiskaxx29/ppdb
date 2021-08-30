<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenispembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_jenis_pembayaran', 'jenis_pembayaran');
        not_auth_check();
    }

    // List all your items
    public function index()
    {
        $data = [
            'title' => 'Jenis Pembayaran',
            'jenis_pembayaran' => $this->jenis_pembayaran->index(),
            'view'  => 'admin/jenis_pembayaran/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('jenis', 'Jenis Pembayaran', 'trim|required', [
            'required'  => 'Jenis Pembayaran Harus Diisi',
            'is_unique' => 'Jenis Pembayaran Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->jenis_pembayaran->insert($this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect(site_url('admin/jenispembayaran'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/jenispembayaran'), 'refresh');
        }
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_rules('jenis', 'Jenis Pembayaran', 'trim|required|is_unique[tb_jenis_pembayaran.jenis]', [
            'required'  => 'Jenis Pembayaran Harus Diisi',
            'is_unique' => 'Jenis Pembayaran Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->jenis_pembayaran->update($this->input->post('id'), $this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/jenispembayaran'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/jenispembayaran'), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $this->jenis_pembayaran->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect(site_url('admin/jenispembayaran'), 'refresh');
    }
}

/* End of file Jenispembayaran.php */
