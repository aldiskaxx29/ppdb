<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_kepsek($_SESSION['role_id']);
    }

    public function index()
    {
        $data = [];
        if (isset($_GET['tahun'])) {
            $laporan = $this->m_pendaftaran->laporan($_GET['tahun']);
            $data = [
                'title'     => 'Laporan Pendaftaran',
                'laporan'   => $laporan,
                'tahun'     => $_GET['tahun'],
                'view'      => 'kepsek/laporan_pendaftaran/index'
            ];
        } else {
            $laporan = $this->m_pendaftaran->laporan();
            $data = [
                'title'     => 'Laporan Pendaftaran',
                'laporan'   => $laporan,
                'tahun'     => 0,
                'view'      => 'kepsek/laporan_pendaftaran/index'
            ];
        }
        $this->load->view('template_kepsek/app.php', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pendaftaran',
            'user'  => $this->m_user->detail($id),
            'view'  => 'kepsek/laporan_pendaftaran/detail'
        ];
        $this->load->view('template_kepsek/app', $data);
    }

    public function cetakPdf($tahun = null)
    {
        $this->load->library('pdfgenerator');
        if ($tahun === null) {
            $laporan = $this->m_pendaftaran->laporan();
        } else {
            $laporan = $this->m_pendaftaran->laporan($tahun);
        }
        $data['laporan'] = $laporan;
        $data['title_pdf'] = 'Laporan Pendaftaran';
        $file_pdf = 'Laporan Pendaftaran';
        $paper = 'A4';
        $orientation = "portrait";

        $html = $this->load->view('kepsek/laporan_pendaftaran/cetak_pdf', $data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

/* End of file LaporanPendaftaran.php */
