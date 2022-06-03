<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminUserAccount_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);
        if (!$this->session->userdata('id') || !$this->session->userdata('id_role')) {
            redirect('login');
        } elseif ($this->session->userdata('id_role') == 2) {
            show_404();
        }
    }

    public function index() // User account 
    {
        $data['title'] = 'User Account';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->user->get_user();
        $data['role'] = $this->db->select('user_role.role_name, user_role.role_id')->from('user_role')->get()->result_array();

        $config = [
            [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]

            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak benar!',
                    'is_unique' => '{field} sudah terdaftar'
                ]

            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]

            ],
        ];

        $this->form_validation->set_rules($config);
        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/user_account', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->new_account();
        }
    }

    private function new_account()
    {
        $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        $data = [
            'id_user'       => $id,
            'name'          => $this->input->post('name', true),
            'nim'           => $this->input->post('nim', true),
            'email'         => $this->input->post('email', true),
            'password'      => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            'role_id'       => $this->input->post('role_id', true),
            'is_active'     => $this->input->post('is_active', true),
            'image'         => 'default.svg',
            'date_created'  => time(),
        ];

        if ($this->user->insert($data)) {
            $this->session->set_flashdata('message_success', 'Berhasil menambahkan akun baru');
            redirect('admin/user_account');
        }
    }

    public function update_account($id)
    {
        $row = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (!$row['id_user'] || !$id) {
            show_404();
        } else {
            $data = [
                'name'          => $this->input->post('name', true),
                'email'         => $this->input->post('email', true),
                'role_id'       => $this->input->post('role_id', true),
                'is_active'     => $this->input->post('is_active', true),
            ];

            if ($this->user->update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Data akun di perbarui');
                redirect('admin/user_account');
            }
        }
    }

    public function delete_account($id)
    {
        $row = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (!$row['id_user'] || !$id) {
            show_404();
        } else {
            $delete_user = $this->user->delete($id);
            if ($delete_user) {
                $this->session->set_flashdata('message_success', 'Data akun dihapus');
                redirect('admin/user_account');
            }
        }
    }
}
