<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tagihan', 'tagihan');
        $this->load->model('m_pembayaran', 'pembayaran');
    }

    public function index()
    {
        $user = $this->m_user->byEmailKelas();
        $configApp = $this->m_config->index();
        $tagihan = $this->tagihan->getByGrade($user->grade, $configApp->tahun_ajaran);
        if (isset($_FILES["foto_bukti"]['name'])) {
            $config['file_name'] = date('YmdHis') . $_FILES["foto_bukti"]['name'];
            $config['upload_path'] = './assets/img/bukti_pendaftaran/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['max_size']  = '2048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_bukti')) {
                $error = $this->upload->display_errors();
                $data = [
                    'title'    => 'Pengumuman',
                    'bayar'    => $this->m_pendaftaran->check_bayar(),
                    'tagihan'  => $tagihan,
                    'view'     => 'siswa/pembayaran/index',
                    'error'    => $error
                ];
                $this->load->view('pendaftaran/template/app', $data);
            } else {
                $user = $this->m_user->byEmail($this->session->userdata('email'));
                $dataUp = [
                    'user_id'               => $user->id,
                    'jenis_pembayaran_id'   => $this->input->post('jenis_pembayaran_id'),
                    'tagihan_id'            => $this->input->post('tagihan_id'),
                    'foto_bukti'            => $this->upload->data('file_name'),
                    'jumlah'                => $this->input->post('jumlah')
                ];
                $this->pembayaran->insert($dataUp);
                $this->session->set_flashdata('success', 'Upload Bukti Pembayaran Berhasil');
                redirect(site_url('siswa/pembayaran'), 'refresh');
            }
        }
        $data = [
            'title'     => 'Pembayaran',
            'tagihan'   => $tagihan,
            'user'      => $user,
            'view'      => 'siswa/pembayaran/index'
        ];
        $this->load->view('template_siswa/app', $data);
    }

    public function cetakPdf()
    {
        $this->load->library('pdfgenerator');
        $config = $this->m_config->index();
        $data['user'] = $this->m_user->byEmailKelas();
        $data['tahun_ajaran'] = $config->tahun_ajaran;
        $data['title_pdf'] = 'Data Pembayaran Sekolah - ' . $data['user']->nama;
        $data['tagihan'] = $this->tagihan->getByGrade($data['user']->grade, $config->tahun_ajaran);
        $file_pdf = 'Data Pembayaran Sekolah - ' . $data['user']->nama;
        $paper = 'A4';
        $orientation = "portrait";

        $html = $this->load->view('siswa/pembayaran/cetak_pdf', $data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

/* End of file Pembayaran.php */
