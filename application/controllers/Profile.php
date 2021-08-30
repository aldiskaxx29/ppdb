<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_auth_check();
    }

    // List all your items
    public function index($id)
    {
        $data = [
            'title' => 'Profile',
			'id'    => $id,
            'user' 	=> $this->m_user->byEmail($this->session->userdata('email')),
            'view'  => 'profile/index'
        ];
		$template = null;
		if($_GET['type'] == md5('admin')) {
			$template = 'template_admin/app';
		} else if($_GET['type'] == md5('siswa')) {
			$template = 'template_siswa/app';
		} else if($_GET['type'] == md5('calon_siswa')) {
			$template = 'pendaftaran/template/app';
		} else {
			$template = 'template_kepsek/app';
		}
        $this->load->view($template, $data);
    }

    //Update one item
    public function update()
    {
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'is_unique[tb_user.email]', [
            'is_unique' => 'Nama %s Sudah Ada'
        ]);

        if ($this->form_validation->run()) {
			if( empty($this->input->post('email')) ) {
				$data = ['nama' => $this->input->post('nama')];
			} else {
				$data = ['nama' => $this->input->post('nama'), 'email' => $this->input->post('email')];
			}
            $this->m_user->update($this->input->post('id'), $data);
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('profile/index/'.$this->input->post('id')), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('profile/index/'.$this->input->post('id')), 'refresh');
        }
    }
}

/* End of file Profile.php */
