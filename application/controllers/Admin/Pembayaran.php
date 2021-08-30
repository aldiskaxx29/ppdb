<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        $this->load->model('m_pembayaran', 'pembayaran');
        $this->load->model('m_siswa', 'siswa');
        $this->load->model('m_kelas', 'kelas');
    }

    public function index()
    {
        $data = [
            'title'         => 'Konfirmasi Pembayaran',
            'pembayaran'    => $this->pembayaran->index(),
            'view'          => 'admin/pembayaran/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    public function konfirm($id)
    {
        $bayar = $this->pembayaran->detail($id);
        $user = $this->m_user->byId($bayar->user_id);
        if ($this->pembayaran->detail($id)->jenis_pembayaran_id == 1) {
            $this->m_user->update($bayar->user_id, ['kelas_id' => $this->input->post('kelas_id'), 'role_id' => 3]);
            $data = [
                'tanggal_diterima' => date('Y-m-d'),
                'tahun_masuk'      => strval(date('Y')),
                'tahun_keluar'     => null,
                'user_id'          => $bayar->user_id
            ];
            $this->siswa->insert($data);
            $siswa = $this->siswa->detail($bayar->user_id);
            $this->m_user->update($bayar->user_id, ['siswa_id' => $siswa->id]);
        }
        $this->pembayaran->update($id, ['konfirm' => 1]);
        $this->m_pendaftaran->update($user->pendaftaran_id, ['status_bukti_bayar' => 1]);
        $this->session->set_flashdata('success', 'Konfirmasi Pembayaran Berhasil');
        redirect(site_url('admin/pembayaran'), 'refresh');
    }
}

/* End of file Pembayaran.php */
