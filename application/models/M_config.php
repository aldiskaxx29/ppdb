<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_config extends CI_Model
{

    private $table = 'tb_config';

    public function index()
    {
        return $this->db->get($this->table)->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function edit($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($data)
    {
        $this->db->update($this->table, $data, ['id' => 1]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}

/* End of file M_config.php */
