<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_admin($_SESSION['role_id']);
        $this->load->model('M_pembayaran', 'pembayaran');
        $this->load->model('M_kelas', 'kelas');
    }

    public function index()
    {
        $data = [];
        $params = [
            'kelas_id'  => null,
            'bulan'   => null
        ];
        $total = 0;
        if (isset($_GET)) {
            if (isset($_GET['kelas_id'])) {
                $params['kelas_id'] = $_GET['kelas_id'];
            }
            if (isset($_GET['bulan'])) {
                $params['bulan'] = $_GET['bulan'];
            }
            $laporan = $this->pembayaran->laporan($params);
            foreach ($laporan as $item) {
                if (intval($item->konfirm) == 1) {
                    $total = $total + intval($item->jumlah);
                }
            }
            $data = [
                'title'     => 'Laporan Pembayaran',
                'laporan'   => $laporan,
                'params'    => $params,
                'total'     => $total,
                'kelas'     => $this->kelas->index(),
                'view'      => 'admin/laporan_pembayaran/index'
            ];
        } else {
            $laporan = $this->pembayaran->laporan($params);
            foreach ($laporan as $item) {
                $total = $total + intval($item->jumlah);
            }
            $data = [
                'title'     => 'Laporan Pembayaran',
                'laporan'   => $laporan,
                'params'    => $params,
                'total'     => $total,
                'kelas'     => $this->kelas->index(),
                'view'      => 'admin/laporan_pembayaran/index'
            ];
        }
        $this->load->view('template_admin/app.php', $data);
    }

    public function cetakPdf()
    {
        $this->load->library('pdfgenerator');
        $data = [];
        $params = [
            'kelas_id'  => null,
            'bulan'   => null
        ];
        $total = 0;
        $file_pdf = null;
        if ($this->input->post('kelas_id') != null) {
            $params['kelas_id'] = $this->input->post('kelas_id');
            $kelas = $this->kelas->edit($this->input->post('kelas_id'));
            $data['title_pdf'] = 'Laporan Pembayaran ' . $kelas->grade . ' ' . $kelas->nama_kelas;
            $file_pdf = 'Laporan Pembayaran ' . $kelas->grade . ' ' . $kelas->nama_kelas;
        } else {
            $file_pdf = 'Laporan Pembayaran';
            $data['title_pdf'] = 'Laporan Pembayaran';
        }
        if ($this->input->post('bulan') != null) {
            $params['bulan'] = $this->input->post('bulan');
        }
        $laporan = $this->pembayaran->laporan($params);
        foreach ($laporan as $item) {
            if (intval($item->konfirm) == 1) {
                $total = $total + intval($item->jumlah);
            }
        }
        $data['total'] = $total;
        $data['laporan'] = $laporan;
        $paper = 'A4';
        $orientation = "portrait";

        $html = $this->load->view('admin/laporan_pembayaran/cetak_pdf', $data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

/* End of file LaporanPembayaran.php */
