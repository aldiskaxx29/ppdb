<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

    private $table = 'tb_user';

    public function index()
    {
        return $this->db->get($this->table)->result();
    }

    public function siswa()
    {
        $this->db->select('tb_user.*, tb_siswa.tanggal_diterima, tb_siswa.tahun_masuk, tb_siswa.tahun_keluar, tb_user.orang_tua_id, tb_user.email, tb_orang_tua.nama_ortu, tb_orang_tua.pendidikan, tb_orang_tua.pekerjaan, tb_jurusan.nama_jurusan');
        $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.kelas_id', 'left');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.id = tb_user.orang_tua_id', 'left');
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_user.siswa_id', 'left');
        return $this->db->get_where($this->table, ['role_id' => 3])->result();
    }

    public function cs_siswa()
    {
        $this->db->select('tb_user.*, tb_jurusan.nama_jurusan');
        $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.jurusan_id', 'left');
        return $this->db->get_where($this->table, ['role_id' => 2, 'status' => 0])->result();
    }

    public function checkKode()
    {
        $this->db->select('tb_user.id as user_id, tb_user.email, tb_pendaftaran.*');
        $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
        return $this->db->get_where($this->table, ['email' => $this->session->userdata('email')])->row();
    }

    public function byEmail($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function byEmailKelas()
    {
        $this->db->select('tb_user.*, tb_kelas.grade');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_user.kelas_id', 'left');
        return $this->db->get_where($this->table, ['email' => $this->session->userdata('email')])->row();
    }

    public function byId($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function byEmailDaftar()
    {
        $user = $this->byEmail($this->session->userdata('email'));
        if ($user->orang_tua_id == 0) {
            $this->db->select('tb_user.id as user_id, tb_user.jurusan_id, tb_user.email, tb_pendaftaran.*, tb_jurusan.nama_jurusan');
            $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
            $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.jurusan_id', 'left');
        } else {
            $this->db->select('tb_user.id as user_id, tb_user.jurusan_id, tb_user.email, tb_pendaftaran.*, tb_orang_tua.nama_ortu, tb_orang_tua.pendidikan, tb_orang_tua.pekerjaan, tb_jurusan.nama_jurusan');
            $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
            $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.jurusan_id', 'left');
            $this->db->join('tb_orang_tua', 'tb_orang_tua.id = tb_user.orang_tua_id', 'left');
        }
        return $this->db->get_where($this->table, ['email' => $this->session->userdata('email')])->row();
    }

    public function checkBiodata()
    {
        $this->db->select('tb_user.id, tb_user.email, tb_pendaftaran.nisn, tb_pendaftaran.nama, tb_pendaftaran.jenis_kelamin, tb_pendaftaran.tempat_lahir, tb_pendaftaran.tanggal_lahir, tb_pendaftaran.agama, tb_pendaftaran.alamat, tb_pendaftaran.no_telpon, tb_pendaftaran.upload_ijazah, tb_pendaftaran.upload_skhun, tb_pendaftaran.upload_kk, tb_pendaftaran.upload_akte, tb_pendaftaran.upload_ktp_ortu, tb_orang_tua.nama_ortu, tb_orang_tua.pendidikan, tb_orang_tua.pekerjaan, tb_jurusan.nama_jurusan');
        $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.jurusan_id', 'left');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.id = tb_user.orang_tua_id', 'left');
        return $this->db->get_where($this->table, ['email' => $this->session->userdata('email')])->row_array();
    }

    public function detail($id)
    {
        $this->db->select('tb_user.id as id_user, tb_siswa.tanggal_diterima, tb_siswa.tahun_masuk, tb_siswa.tahun_keluar, tb_user.orang_tua_id, tb_user.email, tb_pendaftaran.*, tb_orang_tua.nama_ortu, tb_orang_tua.pendidikan, tb_orang_tua.pekerjaan, tb_jurusan.nama_jurusan');
        $this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id = tb_user.kelas_id', 'left');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.id = tb_user.orang_tua_id', 'left');
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_user.siswa_id', 'left');
        return $this->db->get_where($this->table, ['tb_user.id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function edit($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function updateByEmail($email, $data)
    {
        $this->db->update($this->table, $data, ['email' => $email]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function login($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }
}

/* End of file M_user.php */
