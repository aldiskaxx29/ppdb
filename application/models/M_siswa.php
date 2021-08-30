<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
{

    private $table = 'tb_siswa';

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function detail($user_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->row();
    }
}

/* End of file M_siswa.php */
