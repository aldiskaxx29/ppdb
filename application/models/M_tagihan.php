<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_tagihan extends CI_Model
{

    private $table = 'tb_tagihan';

    public function index()
    {
        $this->db->select('tb_tagihan.*, tb_jenis_pembayaran.jenis');
        $this->db->join('tb_jenis_pembayaran', 'tb_jenis_pembayaran.id = tb_tagihan.jenis_pembayaran_id', 'left');
        return $this->db->get($this->table)->result();
    }

    public function getByGrade($grade, $tahun_ajaran, $jenis_pembayaran_id = null)
    {
        if ($jenis_pembayaran_id === null) {
            $where = ['grade_tagihan' => $grade, 'tahun_ajaran' => $tahun_ajaran];
        } else {
            $where = ['jenis_pembayaran_id' => $jenis_pembayaran_id, 'grade_tagihan' => $grade, 'tahun_ajaran' => $tahun_ajaran];
        }
        $this->db->select('tb_tagihan.*, tb_jenis_pembayaran.id as jenis_id, tb_jenis_pembayaran.jenis');
        $this->db->join('tb_jenis_pembayaran', 'tb_jenis_pembayaran.id = tb_tagihan.jenis_pembayaran_id', 'left');
        return $this->db->get_where($this->table, $where)->result();
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

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}

/* End of file M_tagihan.php */
