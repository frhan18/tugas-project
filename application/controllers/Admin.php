<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('krs_model', 'krs', TRUE);

        if (!$this->session->userdata('is_logged_in')) {
            redirect('/login');
        }
    }

    public function index() // Dashboard
    {
        $data['title'] = 'Dashboard';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get('user')->result_array();
        $data['count_all_mahasiswa'] = $this->db->count_all('tb_mahasiswa');
        $data['count_all_dosen'] = $this->db->count_all('tb_dosen');
        $data['count_all_matakuliah'] = $this->db->count_all('tb_mata_kuliah');
        $data['count_all_prodi'] = $this->db->count_all('tb_prodi');
        $data['count_all_user'] = $this->db->count_all('user');

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/backend/footer');
    }

    public function user_account() // User account 
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


    public function mahasiswa() // Mahasiswa
    {
        $data['title'] = 'Mahasiswa';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['mahasiswa'] = $this->db->get('tb_mahasiswa')->result_array();
        $config = [
            [
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim|is_unique[tb_mahasiswa.nim]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'tempat_tanggal_lahir',
                'label' => 'Tempat Tanggal Lahir',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'tahun_masuk',
                'label' => 'Tahun masuk',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'agama',
                'label' => 'Agama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis kelamin',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'status_mhs',
                'label' => 'Status mahasiswa',
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
            $this->load->view('admin/mahasiswa', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_mahasiswa();
        }
    }

    public function add_mahasiswa()
    {
        $data = [
            'nim'                   => $this->input->post('nim', true),
            'nama'                  => $this->input->post('nama', true),
            'tempat_tanggal_lahir'  => $this->input->post('tempat_tanggal_lahir', true),
            'tahun_masuk'           => $this->input->post('tahun_masuk', true),
            'agama'                 => $this->input->post('agama', true),
            'jenis_kelamin'         => $this->input->post('jenis_kelamin', true),
            'status_mhs'            => $this->input->post('status_mhs', true),
            'tahun_masuk'           => $this->input->post('tahun_masuk', true),
            'alamat'                => $this->input->post('alamat', true),
        ];

        if ($this->db->insert('tb_mahasiswa', $data)) {
            $this->session->set_flashdata('message_success', 'Berhasil menambahkan data mahasiswa');
            redirect('admin/mahasiswa');
        }
    }

    public function update_mahasiswa($id)
    {
        $row = $this->db->get_where('tb_mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $data = [
                'nama'                  => $this->input->post('nama', true),
                'tempat_tanggal_lahir'  => $this->input->post('tempat_tanggal_lahir', true),
                'tahun_masuk'           => $this->input->post('tahun_masuk', true),
                'agama'                 => $this->input->post('agama', true),
                'jenis_kelamin'         => $this->input->post('jenis_kelamin', true),
                'status_mhs'            => $this->input->post('status_mhs', true),
                'tahun_masuk'           => $this->input->post('tahun_masuk', true),
                'alamat'                => $this->input->post('alamat', true)
            ];

            if ($this->db->update('tb_mahasiswa', $data, ['nim' => $id])) {
                $this->session->set_flashdata('message_success', 'Berhasil mengubah data mahasiswa ' . $row['nama']);
                redirect('admin/mahasiswa');
            }
        }
    }

    public function delete_mahasiswa($id)
    {
        $row = $this->db->get_where('tb_mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $delete_mahasiswa = $this->db->delete('tb_mahasiswa', ['nim' => $id]);
            if ($delete_mahasiswa) {
                $this->session->set_flashdata('message_success', 'Berhasil menghapus data mahasiswa ' . $row['nama']);
                redirect('admin/mahasiswa');
            }
        }
    }


    public function dosen() // Dashboard
    {
        $data['title'] = 'Dosen';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['dosen'] = $this->db->get('tb_dosen')->result_array();
        $data['matakuliah'] = $this->db->get('tb_mata_kuliah')->result_array();
        $config = [
            [
                'field' => 'id_dosen',
                'label' => 'Kode dosen',
                'rules' => 'required|trim|is_unique[tb_dosen.id_dosen]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'nip',
                'label' => 'Nip',
                'rules' => 'required|trim|is_unique[tb_dosen.nip]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],

            [
                'field' => 'nama',
                'label' => 'Nama dosen',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis kelamin',
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
            $this->load->view('admin/dosen', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_dosen();
        }
    }


    private function add_dosen()
    {
        $data = [
            'id_dosen'       => $this->input->post('id_dosen', true),
            'nip'            => $this->input->post('nip', true),
            'nama'           => $this->input->post('nama', true),
            'email'          => $this->input->post('email', true),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin', true),
            'status_dosen'   => $this->input->post('status_dosen', true),
        ];

        if ($this->db->insert('tb_dosen', $data)) {
            $this->session->set_flashdata('message_success', 'Berhasil menambahkan data dosen');
            redirect('admin/dosen');
        }
    }


    public function update_dosen($id)
    {
        $row = $this->db->get_where('tb_dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            $this->page_error();
        } else {
            $data = [
                'id_dosen'       => $this->input->post('id_dosen', true),
                'nip'            => $this->input->post('nip', true),
                'nama'           => $this->input->post('nama', true),
                'email'          => $this->input->post('email', true),
                'jenis_kelamin'  => $this->input->post('jenis_kelamin', true),
                'status_dosen'   => $this->input->post('status_dosen', true),
            ];


            if ($this->db->update('tb_dosen', $data, ['id_dosen' => $id])) {
                $this->session->set_flashdata('message_success', 'Data dosen di perbarui');
                redirect('admin/dosen');
            }
        }
    }


    public function delete_dosen($id)
    {
        $row = $this->db->get_where('tb_dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_dosen', ['id_dosen' => $id]);
            $this->session->set_flashdata('message_success', 'Data dosen dihapus');
            redirect('admin/dosen');
        }
    }

    public function matakuliah() // Dashboard
    {
        $data['title'] = 'Matakuliah';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['matakuliah'] = $this->db->get('tb_mata_kuliah')->result_array();

        $config = [
            [
                'field' => 'id_mata_kuliah',
                'label' => 'Kode matakuliah',
                'rules' => 'required|trim|is_unique[tb_mata_kuliah.id_mata_kuliah]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'nama_mata_kuliah',
                'label' => 'Nama matakuliah',
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
            $this->load->view('admin/matakuliah', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_matakuliah();
        }
    }

    private function add_matakuliah()
    {
        $data = [
            'id_mata_kuliah'   => $this->input->post('id_mata_kuliah', true),
            'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah', true)
        ];

        if ($this->db->insert('tb_mata_kuliah', $data)) {
            $this->session->set_flashdata('message_success', 'Data matakuliah berhasil ditambahkan');
            redirect('admin/matakuliah');
        }
    }


    public function update_matakuliah($id)
    {
        $row = $this->db->get_where('tb_mata_kuliah', ['id_mata_kuliah' => $id])->row_array();
        if (!$row['id_mata_kuliah'] || !$id) {
            $this->page_error();
        } else {
            $data = [
                'nama_mata_kuliah' => $this->security->sanitize_filename($this->input->post('nama_mata_kuliah'), TRUE),
            ];

            if ($this->db->update('tb_mata_kuliah', $data, ['id_mata_kuliah' => $id])) {
                $this->session->set_flashdata('message_success', 'Data matakuliah berhasil diperbarui');
                redirect('admin/matakuliah');
            }
        }
    }


    public function delete_matakuliah($id)
    {
        $row = $this->db->get_where('tb_mata_kuliah', ['id_mata_kuliah' => $id])->row_array();
        if (!$row['id_mata_kuliah'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_mata_kuliah', ['id_mata_kuliah' => $id]);
            $this->session->set_flashdata('message_success', 'Data matakuliah berhasil dihapus');
            redirect('admin/matakuliah');
        }
    }

    public function kelas() // Dashboard
    {
        $data['title'] = 'Kelas';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $config = [
            [
                'field' => 'kode_kelas',
                'label' => 'Kode kelas',
                'rules' => 'required|trim|is_unique[tb_kelas.kode_kelas]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],     [
                'field' => 'nama_kelas',
                'label' => 'Nama kelas',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'lokasi_kelas',
                'label' => 'Lokasi kelas',
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
            $this->load->view('admin/kelas', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_kelas();
        }
    }


    private function add_kelas()
    {
        $data = [
            'kode_kelas' => $this->input->post('kode_kelas', true),
            'nama_kelas' => $this->input->post('nama_kelas', true),
            'lokasi_kelas' => $this->input->post('lokasi_kelas', true),
        ];

        if ($this->db->insert('tb_kelas', $data)) {
            $this->session->set_flashdata('message_success', 'Data kelas berhasil ditambahkan');
            redirect('admin/kelas');
        }
    }



    public function update_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['kode_kelas' => $id])->row_array();
        if (!$row['kode_kelas'] || !$id) {
            $this->page_error();
        } else {
            $data = [
                'kode_kelas' => $this->input->post('kode_kelas', true),
                'nama_kelas' => $this->input->post('nama_kelas', true),
                'lokasi_kelas' => $this->input->post('lokasi_kelas', true),
            ];

            if ($this->db->update('tb_kelas', $data, ['kode_kelas' => $id])) {
                $this->session->set_flashdata('message_success', 'Data kelas berhasil diperbarui');
                redirect('admin/kelas');
            }
        }
    }

    public function delete_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['kode_kelas' => $id])->row_array();
        if (!$row['kode_kelas'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_kelas', ['kode_kelas' => $id]);
            $this->session->set_flashdata('message_success', 'Data kelas berhasil dihapus');
            redirect('admin/kelas');
        }
    }


    public function krs() // Dashboard
    {
        $data['title'] = 'Krs';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['krs'] = $this->db->select('*')
            ->from('tb_krs')
            ->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_krs.id_mata_kuliah', 'LEFT')
            ->join('tb_prodi', 'tb_prodi.kode_prodi=tb_krs.kode_prodi', 'LEFT')
            ->get()->result_array();
        $data['matakuliah'] = $this->db->select('tb_mata_kuliah.id_mata_kuliah, tb_mata_kuliah.nama_mata_kuliah')->from('tb_mata_kuliah')->get()->result_array();
        $data['kelas'] = $this->db->select('tb_kelas.kode_kelas')->from('tb_kelas')->get()->result_array();
        $data['mahasiswa'] = $this->db->select('tb_mahasiswa.nim')->from('tb_mahasiswa')->get()->result_array();
        $data['prodi'] = $this->db->select('tb_prodi.kode_prodi, tb_prodi.nama_prodi')->from('tb_prodi')->get()->result_array();
        $config = [

            [
                'field' => 'id_mata_kuliah',
                'label' => 'Matakuliah',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',
                ]
            ],
            [
                'field' => 'kode_prodi',
                'label' => 'Prodi',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',
                ]
            ],
            [
                'field' => 'kode_kelas',
                'label' => 'Kelas',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',
                ]
            ],
            [
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',
                ]
            ],
            [
                'field' => 'sks',
                'label' => 'Sks',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',
                ]
            ],
            [
                'field' => 'tahun',
                'label' => 'Tahun',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',

                ]
            ],
            [
                'field' => 'semester',
                'label' => 'Semester',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} belum di pilih',

                ]
            ],
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {

            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/krs', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_krs();
        }
    }

    private function add_krs()
    {
        $data = [
            'id_mata_kuliah'         => $this->input->post('id_mata_kuliah', true),
            'kode_prodi'             => $this->input->post('kode_prodi', true),
            'kode_kelas'             => $this->input->post('kode_kelas', true),
            'nim'                    => $this->input->post('nim', true),
            'sks'                    => $this->input->post('sks', true),
            'tahun'                  => $this->input->post('tahun', true),
            'semester'               => $this->input->post('semester', true),
        ];

        if ($this->db->insert('tb_krs', $data)) {
            $this->session->set_flashdata('message_success', ' Admin menambahkan data krs');
            redirect('admin/krs');
        }
    }


    public function delete_krs($id)
    {
        $row = $this->db->get_where('tb_krs', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_krs', ['id' => $id]);
            $this->session->set_flashdata('message_success', 'Data krs berhasil dihapus');
            redirect('admin/krs');
        }
    }

    public function update_krs($id)
    {
        $row = $this->db->get_where('tb_krs', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            $this->page_error();
        } else {
            $data = [
                'id_mata_kuliah' => $this->input->post('id_mata_kuliah', true),
                'kode_kelas'    => $this->input->post('kode_kelas', true),
                'nim'           => $this->input->post('nim', true),
                'sks'           => $this->input->post('sks', true),
                'tahun'         => $this->input->post('tahun', true),
                'semester'      => $this->input->post('semester', true),
            ];


            if ($this->db->update('tb_krs', $data, ['id' => $id])) {
                $this->session->set_flashdata('message_success', 'Data krs berhasil diperbarui');
                redirect('admin/krs');
            }
        }
    }


    public function prodi() // Dashboard
    {
        $data['title'] = 'Prodi';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();
        $config = [

            [
                'field' => 'kode_prodi',
                'label' => 'Kode prodi',
                'rules' => 'required|trim|is_unique[tb_prodi.kode_prodi]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'nama_prodi',
                'label' => 'Nama prodi',
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
            $this->load->view('admin/prodi', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_prodi();
        }
    }

    private function add_prodi()
    {
        $data = [
            'kode_prodi' => $this->input->post('kode_prodi', true),
            'nama_prodi' => $this->input->post('nama_prodi', true),
        ];

        if ($this->db->insert('tb_prodi', $data)) {
            $this->session->set_flashdata('message_success', 'Data prodi berhasil ditambahkan');
            redirect('admin/prodi');
        }
    }
    public function update_prodi($id)
    {
        $row = $this->db->get_where('tb_prodi', ['kode_prodi' => $id])->row_array();
        if (!$row['kode_prodi'] || !$id) {
            $this->page_error();
        } else {
            $data = [
                'kode_prodi' => $this->input->post('kode_prodi', true),
                'nama_prodi' => $this->input->post('nama_prodi', true),
            ];

            if ($this->db->update('tb_prodi', $data, ['kode_prodi' => $id])) {
                $this->session->set_flashdata('message_success', 'Data prpdi berhasil diperbarui');
                redirect('admin/prodi');
            }
        }
    }

    public function delete_prodi($id)
    {
        $row = $this->db->get_where('tb_prodi', ['kode_prodi' => $id])->row_array();
        if (!$row['kode_prodi'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_prodi', ['kode_prodi' => $id]);
            $this->session->set_flashdata('message_success', 'Data prodi berhasil dihapus');
            redirect('admin/prodi');
        }
    }



    public function kuliah() // Dashboard
    {
        $data['title'] = 'Perkuliahan';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['perkuliahan'] = $this->db->select('*, tb_dosen.nama')
            ->from('tb_perkuliahan')
            ->join('tb_dosen', 'tb_dosen.id_dosen=tb_perkuliahan.id_dosen')
            ->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_perkuliahan.id_mata_kuliah')->get()->result_array();
        $data['kode_dosen'] = $this->db->select('tb_dosen.id_dosen, tb_dosen.nama')->from('tb_dosen')->get()->result_array();
        $data['kode_nim'] = $this->db->select('tb_mahasiswa.nim')->from('tb_mahasiswa')->get()->result_array();
        $data['kode_kelas'] = $this->db->select('tb_kelas.kode_kelas, tb_kelas.nama_kelas')->from('tb_kelas')->get()->result_array();
        $data['kode_matakuliah'] = $this->db->select('tb_mata_kuliah.id_mata_kuliah, tb_mata_kuliah.nama_mata_kuliah')->from('tb_mata_kuliah')->get()->result_array();
        $config = [

            [
                'field' => 'id_dosen',
                'label' => 'Kode dosen',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'id_mata_kuliah',
                'label' => 'Kode matakuliah',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'kode_kelas',
                'label' => 'Kode kelas',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'waktu_mulai',
                'label' => 'Waktu mulai',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'waktu_selesai',
                'label' => 'Waktu selesai',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'hari',
                'label' => 'Hari',
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
            $this->load->view('admin/perkuliahan', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_perkuliahan();
        }
    }

    public function add_perkuliahan()
    {
        $data_perkuliahan = [
            'id_dosen'          => $this->input->post('id_dosen', true),
            'nim'               => $this->input->post('nim', true),
            'id_mata_kuliah'    => $this->input->post('id_mata_kuliah', true),
            'kode_kelas'        => $this->input->post('kode_kelas', true),
            'waktu_mulai'       => $this->input->post('waktu_mulai', true),
            'waktu_selesai'      => $this->input->post('waktu_selesai', true),
            'hari'              => $this->input->post('hari', true),
        ];


        if ($this->db->insert('tb_perkuliahan', $data_perkuliahan)) {
            $this->session->set_flashdata('message_success', 'Data perkuliahan ditambahkan');
            redirect('admin/kuliah');
        }
    }

    public function edit_perkuliahan($id)
    {
        $row = $this->db->get_where('tb_perkuliahan', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            $this->page_error();
        } else {
            $data_perkuliahan = [
                'id_dosen'          => $this->input->post('id_dosen', true),
                'nim'               => $this->input->post('nim', true),
                'id_mata_kuliah'    => $this->input->post('id_mata_kuliah', true),
                'kode_kelas'        => $this->input->post('kode_kelas', true),
                'waktu_mulai'       => $this->input->post('waktu_mulai', true),
                'waktu_selesai'      => $this->input->post('waktu_selesai', true),
                'hari'              => $this->input->post('hari', true),
            ];

            if ($this->db->update('tb_perkuliahan', $data_perkuliahan, ['id' => $id])) {
                $this->session->set_flashdata('message_success', 'Data perkuliahan di perbarui');
                redirect('admin/kuliah');
            }
        }
    }

    public function delete_perkuliahan($id)
    {
        $row = $this->db->get_where('tb_perkuliahan', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            $this->page_error();
        } else {
            $this->db->delete('tb_perkuliahan', ['id' => $id]);
            $this->session->set_flashdata('message_success', 'Data perkuliahan dihapus');
            redirect('admin/kuliah');
        }
    }


    public function page_error()
    {
        $data['title'] = 'Page Not Found 404';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $this->load->view('template/backend/header', $data);
        // $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('template/backend/footer');
    }


    public function setting()
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/setting', $data);
        $this->load->view('template/backend/footer');
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

                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $this->session->userdata('id'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message_success', 'Password berhasil di ubah');
                    redirect('admin/setting');
                }
            }
        }
    }

    public function setting_akun()
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
            ];

            if ($this->db->update('user', $setting_profile, ['id_user' => $this->session->userdata('id')])) {
                $this->session->set_flashdata('message_success', 'Akun kamu berhasil di perbarui.');
                redirect('admin/setting');
            }
        }
    }


    public function feedback()
    {
        $data['title'] = 'Feedback';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/feedback', $data);
        $this->load->view('template/backend/footer');
    }



    public function berita()
    {
        $data['title'] = 'Berita';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['berita'] = $this->db->get('tb_berita')->result_array();

        $config = [
            [
                'field' => 'judul_berita',
                'label' => 'Judul berita',
                'rules' => 'required|trim|is_unique[tb_berita.judul_berita]',
                'errors' => [
                    'required' => '{field} berita belum di isi',
                    'is_unique' => '{field} berita sudah diterbitkan'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/berita', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->tambahBerita();
        }
    }

    public function tambahBerita()
    {
        $data = [
            'judul_berita' => $this->input->post('judul_berita', true),
            'penulis'      => $this->input->post('penulis', true),
            'content'      => $this->input->post('content', true),
            'created_at'   => time(),
            'is_active'    => $this->input->post('is_active', true)
        ];

        if ($this->db->insert('tb_berita', $data)) {
            $this->session->set_flashdata('berita_berhasil', 'Berita baru berhasil ditambahkan');
            redirect('admin/berita');
        }
    }

    public function update_berita($id)
    {
        $rows = $this->db->get_where('tb_berita', ['id_berita' => $id])->row_array();
        if (!$rows['id_berita'] || !$id) {
            show_404();
        } else {
            $data = [
                'judul_berita' => $this->input->post('judul_berita', true),
                'penulis'      => $this->input->post('penulis', true),
                'content'      => $this->input->post('content', true),
                'is_active'    => $this->input->post('is_active', true)
            ];

            if ($this->db->update('tb_berita', $data, ['id_berita' => $id])) {
                $this->session->set_flashdata('berita_berhasil', 'Berita ' . $rows['judul_berita'] . ' di perbarui.');
                redirect('admin/berita');
            }
        }
    }

    public function delete_berita($id)
    {
        $rows = $this->db->get_where('tb_berita', ['id_berita' => $id])->row_array();
        if (!$rows['id_berita'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_berita', ['id_berita' => $id]);
            $this->session->set_flashdata('berita_berhasil', 'Berita ' . $rows['judul_berita'] . ' dihapus.');
            redirect('admin/berita');
        }
    }
}
