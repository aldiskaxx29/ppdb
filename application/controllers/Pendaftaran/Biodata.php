<?php

class Biodata extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_orang_tua', 'orang_tua');
		$this->load->model('m_jurusan', 'jurusan');
		$this->load->model('m_tagihan', 'tagihan');
		$this->load->model('m_siswa', 'siswa');
		$this->load->model('m_pembayaran', 'pembayaran');
	}

	public function index()
	{
		$config = $this->m_config->index();
		$data['tagihan'] = $this->tagihan->getByGrade('X', $config->tahun_ajaran, 1)[0];
		if ($this->session->userdata('daftar') == "true") {
			$data['user'] = $this->m_user->byEmailDaftarSiswa($this->session->userdata('email_user'));
		} else {
			$data['user'] = null;
		}
		$data['jurusan'] = $this->jurusan->index();
		$data['title'] = 'Biodata Siswa';
		$data['view'] = 'pendaftaran/biodata/index';
		$this->load->view('pendaftaran/template/app', $data);
	}

	public function dataSiswa()
	{
		$this->form_validation->set_message([
			'required'        => '%s Harus Diisi',
			'is_unique'     => '%s Sudah Ada',
			'min_length'    => '%s Harus Lebih dari 6 karakter',
			'valid_email'    => 'Yang Anda Masukan Bukan email'
		]);
		$this->form_validation->set_rules('tempat_lahir', 'Tempat', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required|trim');
		$this->form_validation->set_rules('no_telpon', 'No Telepon', 'required|trim|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[konfir_password]');
		$this->form_validation->set_rules('konfir_password', 'Konfirmasi Password', 'required|trim|min_length[6]|matches[password]');

		if ($this->form_validation->run()) {
			$nama     	= $this->input->post('nama');
			$nisn     	= $this->input->post('nisn');
			$tempat 	= $this->input->post('tempat_lahir');
			$tgl     	= $this->input->post('tanggal_lahir');
			$jk     	= $this->input->post('jk');
			$agama    	= $this->input->post('agama');
			$no_hp     	= $this->input->post('no_telpon');
			$alamat 	= $this->input->post('alamat');
			$email 		= $this->input->post('email');
			$upload_ijazah 	= $_FILES['upload_ijazah']['name'];
			$upload_skhun 	= $_FILES['upload_skhun']['name'];
			$upload_kk 		= $_FILES['upload_kk']['name'];
			$upload_akte 	= $_FILES['upload_akte']['name'];
			$upload_ktp_ortu = $_FILES['upload_ktp_ortu']['name'];
			// var_dump($upload_ijazah, $upload_skhun);die;




			// tambahan file upload aldi
			if ($upload_ijazah) {
				$config['file_name'] = date('YmdHis') . $upload_ijazah;
				$config['upload_path'] = './assets/img/ijazah/';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size']  = '2048';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_ijazah')) {
					echo 'Upload Ijazah Gagal';
				} else {
					$new_ijazah = $this->upload->data('file_name');
					// $this->db->set('upload_ijazah', $new_ijazah);
				}
			}

			if ($upload_skhun) {
				$config['file_name'] = date('YmdHis') . $upload_skhun;
				$config['upload_path'] = './assets/img/skhun/';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size']  = '2048';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_skhun')) {
					echo 'Upload Skhun Gagal';
				} else {
					$new_skhun = $this->upload->data('file_name');
					// $this->db->set('upload_skhun', $new_skhun);
				}
			}

			if ($upload_kk) {
				$config['file_name'] = date('YmdHis') . $upload_kk;
				$config['upload_path'] = './assets/img/kk/';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size']  = '2048';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_kk')) {
					echo 'Upload KK Gagal';
				} else {
					$new_kk = $this->upload->data('file_name');
					$this->db->set('upload_kk', $new_kk);
				}
			}

			if ($upload_akte) {
				$config['file_name'] = date('YmdHis') . $upload_akte;
				$config['upload_path'] = './assets/img/akte/';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size']  = '2048';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_akte')) {
					echo 'Upload Akte Gagal';
				} else {
					$new_akte = $this->upload->data('file_name');
					$this->db->set('upload_akte', $new_akte);
				}
			}
			if ($upload_ktp_ortu) {
				$config['file_name'] = date('YmdHis') . $upload_ktp_ortu;
				$config['upload_path'] = './assets/img/ktp_ortu/';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size']  = '2048';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_ktp_ortu')) {
					echo 'Upload Ktp Ortu Gagal';
				} else {
					$new_ktp_ortu = $this->upload->data('file_name');
					$this->db->set('upload_ktp_ortu', $new_ktp_ortu);
				}
			}
