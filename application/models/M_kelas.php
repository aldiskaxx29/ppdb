<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kelas extends CI_Model
{

    private $table = 'tb_kelas';

    public function index()
    {
        return $this->db->get($this->table)->result();
    }

    public function getWhere($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function getKelasX()
    {
        return $this->db->get_where($this->table, ['grade' => 'X'])->result();
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

/* End of file M_kelas.php */
