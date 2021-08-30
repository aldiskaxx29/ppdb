<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        $this->load->model('m_pembayaran', 'pembayaran');
        $this->load->model('m_tagihan', 'tagihan');
        $this->load->model('m_jenis_pembayaran', 'jenis_pembayaran');
    }

    public function index()
    {
        $config = $this->m_config->index();
        $tagihan = $this->tagihan->getByGrade('X', $config->tahun_ajaran, 1)[0];
        if (isset($_FILES["bukti_pembayaran"]['name'])) {
            $config['file_name'] = date('YmdHis') . $_FILES["bukti_pembayaran"]['name'];
            $config['upload_path'] = './assets/img/bukti_pendaftaran/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['max_size']  = '2048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('bukti_pembayaran')) {
                $error = $this->upload->display_errors();
                $data = [
                    'title'    => 'Pengumuman',
                    'bayar'    => $this->m_pendaftaran->check_bayar(),
                    'tagihan'  => $tagihan,
                    'view'     => 'pendaftaran/pembayaran/index',
                    'error'    => $error
                ];
                $this->load->view('pendaftaran/template/app', $data);
            } else {
                $user = $this->m_user->byEmail($this->session->userdata('email'));
                $dataUp = [
                    'user_id'               => $user->id,
                    'jenis_pembayaran_id'   => 1,
                    'tagihan_id'            => $this->input->post('tagihan_id'),
                    'foto_bukti'            => $this->upload->data('file_name'),
                    'jumlah'                => $this->input->post('jumlah')
                ];
                $dataU = [
                    'bukti_pembayaran'        => $this->upload->data('file_name')
                ];
                $this->pembayaran->insert($dataUp);
                $this->m_pendaftaran->update(['id' => $user->pendaftaran_id], $dataU);
                $this->session->set_flashdata('success', 'Upload Bukti Pembayaran Berhasil');
                redirect(site_url('pendaftaran/pengumuman'), 'refresh');
            }
        }
        $data = [
            'title'             => 'Pembayaran',
            'bayar'             => $this->m_pendaftaran->check_bayar(),
            'tagihan'            => $tagihan,
            'view'              => 'pendaftaran/pembayaran/index'
        ];
        $this->load->view('pendaftaran/template/app.php', $data);
    }
}

/* End of file Pembayaran.php */
