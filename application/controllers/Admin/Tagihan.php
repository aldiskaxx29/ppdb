<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tagihan', 'tagihan');
        $this->load->model('M_jenis_pembayaran', 'jenis_pembayaran');
        not_auth_check();
    }

    // List all your items
    public function index()
    {
        $data = [
            'title'     => 'Tagihan',
            'tagihan'   => $this->tagihan->index(),
            'jenis'     => $this->jenis_pembayaran->index(),
            'view'      => 'admin/tagihan/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('jumlah_tagihan', 'Jumlah Tagihan', 'trim|required', [
            'required'  => 'Nama Tagihan Harus Diisi'
        ]);
        $config = $this->m_config->index();
        $data = array_merge($this->input->post(), ['tahun_ajaran' => $config->tahun_ajaran]);

        if ($this->form_validation->run()) {
            $this->tagihan->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect(site_url('admin/tagihan'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/tagihan'), 'refresh');
        }
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_rules('nama_tagihan', 'Nama Tagihan', 'trim|required', [
            'required'  => 'Nama Tagihan Harus Diisi',
            'is_unique' => 'Nama Tagihan Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
            $this->tagihan->update($this->input->post('id'), $this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/tagihan'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/tagihan'), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $this->tagihan->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect(site_url('admin/tagihan'), 'refresh');
    }
}

/* End of file Tagihan.php */
