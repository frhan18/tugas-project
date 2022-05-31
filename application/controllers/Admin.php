<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('krs_model', 'krs', TRUE);

        _is_logged_in();
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
                'updated_at'    => time(),
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
        $data['krs'] = $this->db->get('tb_krs')->result_array();
        $data['matakuliah'] = $this->db->select('tb_mata_kuliah.id_mata_kuliah')->from('tb_mata_kuliah')->get()->result_array();
        $data['kelas'] = $this->db->select('tb_kelas.kode_kelas')->from('tb_kelas')->get()->result_array();
        $data['mahasiswa'] = $this->db->select('tb_mahasiswa.nim')->from('tb_mahasiswa')->get()->result_array();
        $config = [

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
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'sks',
                'label' => 'Sks',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            [
                'field' => 'tahun',
                'label' => 'Tahun',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
            [
                'field' => 'semester',
                'label' => 'Semester',
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
            'kode_kelas'             => $this->input->post('kode_kelas', true),
            'nim'                    => $this->input->post('nim', true),
            'sks'                    => $this->input->post('sks', true),
            'tahun'                  => $this->input->post('tahun', true),
            'semester'               => $this->input->post('semester', true),
        ];

        if ($this->db->insert('tb_krs', $data)) {
            $this->session->set_flashdata('message_success', 'Data krs berhasil ditambahkan');
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



    public function kuliah() // Dashboard
    {
        $data['title'] = 'Perkuliahan';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['perkuliahan'] = $this->db->get('tb_perkuliahan')->result_array();
        $data['kode_dosen'] = $this->db->select('tb_dosen.id_dosen')->from('tb_dosen')->get()->result_array();
        $data['kode_nim'] = $this->db->select('tb_mahasiswa.nim')->from('tb_mahasiswa')->get()->result_array();
        $data['kode_kelas'] = $this->db->select('tb_kelas.kode_kelas')->from('tb_kelas')->get()->result_array();
        $data['kode_matakuliah'] = $this->db->select('tb_mata_kuliah.id_mata_kuliah')->from('tb_mata_kuliah')->get()->result_array();
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
}
