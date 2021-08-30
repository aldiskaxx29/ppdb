<?php

class Biodata extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		not_auth_check();
		$this->load->model('m_orang_tua', 'orang_tua');
		$this->load->model('m_jurusan', 'jurusan');
	}

	public function index()
	{
		$data['user'] = $this->m_user->byEmailDaftar();
		$data['jurusan'] = $this->jurusan->index();
		$data['title'] = 'Biodata Siswa';
		$data['view'] = 'pendaftaran/biodata/index';
		$this->load->view('pendaftaran/template/app', $data);
	}

	public function dataSiswa()
	{
		if (isset($_POST['id'])) {
			$nama 	= $this->input->post('nama');
			$nisn 	= $this->input->post('nisn');
			$tempat = $this->input->post('tempat_lahir');
			$tgl 	= $this->input->post('tanggal_lahir');
			$jk 	= $this->input->post('jk');
			$agama 	= $this->input->post('agama');
			$no_hp 	= $this->input->post('no_telpon');
			$alamat = $this->input->post('alamat');
			$data = [
				'nama' 			=> $nama,
				'nisn' 			=> $nisn,
				'jenis_kelamin' => $jk,
				'tempat_lahir' 	=> $tempat,
				'tanggal_lahir' => $tgl,
				'agama' 		=> $agama,
				'no_telpon' 	=> $no_hp,
				'alamat' 		=> $alamat,
			];
			$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
			$this->session->set_flashdata('success', 'Update Data Calon Siswa Berhasil');
			redirect(site_url('pendaftaran/biodata'), 'refresh');
		}
	}

	public function dataOrtu()
	{
		if (isset($_POST['user_id'])) {
			if (empty($this->orang_tua->byUserId($this->input->post('user_id')))) {
				$this->orang_tua->insert($this->input->post());
				$dataGet = $this->orang_tua->byUserId($this->input->post('user_id'));
				$this->m_user->update($this->input->post('user_id'), ['orang_tua_id' => $dataGet->id]);
			} else {
				$this->orang_tua->update($this->input->post('user_id'), $this->input->post());
			}
			$this->session->set_flashdata('success', 'Update Data Orang Tua Berhasil');
			redirect(site_url('pendaftaran/biodata'), 'refresh');
		}
	}

	public function uploadIjazah()
	{
		if (isset($_FILES["upload_ijazah"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["upload_ijazah"]['name'];
			$config['upload_path'] = './assets/img/ijazah/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_ijazah')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$data = [
					'upload_ijazah' => $this->upload->data('file_name')
				];
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload Ijazah Berhasil');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Upload Ijazah Harus Di Isi');
		redirect(site_url('pendaftaran/biodata'), 'refresh');
	}

	public function uploadSkhun()
	{
		if (isset($_FILES["upload_skhun"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["upload_skhun"]['name'];
			$config['upload_path'] = './assets/img/skhun/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_skhun')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$data = [
					'upload_skhun' => $this->upload->data('file_name')
				];
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload SKHUN Berhasil');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Upload SKHUN Harus Di Isi');
		redirect(site_url('pendaftaran/biodata'), 'refresh');
	}

	public function uploadKK()
	{
		if (isset($_FILES["upload_kk"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["upload_kk"]['name'];
			$config['upload_path'] = './assets/img/kk/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_kk')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$data = [
					'upload_kk' => $this->upload->data('file_name')
				];
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload Kartu Keluarga Berhasil');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Upload Kartu Keluarga Harus Di Isi');
		redirect(site_url('pendaftaran/biodata'), 'refresh');
	}

	public function uploadAkte()
	{
		if (isset($_FILES["upload_akte"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["upload_akte"]['name'];
			$config['upload_path'] = './assets/img/akte/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_akte')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$data = [
					'upload_akte' => $this->upload->data('file_name')
				];
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload Akte Berhasil');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Upload Akte Kelahiran Harus Di Isi');
		redirect(site_url('pendaftaran/biodata'), 'refresh');
	}

	public function uploadKTP()
	{
		if (isset($_FILES["upload_ktp_ortu"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["upload_ktp_ortu"]['name'];
			$config['upload_path'] = './assets/img/ktp_ortu/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_ktp_ortu')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$data = [
					'upload_ktp_ortu' => $this->upload->data('file_name')
				];
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload KTP Berhasil');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Upload KTP Orang Tua Harus Di Isi');
		redirect(site_url('pendaftaran/biodata'), 'refresh');
	}
}
