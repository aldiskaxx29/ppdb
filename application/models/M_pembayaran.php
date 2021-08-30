<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pembayaran extends CI_Model
{
    private $table = 'tb_pembayaran';

    public function index()
    {
        $this->db->select('tb_pembayaran.*, tb_user.nama, tb_jenis_pembayaran.jenis');
        $this->db->join('tb_user', 'tb_user.id = tb_pembayaran.user_id', 'left');
        $this->db->join('tb_jenis_pembayaran', 'tb_jenis_pembayaran.id = tb_pembayaran.jenis_pembayaran_id', 'left');
        $this->db->order_by('tb_pembayaran.konfirm', 'asc');
        return $this->db->get($this->table)->result();
    }

    public function getByUser()
    {
        $this->db->select('tb_pembayaran.*, tb_user.nama, tb_jenis_pembayaran.jenis');
        $this->db->join('tb_user', 'tb_user.id = tb_pembayaran.user_id', 'left');
        $this->db->join('tb_jenis_pembayaran', 'tb_jenis_pembayaran.id = tb_pembayaran.jenis_pembayaran_id', 'left');
        $this->db->order_by('tb_pembayaran.konfirm', 'asc');
        return $this->db->get_where($this->table, ['tb_user.email' => $this->session->userdata('email')])->result();
    }

    public function detail($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function checkBayar($user_id, $tagihan_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id, 'tagihan_id' => $tagihan_id])->row();
    }
}

/* End of file M_pembayaran.php */
