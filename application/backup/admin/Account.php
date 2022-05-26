<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);

        if (!$this->session->userdata('id') || !$this->session->userdata('remember_me') || !$this->session->userdata('role')) {
            redirect('/login');
        } elseif ($this->session->userdata('role') == 2) {
            redirect('users/dashboard');
        } elseif ($this->session->userdata('role') == 3) {
            redirect('dosen/dashboard');
        }
    }
    public function list()
    {

        $data['user'] = $this->db->get('user')->result_array();
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $config = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'valid_email' => '{field} tidak benar!'
                ]
            ],
            [
                'field' => 'name',
                'label' => 'Username',
                'rules' => 'trim'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],

        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_account', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }


    private function _insert()
    {
        $id_user = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 14);
        $data = [
            'id_user'   => $id_user,
            'name'      => htmlspecialchars($this->input->post('name', true)),
            'email'     => htmlspecialchars($this->input->post('email', true)),
            'password'  => htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT)),
            'role_id'   => htmlspecialchars($this->input->post('role_id', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
            'image'     => 'default.svg',
            'created_at' => time(),
            'updated_at' => time(),
        ];

        $data_saved = $this->db->insert('user', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data Account ditambahkan');
            redirect('admin/user-account');
        }
    }


    public function update($id)
    {
        $rows = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (empty($rows['id_user'] || !$id)) {
            show_404();
        } else {
            $data = [
                'name'      => htmlspecialchars($this->input->post('name', true)),
                'email'     => htmlspecialchars($this->input->post('email', true)),
                'role_id'   => htmlspecialchars($this->input->post('role_id', true)),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),
                'updated_at' => time(),
            ];

            $data_updated = $this->db->update('user', $data, ['id_user' => $id]);
            if ($data_updated) {
                $this->session->set_flashdata('message_success', 'Data Account diperbarui');
                redirect('admin/user-account');
            }
        }
    }

    public function delete($id)
    {
        $rows = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (empty($rows['id_user']) || !$id) {
            show_404();
        } else {
            $this->db->delete('user', ['id_user' => $id]);
            $this->session->set_flashdata('message_success', 'Data Account dihapus');
            redirect('admin/user-account');
        }
    }
}
