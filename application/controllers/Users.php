<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('krs_model', 'krs', TRUE);

        if (!$this->session->userdata('id') || !$this->session->userdata('id_role') || !$this->session->userdata('is_logged_in')) {
            redirect('/login');
        } else if ($this->session->userdata('id_role') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('id_role') == 6) {
            redirect('admin');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['berita'] = $this->db->get('tb_berita')->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/dashboard', $data);
        $this->load->view('template/backend/footer');
    }

    public function krs()
    {
        $data['title'] = 'Krs';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->select('tb_mahasiswa.nama, tb_mahasiswa.nim, tb_krs.semester, tb_krs.tahun, tb_krs.kode_kelas')
            ->from('user')
            ->join('tb_mahasiswa', 'tb_mahasiswa.nim=user.nim', 'left')
            ->join('tb_krs', 'tb_krs.nim=user.nim', 'left')
            ->where('tb_mahasiswa.nim', $data['get_sesi_user']['nim'])
            ->get()->row_array();
        $data['krs'] = $this->db->select('tb_krs.id_mata_kuliah,tb_mata_kuliah.nama_mata_kuliah,tb_krs.sks, tb_krs.semester, tb_kelas.kode_kelas')
            ->from('tb_krs')
            ->join('tb_kelas', 'tb_kelas.kode_kelas=tb_krs.kode_kelas')
            ->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_krs.id_mata_kuliah')
            ->where('tb_krs.nim', $data['get_sesi_user']['nim'])
            ->order_by('tb_mata_kuliah.nama_mata_kuliah', 'ASC')
            ->get()->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/krs', $data);
        $this->load->view('template/backend/footer');
    }


    public function jadwal_kuliah()
    {
        $data['title'] = 'Jadwal kuliah';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['perkuliahan'] = $this->db->select('*, tb_dosen.nama')->from('tb_perkuliahan')->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_perkuliahan.id_mata_kuliah', 'LEFT')->join('tb_dosen', 'tb_dosen.id_dosen=tb_perkuliahan.id_dosen')->where('tb_perkuliahan.nim', $data['get_sesi_user']['nim'])->get()->result_array();



        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/jadwal_kuliah', $data);
        $this->load->view('template/backend/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/profile', $data);
        $this->load->view('template/backend/footer');
    }
    public function setting_profile()
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
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
            $this->load->view('users/profile', $data);
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
            ];

            if ($this->db->update('user', $setting_profile, ['id_user' => $this->session->userdata('id')])) {
                $this->session->set_flashdata('message_success', 'Akun kamu berhasil di perbarui.');
                redirect('admin/setting');
            }
        }
    }


    public function setting_password()
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $config = [
            [
                'field' => 'password_lama',
                'label' => 'Password Lama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'password_baru',
                'label' => 'Password Baru',
                'rules' => 'required|trim|matches[ulangi_password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches'  => '{field} tidak sama dengan konfirmasi'
                ]
            ],
            [
                'field' => 'ulangi_password',
                'label' => 'Ulangi password',
                'rules' => 'required|trim|matches[password_baru]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches'  => '{field} tidak sama dengan password baru'
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
                redirect('admin/setting');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message_error', 'Password baru tidak boleh sama dengan password lama.');
                    redirect('admin/setting');
                } else {
                    // password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password_update', time());
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $this->session->userdata('id'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message_success', 'Password berhasil di ubah');
                    redirect('admin/setting');
                }
            }
        }
    }
}
