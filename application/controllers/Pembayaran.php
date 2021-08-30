<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        $this->load->model('m_pembayaran', 'pembayaran');
        $this->load->model('m_jenis_pembayaran', 'jenis_pembayaran');
    }

    public function index()
    {
        if (isset($_FILES["foto_bukti"]['name'])) {
            $dataCheck = $this->m_user->checkKode();
            if ($dataCheck->kode_siswa === $this->input->post('kode_siswa')) {
                $config['file_name'] = date('YmdHis') . $_FILES["foto_bukti"]['name'];
                $config['upload_path'] = './assets/img/bukti_pendaftaran/';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
                $config['max_size']  = '2048';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto_bukti')) {
                    $error = $this->upload->display_errors();
                    $data = [
                        'title'             => 'Pembayaran',
                        'pembayaran'        => $this->pembayaran->getByUser(),
                        'jenis_pembayaran'  => $this->jenis_pembayaran->index(),
                        'view'              => 'pembayaran/index',
                        'error'             => $error
                    ];
                    $this->load->view('pendaftaran/template/app', $data);
                } else {
                    $user = $this->m_user->byEmail($this->session->userdata('email'));
                    $dataUp = [
                        'user_id'                => $user->id,
                        'jenis_pembayaran_id'    => $this->input->post('jenis_pembayaran_id'),
                        'foto_bukti'             => $this->upload->data('file_name')
                    ];
                    $this->pembayaran->insert($dataUp);
                    $this->session->set_flashdata('success', 'Upload Bukti Pembayaran Berhasil');
                    redirect(site_url('pembayaran'), 'refresh');
                }
            } else {
                $error = 'Kode Pembayaran Siswa Salah!';
                $data = [
                    'title'             => 'Pembayaran',
                    'pembayaran'        => $this->pembayaran->getByUser(),
                    'jenis_pembayaran'  => $this->jenis_pembayaran->index(),
                    'view'              => 'pembayaran/index',
                    'error'             => $error
                ];
                $this->load->view('pendaftaran/template/app', $data);
            }
        }
        $data = [
            'title'             => 'Pembayaran',
            'pembayaran'        => $this->pembayaran->getByUser(),
            'jenis_pembayaran'  => $this->jenis_pembayaran->index(),
            'view'              => 'pembayaran/index'
        ];
        $this->load->view('pendaftaran/template/app.php', $data);
    }
}

/* End of file Pembayaran.php */
