<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminSetting_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id') || !$this->session->userdata('id_role')) {
            redirect('login');
        } elseif ($this->session->userdata('id_role') == 2) {
            show_404();
        }
    }

    public function index()
    {
        $data['title'] = 'Profile ';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/setting', $data);
        $this->load->view('template/backend/footer');
    }

    public function setting_akun($id)
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        if ($id != $data['get_sesi_user']['id_user']) {
            show_error('Uppsss data yang kamu masukan tidak terdaftar.', 500, 'Halaman tidak merespon');
        }

        $config = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} sudah terdaftar '
                ]
            ],
            [
                'field' => 'name',
                'label' => 'Nama akun',
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
            $this->load->view('admin/setting', $data);
            $this->load->view('template/backend/footer');
        } else {
            $filename = date('Y-m-d') . '_' .  url_title($data['get_sesi_user']['name'], '-', true);
            $config['upload_path']          = FCPATH . '/upload/';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['file_name']            = $filename;
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 1MB
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();
            }

            $setting_profile = [
                'email' => $this->input->post('email', true),
                'name' => $this->input->post('name', true),
                'image' => $uploaded_data['file_name'],
                'updated_at' => time(),
            ];

            if ($this->db->update('user', $setting_profile, ['id_user' => $id])) {
                $this->session->set_flashdata('message_success', 'Akun kamu berhasil di perbarui.');
                redirect('setting-profile');
            }
        }
    }

    public function setting_password($id)
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        if ($id != $data['get_sesi_user']['id_user']) {
            show_error('Uppsss data yang kamu masukan tidak terdaftar.', 500, 'Halaman tidak merespon');
        }

        $config = [
            [
                'field' => 'password_lama',
                'label' => 'Password Lama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                ]
            ],
            [
                'field' => 'password_baru',
                'label' => 'Password',
                'rules' => 'required|trim|matches[ulangi_password]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'matches'  => 'Konfirmasi {field} tidak sesuai.'
                ]
            ],
            [
                'field' => 'ulangi_password',
                'label' => 'Konfirmasi password',
                'rules' => 'required|trim|matches[password_baru]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'matches'  => '{field} tidak sesuai dengan password baru.'
                ]
            ],
        ];

        $this->form_validation->set_rules($config);
        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/setting', $data);
            $this->load->view('template/backend/footer');
        } else {
            $password_lama = $this->input->post('password_lama', true);
            $password_baru = $this->input->post('password_baru', true);
            $password_verify  = password_verify($password_lama, $data['get_sesi_user']['password']);
            if (!$password_verify) {
                $this->session->set_flashdata('message_error', 'Password lama salah!');
                redirect('setting-profile');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message_error', 'Password baru tidak boleh sama dengan password lama.');
                    redirect('setting-profile');
                } else {
                    // password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password_update', time());
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $id);
                    $this->db->update('user');

                    $this->session->set_flashdata('message_success', 'Password berhasil di ubah');
                    redirect('setting-profile');
                }
            }
        }
    }
}
