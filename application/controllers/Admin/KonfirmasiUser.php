<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KonfirmasiUser extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
	}

	public function index()
	{
		$data['title'] = 'Konfirmasi Pendaftaran';
		$data['user'] = $this->M_pendaftaran->get('tb_user');
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/konfirmasiuser/index', $data);
		$this->load->view('template_admin/footer');
	}

	public function detail($id)
	{
		$data = [
			'title'	=> 'Detail User',
			'user' => $this->M_user->detail($id),
			'view'  => 'admin/konfirmasiuser/detail'
		];
		$this->load->view('template_admin/app', $data);
	}

	public function confirm()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$data = ['status' => $status];
		$where = ['id' => $id];
		$this->M_pendaftaran->update($where, $data, 'tb_user');
		$this->session->set_flashdata('confirm', '<div class="alert alert-success alert-dismissible fade show" role="alert">Status User Berhasil Di Ubah
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span></button></div>');
		redirect('Admin/KonfirmasiUser');
	}
}
