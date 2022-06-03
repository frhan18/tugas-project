<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', true);
    }

    public function index()
    {
        if ($this->session->userdata('id') || $this->session->userdata('id_role') == 2) {
            redirect('users');
        }
        $config = [
            [
                'field' => 'nim',
                'label' => 'NIM ',
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
            // $this->_loginAdmin();
            $this->_appAccessMember();
        }
    }


    public function admin_page()
    {
        if ($this->session->userdata('id') || $this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 6) {
            redirect('dashboard');
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
            $this->load->view('auth/login_admin');
            $this->load->view('template/frontend/footer');
        } else {
            $this->_appAccess();
        }
    }


    private function _appAccess()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));
        $row = $this->user->access_app($email);
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
                        redirect('dashboard');
                    } elseif ($row['role_id'] == 6) {
                        redirect('dashboard');
                    } else {
                        show_404();
                    }
                } else {
                    $this->session->set_flashdata('message_error', 'Password salah!');
                    redirect('/app');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Akun di nonaktifkan!');
                redirect('/app');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Username / Email tidak terdaftar');
            redirect('/app');
        }
    }


    private function _appAccessMember()
    {
        $nim = htmlspecialchars($this->input->post('nim', true));
        $password = htmlspecialchars($this->input->post('password', true));
        $user = $this->db->select('*')->from('user')->where('nim', $nim)->get()->row_array();
        if (!empty($user)) {
            // Active user > 1 ?
            if ($user['is_active'] == 1) {
                $password_verify = password_verify($password, $user['password']);
                if ($password_verify) {
                    $sesi_user = [
                        'id' => $user['id_user'],
                        'id_role' => $user['role_id'],
                        'is_logged_in' => TRUE
                    ];

                    $this->session->set_userdata($sesi_user);

                    redirect('users');
                } else {
                    $this->session->set_flashdata('message_error', 'Password yang kamu masukan salah!');
                    redirect('/login');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Akun kamu di nonaktifkan, segera hubungi pihak terkait / admin');
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('message_error', 'NIM  yang kamu masukan tidak terdaftar');
            redirect('/login');
        }
    }



    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('is_logged_in');
        redirect('/login');
    }
}
