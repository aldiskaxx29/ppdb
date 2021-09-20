<?php

class M_pendaftaran extends CI_Model
{
	private $table = 'tb_pendaftaran';

	public function tampil_user()
	{
		return $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function get($table)
	{
		return $this->db->get($table)->result();
	}

	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where)->row_array();
	}

	public function laporan($tahun = null)
	{
		if ($tahun) {
			$this->db->where("EXTRACT(YEAR FROM created) = " . $tahun);
		}
		return $this->db->get($this->table)->result();
	}

	public function update($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->table, $data);
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function register($where)
	{
		return $this->db->get_where($this->table, $where)->row();
	}

	public function check_bayar()
	{
		$this->db->select('tb_user.*, tb_pendaftaran.bukti_pembayaran, tb_pendaftaran.status_bukti_bayar');
		$this->db->join('tb_pendaftaran', 'tb_pendaftaran.id = tb_user.pendaftaran_id', 'left');
		return $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
	}

	public function delete($id)
	{
		$this->db->delete($this->table, ['id' => $id]);
	}

	// public function join_pendaftaran(){
	// 	$this->db->select('*');
	// 	$this->db->from('tb_user');
	// 	$this->db->join('tb_pendaftaran','tb_pendaftaran.id_pendaftaran = tb_user.id_pendaftaran');
	// 	$this->db->where('id_pendaftaran');
	// 	$query = $this->db->get();
	// 	return $query->row_array();
	// }
}