// var_dump($new_ijazah, $new_skhun);die;


			$pendaftaran = [
				'nama'             => $nama,
				'nisn'             => $nisn,
				'jenis_kelamin'    => $jk,
				'tempat_lahir'     => $tempat,
				'tanggal_lahir'    => $tgl,
				'agama'            => $agama,
				'no_telpon'        => $no_hp,
				'alamat'           => $alamat,
				'kode_siswa'       => strtoupper(random_string('alnum', 10)),
				'status'           => 0,
				// 'upload_ijazah'	   => $new_ijazah,
				// 'upload_skhun'	   => $new_skhun,
				// 'upload_kk'		   => $new_kk,
				// 'upload_akte'	   => $new_akte,
				// 'upload_ktp_ortu'  => $new_ktp_ortu,
			];
			// var_dump($pendaftaran);die;
			$this->m_pendaftaran->insert($pendaftaran);
			$daftar = $this->m_pendaftaran->register($pendaftaran);
			$user = [
				'pendaftaran_id'    => $daftar->id,
				'jurusan_id'        => $this->input->post('jurusan_id'),
				'siswa_id'          => 0,
				'orang_tua_id'      => 0,
				'kelas_id'          => 0,
				'nama'              => $nama,
				'email'             => $email,
				'password'          => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id'           => 2,
				'status'            => 0
			];
			$this->m_user->insert($user);
			$userGet = $this->m_user->byEmail($email);
			$dataSiswa = [
				'tanggal_diterima' => date('Y-m-d'),
				'tahun_masuk'      => strval(date('Y')),
				'tahun_keluar'     => null,
				'user_id'          => $userGet->id
			];
			$this->siswa->insert($dataSiswa);
			$siswaGet = $this->siswa->getWhere($dataSiswa);
			$this->m_user->update($userGet->id, ['siswa_id' => $siswaGet->id]);
			$dataOrtu = [
				'nama_ortu'     => $this->input->post('nama_ortu'),
				'pendidikan'    => $this->input->post('pendidikan'),
				'pekerjaan'     => $this->input->post('pekerjaan'),
				'user_id'       => $userGet->id
			];
			$this->orang_tua->insert($dataOrtu);
			$ortuGet = $this->orang_tua->byUserId($userGet->id);
			$this->m_user->update($userGet->id, ['orang_tua_id' => $ortuGet->id]);

			$array = array(
				'user_id'		=> $userGet->id,
				'email_user'	=> $userGet->email,
				'daftar'  		=> 'true'
			);

			$this->session->set_userdata($array);

			$this->session->set_flashdata('success', 'Data Berhasil Di Tambahkan');
			// redirect(site_url('pendaftaran/biodata'), 'refresh');
			redirect(site_url('pendaftaran/pengumuman/lulus'), 'refresh');
		} else {
			$this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
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

	public function uploadPembayaran()
	{
		if (isset($_FILES["bukti_pembayaran"]['name'])) {
			$config['file_name'] = date('YmdHis') . $_FILES["bukti_pembayaran"]['name'];
			$config['upload_path'] = './assets/img/bukti_pendaftaran/';
			$config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
			$config['max_size']  = '2048';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('bukti_pembayaran')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			} else {
				$dataUp = [
					'user_id'               => $this->input->post('user_id'),
					'jenis_pembayaran_id'   => 1,
					'tagihan_id'            => $this->input->post('tagihan_id'),
					'foto_bukti'            => $this->upload->data('file_name'),
					'jumlah'                => $this->input->post('jumlah')
				];
				$data = [
					'bukti_pembayaran' 		=> $this->upload->data('file_name'),
					'status_bukti_bayar'	=> 1
				];
				$this->pembayaran->insert($dataUp);
				$this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
				$this->session->set_flashdata('success', 'Upload Bukti Pembayaran Berhasil Silahkan Menunggu Konfirmas dari Admin');
				$register = $this->m_pendaftaran->get_where(['id' => $this->input->post('id')], 'tb_pendaftaran');
				$this->session->set_flashdata('kode_siswa', $register['kode_siswa']);

				$this->session->unset_userdata('daftar');
				$this->session->unset_userdata('email_user');
				redirect(site_url('pendaftaran/biodata'), 'refresh');
			}
		}
	}

	private function checkKelengkapanBiodata()
	{
		$user = $this->m_user->checkBiodataEmail($this->session->userdata('user_email'));
		if (in_array(null, $user) || in_array("", $user)) {
			return true;
		} else {
			return false;
		}
	}
}
