<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('admin');
        }

        $config = [
            [
                'field' => 'email',
                'label' => 'Username / Email',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ];
        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/frontend/header');
            $this->load->view('auth/login');
            $this->load->view('template/frontend/footer');
        } else {
            $this->_loginAdmin();
        }
    }


    private function _loginAdmin()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));
        // $row = $this->db->get_where('user', ['email' => $email])->row_array();
        $row = $this->db->select('*')
            ->from('user')
            ->where('email', $email)
            ->or_where('name', $email)
            ->get()->row_array();
        if (!empty($row)) {
            // Active user > 1 ?
            if ($row['is_active'] == 1) {
                $password_verify = password_verify($password, $row['password']);
                if ($password_verify) {
                    $sesi_user = [
                        'id' => $row['id_user'],
                        'id_role' => $row['role_id'],
                        'is_logged_in' => true
                    ];
                    $this->session->set_userdata($sesi_user);
                    if ($row['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('message_error', 'Password salah!');
                    redirect('/login');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Akun di nonaktifkan!');
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Username / Email tidak terdaftar');
            redirect('/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('is_logged_in');
        $this->session->set_flashdata('message_success', 'Akun berhasil dikeluarkan');
        redirect('/login');
    }


    public function blocked()
    {
        $data['title'] = 'Blocked';
        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('template/backend/footer');
    }
}
