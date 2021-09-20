<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_admin($_SESSION['role_id']);
        date_default_timezone_set('Asia/Jakarta');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = [
            'title'     => 'Konfigurasi',
            'config'    => $this->m_config->index(),
            'view'      => 'admin/config/index'
        ];

        $this->load->view('template_admin/app.php', $data);
    }

    //Update one item
    public function update()
    {
        if (isset($_FILES["logo_sekolah"]['name'])) {
            $config['file_name'] = date('YmdHis') . $_FILES["logo_sekolah"]['name'];
            $config['upload_path'] = './assets/img/config/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG|svg|SVG';
            $config['max_size']  = '2048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('logo_sekolah')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect(site_url('admin/config'), 'refresh');
            } else {
                $user = $this->m_user->byEmail($this->session->userdata('email'));
                $dataUp = [
                    'nama_sekolah'      => $this->input->post('nama_sekolah'),
                    'logo_sekolah'      => $this->upload->data('file_name'),
                    'buka_pendaftaran'  => $this->input->post('buka_pendaftaran'),
                    'tutup_pendaftaran'    => $this->input->post('tutup_pendaftaran'),
                    'tahun_ajaran'      => $this->input->post('tahun_ajaran')
                ];
                $this->m_config->update($dataUp);
                $this->session->set_flashdata('success', 'Data berhasil diedit');
                redirect(site_url('admin/config'), 'refresh');
            }
        } else {
            $this->m_config->update($this->input->post());
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/config'), 'refresh');
        }
    }
}

/* End of file Config.php */
