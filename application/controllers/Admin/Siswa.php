<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
        check_page_admin($_SESSION['role_id']);
        $this->load->model('M_user', 'user');
        $this->load->model('M_kelas', 'kelas');
        $this->load->model('M_jurusan', 'jurusan');
        $this->load->model('M_siswa', 'siswa');
        $this->load->model('m_orang_tua', 'orang_tua');
    }

    // List all your items
    public function index()
    {
        $data = [
            'title'     => 'Siswa',
            'user'      => $this->user->siswa(),
            'kelas'     => $this->kelas->index(),
            'jurusan'   => $this->jurusan->index(),
            'view'      => 'admin/siswa/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Add a new item
    public function add()
    {
        $data = [
            'title'     => 'Siswa',
            'kelas'     => $this->kelas->index(),
            'jurusan'   => $this->jurusan->index(),
            'view'      => 'admin/siswa/add'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    public function insert()
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
            $nama     = $this->input->post('nama');
            $nisn     = $this->input->post('nisn');
            $tempat = $this->input->post('tempat_lahir');
            $tgl     = $this->input->post('tanggal_lahir');
            $jk     = $this->input->post('jk');
            $agama     = $this->input->post('agama');
            $no_hp     = $this->input->post('no_telpon');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
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
                'status'           => 1
            ];
            $this->m_pendaftaran->insert($pendaftaran);
            $daftar = $this->m_pendaftaran->register($pendaftaran);
            $user = [
                'pendaftaran_id'    => $daftar->id,
                'jurusan_id'        => $this->input->post('jurusan_id'),
                'siswa_id'          => 0,
                'orang_tua_id'      => 0,
                'kelas_id'          => $this->input->post('kelas_id'),
                'nama'              => $nama,
                'email'             => $email,
                'password'          => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'           => 3,
                'status'            => 1
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
            $this->session->set_flashdata('success', 'Data Berhasil Di Tambahkan');
            redirect(site_url('admin/siswa'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/siswa/add'), 'refresh');
        }
    }

    public function edit($id)
    {
        $data = [
            'title'     => 'Edit Siswa',
            'id'        => $id,
            'kelas'     => $this->kelas->index(),
            'jurusan'   => $this->jurusan->index(),
            'user'      => $this->m_user->editSiswa($id),
            'view'      => 'admin/siswa/edit'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    public function uploadBerkas($id)
    {
        $data = [
            'title'     => 'Siswa Upload Berkas',
            'user'      => $this->m_user->bySiswaId($id),
            'view'      => 'admin/siswa/upload_berkas'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_message([
            'required'       => '%s Harus Diisi',
            'valid_email'    => 'Yang Anda Masukan Bukan email'
        ]);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('no_telpon', 'No Telepon', 'required|trim|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run()) {
            $user_id = $this->input->post('user_id');
            $user = $this->m_user->edit($user_id);
            $nama     = $this->input->post('nama');
            $nisn     = $this->input->post('nisn');
            $tempat = $this->input->post('tempat_lahir');
            $tgl     = $this->input->post('tanggal_lahir');
            $jk     = $this->input->post('jk');
            $agama     = $this->input->post('agama');
            $no_hp     = $this->input->post('no_telpon');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $pendaftaran = [
                'nama'             => $nama,
                'nisn'             => $nisn,
                'jenis_kelamin'    => $jk,
                'tempat_lahir'     => $tempat,
                'tanggal_lahir'    => $tgl,
                'agama'            => $agama,
                'no_telpon'        => $no_hp,
                'alamat'           => $alamat,
            ];
            $this->m_pendaftaran->update(['id' => $user->pendaftaran_id], $pendaftaran);
            $user = [
                'jurusan_id'        => $this->input->post('jurusan_id'),
                'kelas_id'          => $this->input->post('kelas_id'),
                'nama'              => $nama,
                'email'             => $email
            ];
            $this->m_user->update($user_id, $user);
            $dataSiswa = [
                'tanggal_diterima' => date('Y-m-d'),
                'tahun_masuk'      => strval(date('Y')),
                'tahun_keluar'     => null,
            ];
            $this->siswa->update(['user_id' => $user_id], $dataSiswa);
            $dataOrtu = [
                'nama_ortu'     => $this->input->post('nama_ortu'),
                'pendidikan'    => $this->input->post('pendidikan'),
                'pekerjaan'     => $this->input->post('pekerjaan')
            ];
            $this->orang_tua->update($user_id, $dataOrtu);
            $this->session->set_flashdata('success', 'Data Berhasil Di Edit');
            redirect(site_url('admin/siswa'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/siswa/edit/' . $this->input->post('user_id')), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $user = $this->m_user->selectUser($id);
        $this->m_user->delete($id);
        $this->m_pendaftaran->delete($user->pendaftaran_id);
        $this->siswa->deleteByUser($id);
        $this->orang_tua->deleteByUser($id);
        $this->session->set_flashdata('success', 'Data Berhasil Di Hapus');
        redirect(site_url('admin/siswa'), 'refresh');
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
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            } else {
                $data = [
                    'upload_ijazah' => $this->upload->data('file_name')
                ];
                $this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
                $this->session->set_flashdata('success', 'Upload Ijazah Berhasil');
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Upload Ijazah Harus Di Isi');
        redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
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
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            } else {
                $data = [
                    'upload_skhun' => $this->upload->data('file_name')
                ];
                $this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
                $this->session->set_flashdata('success', 'Upload SKHUN Berhasil');
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Upload SKHUN Harus Di Isi');
        redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
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
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            } else {
                $data = [
                    'upload_kk' => $this->upload->data('file_name')
                ];
                $this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
                $this->session->set_flashdata('success', 'Upload Kartu Keluarga Berhasil');
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Upload Kartu Keluarga Harus Di Isi');
        redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
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
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            } else {
                $data = [
                    'upload_akte' => $this->upload->data('file_name')
                ];
                $this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
                $this->session->set_flashdata('success', 'Upload Akte Berhasil');
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Upload Akte Kelahiran Harus Di Isi');
        redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
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
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            } else {
                $data = [
                    'upload_ktp_ortu' => $this->upload->data('file_name')
                ];
                $this->m_pendaftaran->update(['id' => $this->input->post('id')], $data);
                $this->session->set_flashdata('success', 'Upload KTP Berhasil');
                redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Upload KTP Orang Tua Harus Di Isi');
        redirect(site_url('admin/siswa/uploadBerkas/'.$this->input->post('user_id')), 'refresh');
    }

    public function naikanKelas()
    {
        $siswa = $this->m_user->getSiswaUser();
        foreach ($siswa as $item) {
            $kelas = $this->kelas->edit($item->kelas_id);
            switch ($kelas->grade) {
                case 'X':
                    $naikKelas = $this->kelas->getWhere(['grade' => 'XI', 'nama_kelas' => $kelas->nama_kelas]);
                    $this->m_user->update($item->id, ['kelas_id' => $naikKelas->id]);
                    break;
                case 'XI':
                    $naikKelas = $this->kelas->getWhere(['grade' => 'XII', 'nama_kelas' => $kelas->nama_kelas]);
                    $this->m_user->update($item->id, ['kelas_id' => $naikKelas->id]);
                    break;
                case 'XII':
                    $naikKelas = $this->kelas->getWhere(['grade' => 'XII', 'nama_kelas' => $kelas->nama_kelas]);
                    $this->m_user->update($item->id, ['kelas_id' => 0]);
                    $this->siswa->update(['user_id' => $item->id], ['tahun_keluar' => date('Y')]);
                    break;
            }
        }
        $this->session->set_flashdata('success', 'Menaikan Kelas Seluruh Siswa Berhasil');
        redirect(site_url('admin/siswa'), 'refresh');
    }
}

/* End of file Siswa.php */
