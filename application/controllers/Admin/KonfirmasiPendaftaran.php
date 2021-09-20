<?php

class KonfirmasiPendaftaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		not_auth_check();
		check_page_admin($_SESSION['role_id']);
		$this->load->model('m_kelas', 'kelas');
		$this->load->model('m_siswa', 'siswa');
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Konfirmasi Pendaftaran',
			'c_siswa' 	=> $this->m_user->cs_siswa(),
			'kelas'         => $this->kelas->getKelasX(),
			'view'  	=> 'admin/konfirmasipendaftaran/index'
		];
		$this->load->view('template_admin/app.php', $data);
	}

	public function detail($id)
	{
		$data = [
			'title' => 'Detail User',
			'user'  => $this->user->detail($id),
			'view'  => 'admin/konfirmasipendaftaran/detail'
		];
		$this->load->view('template_admin/app', $data);
	}

	public function active_user()
	{
		$id = $this->input->post('user_id');
		$data = [
			'tanggal_diterima' => date('Y-m-d'),
			'tahun_masuk'      => strval(date('Y')),
			'tahun_keluar'     => null,
			'user_id'          => $id
		];
		$this->siswa->insert($data);
		$siswa = $this->siswa->detail($id);
		$this->m_user->update($id, ['siswa_id' => $siswa->id, 'kelas_id' => $this->input->post('kelas_id'), 'status' => 1, 'role_id' => 3]);
		$this->session->set_flashdata('success', 'Konfirmasi User Berhasil');
		redirect(site_url('admin/konfirmasipendaftaran'), 'refresh');
	}
}
