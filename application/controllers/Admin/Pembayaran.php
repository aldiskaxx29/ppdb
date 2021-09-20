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
        $this->load->model('m_user', 'user');
        $this->load->model('m_jenis_pembayaran', 'jenis');
        $this->load->model('m_tagihan','tagihan');
    }

    public function index()
    {
        $data = [
            'title'         => 'Konfirmasi Pembayaran',
            'pembayaran'    => $this->pembayaran->index(),
            'view'          => 'admin/pembayaran/index',
            'jenis'         => $this->jenis->index(),
            'user'          => $this->user->index_role(),
            'tagihan'       => $this->tagihan->index(),
        ];
        // var_dump($data['user']);die;
        $this->load->view('template_admin/app.php', $data);
    }

    public function tambah(){
        // $ad = $this->input->post();
        // var_dump($ad);die;
        $nama = $this->input->post('nama');
        $tagihan = $this->input->post('tagihan');
        $jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $jumlah_bayar = $this->input->post('jumlah_bayar');
        $bukti_pembayaran = $_FILES['bukti']['name'];
        // var_dump($bukti_pembayaran);die;
        if ($bukti_pembayaran) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/bukti_pembayaran/';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('bukti')) {
                    echo "Upload Gagal";die;

                }
                else{
                    $image = $this->upload->data('file_name');
                }
            }

        $data = [
            'user_id' => $nama,
            'tagihan_id' => $tagihan,
            'jenis_pembayaran_id' => $jenis_pembayaran,
            'jumlah'    => $jumlah_bayar,
            'foto_bukti' => $image,
            'konfirm' => 1,
        ];
        // var_dump($data);die;
        $this->pembayaran->insert($data);
        $this->session->set_flashdata('success','Data Berhasil Di Tambahakan');
        redirect(site_url('admin/pembayaran'), 'refresh');
    }

    public function hapus($id){
        $where = ['id' => $id];
        $gambar = $this->db->get_where('tb_pembayaran', $where)->row_array();   
        // var_dump($gambar['foto_bukti']);die;
        unlink(FCPATH . 'assets/img/bukti_pembayaran/' .$gambar['foto_bukti']);
        $this->pembayaran->delete($id);
        $this->session->set_flashdata('success','Data Berhasil Di Hapus');
        redirect(site_url('admin/pembayaran'), 'refresh');
        // $this->jurusan->delete($id);
        // $this->session->set_flashdata('success', 'Data berhasil dihapus');
        // redirect(site_url('admin/jurusan'), 'refresh');
    }

    public function detail($id){
        $where = ['id' => $id];
        $detail = $this->pembayaran->detail($id);
        var_dump($detail);die;
    }

    public function update(){
        // var_dump($this->input->post());die;
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $tagihan = $this->input->post('tagihan');
        $jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $jumlah_bayar = $this->input->post('jumlah_bayar');

        $image = $this->db->get_where('tb_pembayaran',['id' => $id])->row_array();
        // var_dump($image['foto_bukti']);die;
        $gambar = $_FILES['bukti']['name'];
        if ($gambar) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/bukti_pembayaran/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('bukti')) {
                $old_gambar = $image['foto_bukti'];
                if ($old_gambar) {
                    unlink(FCPATH . 'assets/img/bukti_pembayaran/' . $old_gambar);
                }

                $new = $this->upload->data('file_name');
                $this->db->set('foto_bukti', $new);
                
            }
            else{
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'user_id' => $nama,
            'tagihan_id' => $tagihan,
            'jenis_pembayaran_id' => $jenis_pembayaran,
            'jumlah'    => $jumlah_bayar,
        ];

        // $where = ['id' => $id];
        // var_dump($data);die;
        $this->pembayaran->update($id,$data);
        $this->session->set_flashdata('success','Data Berhasil Di Ubah');
        redirect(site_url('Admin/Pembayaran'), 'refresh');
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
