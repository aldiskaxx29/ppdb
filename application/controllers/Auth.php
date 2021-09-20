<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_jurusan', 'jurusan');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		auth_check();
		$data['title'] = 'Login';
		$data['checkPendaftaran'] = $this->checkPendaftaran();
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required'	=> '%s Harus Diisi!',
			'valid_email' => 'Yang Anda Masukan Bukan Email!'

		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required'	=> '%s Harus Diisi!',
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('template_auth/header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('template_auth/footer');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
			if ($user) {
				if (password_verify($password, $user['password'])) {
					if ($user['status'] == 1) {
						$data = [
							'email' => $user['email'],
							'role_id' => $user['role_id']
						];
						$this->session->set_userdata($data);

						redirect_role($user['role_id']);
					} else {
						$this->session->set_flashdata('error', 'Akun Belum Di ACtivasi Oleh Admin Silahkan Hubungi Admin');
						redirect(site_url('auth'));
					}
				} else {
					$this->session->set_flashdata('error', 'Password Salah');
					redirect(site_url('auth'));
				}
			} else {
				$this->session->set_flashdata('error', 'Email Belum terdaftar');
				redirect(site_url('auth'));
			}
		}
	}


	public function registrasi()
	{
		auth_check();
		$checkPendaftaran = $this->checkPendaftaran();
		if ($checkPendaftaran == false) {
			redirect(site_url('auth'));
		}
		$this->form_validation->set_message([
			'required'		=> '%s Harus Diisi',
			'is_unique' 	=> '%s Sudah Ada',
			'min_length'	=> '%s Harus Lebih dari 6 karakter',
			'valid_email'	=> 'Yang Anda Masukan Bukan email'
		]);
		$this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'No Telepon', 'required|trim|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[konfir_password]');
		$this->form_validation->set_rules('konfir_password', 'Konfirmasi Password', 'required|trim|min_length[6]|matches[password]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Pendaftaran Siswa';
			$data['view'] = 'auth/registrasi';
			$data['jurusan'] = $this->jurusan->index();
			$this->load->view('template_auth/auth', $data);
		} else {
			$nama 	= $this->input->post('nama');
			$tempat = $this->input->post('tempat');
			$tgl 	= $this->input->post('tgl');
			$jk 	= $this->input->post('jk');
			$agama 	= $this->input->post('agama');
			$no_hp 	= $this->input->post('no_hp');
			$alamat = $this->input->post('alamat');

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$data = [
				'nama' 			=> $nama,
				'jenis_kelamin' => $jk,
				'tempat_lahir' 	=> $tempat,
				'tanggal_lahir' => $tgl,
				'agama' 		=> $agama,
				'no_telpon' 	=> $no_hp,
				'alamat' 		=> $alamat,
				'kode_siswa'	=> strtoupper(random_string('alnum', 10)),
				'status' 		=> 0
			];

			$this->m_pendaftaran->insert($data);
			unset($data['kode_siswa']);
			$register = $this->m_pendaftaran->register($data);
			$user = [
				'pendaftaran_id' => $register->id,
				'jurusan_id' => $this->input->post('jurusan_id'),
				'nama' => $nama,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role_id' => 2,
				'status' => 0
			];
			$this->m_user->insert($user);
			$this->session->set_flashdata('kode_siswa', $register->kode_siswa);
			redirect('auth');
		}
	}

	public function reset()
	{
		if (isset($_SESSION['email_reset'])) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[konfirm_password]');
			$this->form_validation->set_rules('konfirm_password', 'Konfirmasi Password', 'trim|required|min_length[6]|matches[password]');

			if ($this->form_validation->run()) {
				$email = $this->session->userdata('email');
				$dataUp = ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)];
				$this->m_user->updateByEmail($email, $dataUp);
				$this->session->unset_userdata('email_reset');
				$this->session->set_flashdata('success', 'Reset Password Berhasil');
				redirect(site_url('auth'), 'refresh');
			} else {
				$data['title'] = 'Reset Password';
				$this->load->view('template_auth/header', $data);
				$this->load->view('auth/reset');
				$this->load->view('template_auth/footer');
			}
		} else {
			redirect(site_url('auth'), 'refresh');
		}
	}

	public function show_reset()
	{
		$data['title'] = 'Reset Password';
		$this->load->view('template_auth/header', $data);
		$this->load->view('auth/show_reset');
		$this->load->view('template_auth/footer');
	}

	public function checkReset()
	{
		$email = $this->input->post('email');
		$user = $this->m_user->byEmail($email);
		if ($user) {
			$array = array(
				'email_reset' => $email
			);
			$this->session->set_userdata($array);
			redirect(site_url('auth/reset'), 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Email tidak tersedia');
			redirect(site_url('auth/show_reset'), 'refresh');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		redirect('auth');
	}

	public function checkPendaftaran()
	{
		$config = $this->m_config->index();
		if (!empty($config->buka_pendaftaran) && !empty($config->tutup_pendaftaran)) {
			if (strtotime(strval($config->buka_pendaftaran)) < time()) {
				if (strtotime(strval($config->tutup_pendaftaran)) > time()) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
