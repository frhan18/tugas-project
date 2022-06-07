<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id') || !$this->session->userdata('id_role') || !$this->session->userdata('is_logged_in')) {
            redirect('/login');
        } else if ($this->session->userdata('id_role') == 1) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['title'] = 'Home';
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
        $data['title'] = 'Data KRS';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('tb_mahasiswa', ['id_user' => $data['get_sesi_user']['id_user']])->row_array();
        // $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['get_sesi_user'] = $this->db->select('user.*, tb_mahasiswa.nim')->from('user')->join('tb_mahasiswa', 'tb_mahasiswa.id_user=user.id_user')->get()->row_array();
        $data['krs'] = $this->db->select('tb_krs.id_mata_kuliah,tb_mata_kuliah.nama_mata_kuliah,tb_krs.sks, tb_krs.semester, tb_krs.tahun, tb_kelas.kode_kelas, tb_prodi.nama_prodi')
            ->from('tb_krs')
            ->join('tb_kelas', 'tb_kelas.kode_kelas=tb_krs.kode_kelas')
            ->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_krs.id_mata_kuliah')
            ->join('tb_prodi', 'tb_prodi.kode_prodi=tb_krs.kode_prodi')
            ->where('tb_krs.kode_kelas', $data['user']['kode_kelas'])
            ->order_by('tb_mata_kuliah.nama_mata_kuliah', 'ASC')
            ->get()->result_array();


        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/krs', $data);
        $this->load->view('template/backend/footer');
    }


    public function jadwal_perkuliahan()
    {
        $data['title'] = 'Jadwal perkuliahan';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['get_sesi_user'] = $this->db->select('user.*, tb_mahasiswa.nim')->from('user')->join('tb_mahasiswa', "tb_mahasiswa.id_user=user.id_user")->get()->row_array();
        // $data['perkuliahan'] = $this->db->select('*, tb_dosen.nama')->from('tb_perkuliahan')->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_perkuliahan.id_mata_kuliah', 'LEFT')->join('tb_dosen', 'tb_dosen.id_dosen=tb_perkuliahan.id_dosen')->where('tb_perkuliahan.nim', $data['get_sesi_user']['nim'])->get()->result_array();
        // $data['perkuliahan'] = $this->db->select('*, tb_mahasiswa.nim')->from('tb_mahasiswa')->join('tb_perkuliahan', 'tb_perkuliahan.nim=tb_mahasiswa.nim')->get()->result_array();
        // $data['user'] = $this->db->select('*')->from('user')->join('tb_mahasiswa', 'tb_mahasiswa.id_user=user.id_user')->get()->row_array();
        $data['user'] = $this->db->get_where('tb_mahasiswa', ['id_user' => $data['get_sesi_user']['id_user']])->row_array();
        // $data['perkuliahan'] = $this->db->select('*, tb_mahasiswa.nim, tb_dosen.nama')->from('tb_perkuliahan')->join('tb_mahasiswa', 'tb_mahasiswa.nim=tb_perkuliahan.nim')->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_perkuliahan.id_mata_kuliah')->join('tb_dosen', 'tb_dosen.id_dosen=tb_perkuliahan.id_dosen')->where('tb_perkuliahan.kode_kelas', $data['user']['kode_kelas'])->get()->result_array();
        $data['perkuliahan'] = $this->db->select('*,tb_dosen.nama')->from('tb_perkuliahan')->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_perkuliahan.id_mata_kuliah')->join('tb_dosen', 'tb_dosen.id_dosen=tb_perkuliahan.id_dosen')->where('tb_perkuliahan.kode_kelas', $data['user']['kode_kelas'])->get()->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/jadwal_kuliah', $data);
        $this->load->view('template/backend/footer');
    }

    public function mahasiswa_data()
    {
        $data['title'] = 'Data mahasiswa';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['get_sesi_user'] = $this->db->select('user.*, tb_mahasiswa.nim')->from('user')->join('tb_mahasiswa', "tb_mahasiswa.id_user=user.id_user")->get()->row_array();
        // $data['mahasiswa'] = $this->db->select('*')->from('tb_mahasiswa')->join('user', 'user.id_user=tb_mahasiswa.id_user')->where('nim', $data['get_sesi_user']['nim'])->get()->row_array();
        $data['mahasiswa'] = $this->db->get_where('tb_mahasiswa', ['id_user' => $data['get_sesi_user']['id_user']])->row_array();


        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/data_mahasiswa', $data);
        $this->load->view('template/backend/footer');
    }


    public function mahasiswa_data_update($id)
    {
        $row = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (!$row['id_user'] || !$id) {
            show_404();
        } else {
            $data = [
                'nama'                    =>  $this->input->post('nama', true),
                'email'                   =>  $this->input->post('email', true),
                'tempat_tanggal_lahir'    =>  $this->input->post('tempat_tanggal_lahir', true),
                'jenis_kelamin'           =>  $this->input->post('jenis_kelamin', true),
                'agama'                   =>  $this->input->post('agama', true),
                'alamat'                  =>  $this->input->post('alamat', true),
            ];

            if ($this->db->update('tb_mahasiswa', $data, ['id_user' => $id])) {
                $this->session->set_flashdata('message_success', 'Data kamu di perbarui.');
                redirect('data-diri');
            }
        }
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
    public function setting_profile($id)
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
            $this->load->view('users/profile', $data);
            $this->load->view('template/backend/footer');
        } else {
            $gambar = $_FILES['image']['name'];
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
                redirect('users/profile');
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
                redirect('users/profile');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message_error', 'Password baru tidak boleh sama dengan password lama.');
                    redirect('users/profile');
                } else {
                    // password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password_update', time());
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $id);
                    $this->db->update('user');

                    $this->session->set_flashdata('message_success', 'Password berhasil di ubah');
                    redirect('users/profile');
                }
            }
        }
    }
}
