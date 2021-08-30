<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_orang_tua extends CI_Model
{

    private $table = 'tb_orang_tua';

    public function byUserId($userId)
    {
        return $this->db->get_where($this->table, ['user_id' => $userId])->row();
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
        $this->db->update($this->table, $data, ['user_id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}

/* End of file M_orang_tua.php */
