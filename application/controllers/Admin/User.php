<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user', 'user');
        $this->load->model('M_kelas', 'kelas');
        $this->load->model('M_jurusan', 'jurusan');
        not_auth_check();
    }

    // List all your items
    public function index()
    {
        $data = [
            'title'     => 'User',
            'user'      => $this->user->index(),
            'kelas'     => $this->kelas->index(),
            'jurusan'   => $this->jurusan->index(),
            'view'      => 'admin/user/index'
        ];
        $this->load->view('template_admin/app.php', $data);
    }

    // Detail about your item
    public function detail($id)
    {
        $data = [
            'title' => 'Detail User',
            'user'  => $this->user->detail($id),
            'view'  => 'admin/user/detail'
        ];
        $this->load->view('template_admin/app', $data);
    }

    // api edit
    public function edit($id)
    {
        $user = $this->user->edit($id);
        if ($user->role_id == 2) {
            $user = $this->user->detail($id);
        }
        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'view'  => 'admin/user/edit'
        ];
        $this->load->view('template_admin/app', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama User', 'trim|required', [
            'required'  => '%s Harus Diisi'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tb_user.email]', [
            'required'  => '%s Harus Diisi',
            'is_unique' => '%s Sudah Ada'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required'  => '%s Harus Diisi'
        ]);
        $this->form_validation->set_rules('role_id', 'Role User', 'trim|required', [
            'required'  => '%s Harus Diisi'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'trim|required', [
            'required'  => '%s Harus Diisi'
        ]);

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->user->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect(site_url('admin/user'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/user'), 'refresh');
        }
    }

    //Update one item
    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama User', 'trim|required', [
            'required'  => 'Nama User Harus Diisi'
        ]);

        if ($this->form_validation->run()) {
            $user = $this->user->edit($this->input->post('id'));
            $data = $this->input->post();
            unset($data['id']);
            if (empty($this->input->post('email')) || $this->input->post('email') == $user->email) {
                unset($data['email']);
            }
            if (empty($this->input->post('password'))) {
                unset($data['password']);
            } else {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->user->update($this->input->post('id'), $data);
            $this->session->set_flashdata('success', 'Data berhasil diedit');
            redirect(site_url('admin/user'), 'refresh');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect(site_url('admin/user'), 'refresh');
        }
    }

    //Delete one item
    public function delete($id)
    {
        $this->user->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect(site_url('admin/user'), 'refresh');
    }
}

/* End of file User.php */
