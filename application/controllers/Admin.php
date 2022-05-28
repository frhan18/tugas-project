<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('mahasiswa_model', 'mahasiswa', TRUE);
        $this->load->model('prodi_model', 'prodi', TRUE);
        $this->load->model('matakuliah_model', 'matakuliah', TRUE);
        _is_logged_in();
    }

    public function index() // Dashboard
    {
        $data['title'] = 'Dashboard';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get('user')->result_array();
        $data['count_all_mahasiswa'] = $this->db->count_all('mahasiswa');
        $data['count_all_dosen'] = $this->db->count_all('dosen');
        $data['count_all_matakuliah'] = $this->db->count_all('matakuliah');
        $data['count_all_prodi'] = $this->db->count_all('prodi');
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
            $this->load->view('admin/list_account', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->new_account();
        }
    }

    private function new_account()
    {
        $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 11);
        $data = [
            'id_user'       => $id,
            'name'          => htmlspecialchars($this->input->post('name', true)),
            'email'         => htmlspecialchars($this->input->post('email', true)),
            'password'      => htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT)),
            'role_id'       => $this->input->post('role_id', true),
            'is_active'     => $this->input->post('is_active', true),
            'image'         => 'default.svg',
            'created_at'    => time(),
            'updated_at'    => time(),
        ];

        if ($this->user->insert($data)) {
            $this->session->set_flashdata('message_success', 'Account berhasil dibuat');
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
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'role_id'       => $this->input->post('role_id', true),
                'is_active'     => $this->input->post('is_active', true),
                'updated_at'    => time(),
            ];

            if ($this->user->update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Account ' . $row['name'] . ' di perbarui');
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
                $this->session->set_flashdata('message_success', 'Account ' . $row['name']  . ' dihapus');
                redirect('admin/user_account');
            }
        }
    }


    public function mahasiswa() // Mahasiswa
    {
        $data['title'] = 'Mahasiswa';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['mahasiswa'] = $this->mahasiswa->get_mahasiswa()->result_array();

        $config = [
            [
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim|is_unique[mahasiswa.nim]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'nama_mhs',
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
                'field' => 'id_prodi',
                'label' => 'Program studi',
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
            $this->load->view('admin/list_mahasiswa', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_mahasiswa();
        }
    }

    public function add_mahasiswa()
    {
        $data = [
            'id_user'               => $this->input->post('id_user', true),
            'nim'                   => htmlspecialchars($this->input->post('nim', true)),
            'nama_mhs'              => htmlspecialchars($this->input->post('nama_mhs', true)),
            'tempat_tanggal_lahir'  => htmlspecialchars($this->input->post('tempat_tanggal_lahir', true)),
            'tahun_masuk'           => htmlspecialchars($this->input->post('tahun_masuk', true)),
            'agama'                 => htmlspecialchars($this->input->post('agama', true)),
            'jenis_kelamin'         => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'id_prodi'              => $this->input->post('id_prodi', true),
            'is_active'             => $this->input->post('is_active', true),
            'created_at'            => time(),
            'updated_at'            => time(),
        ];

        if ($this->mahasiswa->insert($data)) {
            $this->session->set_flashdata('message_success', 'Data mahasiswa ditambahkan');
            redirect('admin/mahasiswa');
        }
    }

    public function update_mahasiswa($id)
    {
        $row = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $data = [
                'id_user'                 => $this->input->post('id_user', true),
                'nama_mhs'                => htmlspecialchars($this->input->post('nama_mhs', true)),
                'tempat_tanggal_lahir'    => htmlspecialchars($this->input->post('tempat_tanggal_lahir', true)),
                'tahun_masuk'             => htmlspecialchars($this->input->post('tahun_masuk', true)),
                'agama'                   => htmlspecialchars($this->input->post('agama', true)),
                'jenis_kelamin'           => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'id_prodi'                => $this->input->post('id_prodi', true),
                'id_user'                 => $this->input->post('id_user', true),
                'is_active'               => $this->input->post('is_active', true),
                'updated_at'              => time(),
            ];

            if ($this->mahasiswa->update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa diperbarui');
                redirect('admin/mahasiswa');
            }
        }
    }

    public function delete_mahasiswa($id)
    {
        $row = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $delete_mahasiswa = $this->mahasiswa->delete($id);
            if ($delete_mahasiswa) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa ' . $row['nim'] .  ' dihapus');
                redirect('admin/mahasiswa');
            }
        }
    }


    public function prodi() // prodi
    {
        $data['title'] = 'Prodi';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['prodi'] = $this->prodi->get_prodi()->result_array();

        $config = [
            [
                'field' => 'id_prodi',
                'label' => 'ID Prodi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'nama_prodi',
                'label' => 'Nama Prodi',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'akreditasi',
                'label' => 'Akreditasi',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'tahun',
                'label' => 'Tahun Aktif',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_prodi', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_prodi();
        }
    }

    public function add_prodi()
    {
        $data  = [
            'id_prodi'    => htmlspecialchars($this->input->post('id_prodi', true)),
            'nama_prodi'  => htmlspecialchars($this->input->post('nama_prodi', true)),
            'akreditasi'  => htmlspecialchars($this->input->post('akreditasi', true)),
            'tahun'       => htmlspecialchars($this->input->post('tahun', true)),
            'is_active'   => $this->input->post('is_active', true)
        ];

        if ($this->prodi->insert($data)) {
            $this->session->set_flashdata('message_success', 'Data prodi ditambahkan');
            redirect('admin/prodi');
        }
    }

    public function update_prodi($id)
    {
        $row = $this->db->get_where('prodi', ['id_prodi' => $id])->row_array();
        if (!$row['id_prodi'] || !$id) {
            show_404();
        } else {
            $data  = [
                'nama_prodi'  => htmlspecialchars($this->input->post('nama_prodi', true)),
                'akreditasi'  => htmlspecialchars($this->input->post('akreditasi', true)),
                'tahun'       => htmlspecialchars($this->input->post('tahun', true)),
                'is_active'   => $this->input->post('is_active', true)
            ];

            if ($this->prodi->update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Data prodi diperbarui');
                redirect('admin/prodi');
            }
        }
    }


    public function delete_prodi($id)
    {
        $row = $this->db->get_where('prodi', ['id_prodi' => $id])->row_array();
        if (!$row['id_prodi'] || !$id) {
            show_404();
        } else {
            $delete_prodi = $this->prodi->delete($id);
            if ($delete_prodi) {
                $this->session->set_flashdata('message_success', 'Data prodi dihapus');
                redirect('admin/prodi');
            }
        }
    }


    public function matakuliah() // Matakuliah
    {
        $data['title'] = 'Matakuliah';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['matakuliah'] = $this->matakuliah->get_matakuliah()->result_array();

        $config = [

            [
                'field' => 'nama_matakuliah',
                'label' => 'Nama matakuliah',
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
                'field' => 'semester',
                'label' => 'Semester',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],

            [
                'field' => 'id_prodi',
                'label' => 'Program studi',
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
            $this->load->view('admin/list_matakuliah', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_matakuliah();
        }
    }

    private function add_matakuliah()
    {
        $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        $data = [
            'id_matakuliah' => $id,
            'nama_matakuliah' => htmlspecialchars($this->input->post('nama_matakuliah', true)),
            'sks'    => htmlspecialchars($this->input->post('sks', true)),
            'semester'    => htmlspecialchars($this->input->post('semester', true)),
            'id_prodi'    => htmlspecialchars($this->input->post('id_prodi', true)),
        ];

        if ($this->matakuliah->insert($data)) {
            $this->session->set_flashdata('message_success', 'Data matakuliah ditambahkan');
            redirect('admin/matakuliah');
        }
    }

    public function delete_matakuliah($id)
    {
        $row = $this->db->get_where('matakuliah', ['id_matakuliah' => $id])->row_array();
        if (!$row['id_matakuliah'] || !$id) {
            show_404();
        } else {
            $delete_matakuliah = $this->matakuliah->delete($id);
            if ($delete_matakuliah) {
                $this->session->set_flashdata('message_success', 'Data matakuliah ' . $row['nama_matakuliah'] . ' dihapus');
                redirect('admin/matakuliah');
            }
        }
    }

    public function update_matakuliah($id)
    {
        $row = $this->db->get_where('matakuliah', ['id_matakuliah' => $id])->row_array();
        if (!$row['id_matakuliah'] || !$id) {
            show_404();
        } else {
            $data = [
                'nama_matakuliah' => htmlspecialchars($this->input->post('nama_matakuliah', true)),
                'sks'             => htmlspecialchars($this->input->post('sks', true)),
                'semester'        => htmlspecialchars($this->input->post('semester', true)),
                'id_prodi'        => htmlspecialchars($this->input->post('id_prodi', true)),
            ];

            if ($this->matakuliah->update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Data matakuliah ' . $row['nama_matakuliah']  . ' diperbarui');
                redirect('admin/matakuliah');
            }
        }
    }


    public function ruang() // Ruang
    {
        $data['title'] = 'Ruang';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['ruang'] = $this->db->get('ruangan')->result_array();

        $config = [
            [
                'field' => 'id_ruangan',
                'label' => 'ID Ruang',
                'rules' => 'required|trim|is_unique[ruangan.id_ruangan]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            [
                'field' => 'nama_ruangan',
                'label' => 'Nama ruangan',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'kapasitas',
                'label' => 'Kapasitas',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'nama_gedung',
                'label' => 'Nama gedung',
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
            $this->load->view('admin/list_ruang', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_ruang();
        }
    }

    private function add_ruang()
    {
        $data = [
            'id_ruangan' => htmlspecialchars($this->input->post('id_ruangan', true)),
            'nama_ruangan' => htmlspecialchars($this->input->post('nama_ruangan', true)),
            'kapasitas'   => htmlspecialchars($this->input->post('kapasitas', true)),
            'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung', true))
        ];

        if ($this->db->insert('ruangan', $data)) {
            $this->session->set_flashdata('message_success', 'Data ruangan ditambahkan ');
            redirect('admin/ruang');
        }
    }

    public function delete_ruang($id)
    {
        $row = $this->db->get_where('ruangan', ['id_ruangan' => $id])->row_array();
        if (empty($row['id_ruangan']) || !$id) {
            show_404();
        }

        $delete_ruang = $this->db->delete('ruangan', ['id_ruangan' => $id]);
        if ($delete_ruang) {
            $this->session->set_flashdata('message_success', 'Data ruangan ' . $row['nama_ruangan'] . 'dihapus ');
            redirect('admin/ruang');
        }
    }

    public function update_ruang($id)
    {
        $row = $this->db->get_where('ruangan', ['id_ruangan' => $id])->row_array();
        if (empty($row['id_ruangan']) || !$id) {
            show_404();
        }

        $data = [
            'nama_ruangan' => htmlspecialchars($this->input->post('nama_ruangan', true)),
            'kapasitas'   => htmlspecialchars($this->input->post('kapasitas', true)),
            'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung', true))
        ];

        if ($this->db->update('ruangan', $data, ['id_ruangan' => $id])) {
            $this->session->set_flashdata('message_success', 'Data ruangan diperbarui ');
            redirect('admin/ruang');
        }
    }



    public function kelas() // Dashboard
    {
        $data['title'] = 'Kelas';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['kelas'] = $this->db->select('*')->from('kelas')->join('matakuliah', 'matakuliah.id_matakuliah=kelas.id_matakuliah', 'LEFT')->get()->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['matakuliah'] = $this->db->get('matakuliah')->result_array();
        $data['ruangan'] = $this->db->get('ruangan')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();


        $config = [
            [
                'field' => 'id_kelas',
                'label' => 'Kode Kelas',
                'rules' => 'required|trim|is_unique[kelas.id_kelas]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_kelas', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_kelas();
        }
    }

    private function add_kelas()
    {
        $data = [
            'id_kelas'             => htmlspecialchars($this->input->post('id_kelas', true)),
            'nama_kelas'           => htmlspecialchars($this->input->post('nama_kelas', true)),
            'id_dosen'             => htmlspecialchars($this->input->post('id_dosen', true)),
            'id_ruangan'           => htmlspecialchars($this->input->post('id_ruangan', true)),
            'id_matakuliah'        => htmlspecialchars($this->input->post('id_matakuliah', true)),
            'hari'                 => htmlspecialchars($this->input->post('hari', true)),
            'jam'                  => htmlspecialchars($this->input->post('jam', true)),
        ];

        if ($this->db->insert('kelas', $data)) {
            $this->session->set_flashdata('message_success', 'Data kelas ditambahkan ');
            redirect('admin/kelas');
        }
    }


    public function update_kelas($id)
    {
        $row = $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();
        if (!$row['id_kelas'] || !$id) {
            show_404();
        } else {
            $data = [
                'nama_kelas'           => htmlspecialchars($this->input->post('nama_kelas', true)),
                'id_dosen'             => htmlspecialchars($this->input->post('id_dosen', true)),
                'id_ruangan'           => htmlspecialchars($this->input->post('id_ruangan', true)),
                'id_matakuliah'        => htmlspecialchars($this->input->post('id_matakuliah', true)),
                'hari'                 => htmlspecialchars($this->input->post('hari', true)),
                'jam'                  => htmlspecialchars($this->input->post('jam', true)),
            ];

            if ($this->db->update('kelas', $data, ['id_kelas' => $id])) {
                $this->session->set_flashdata('message_success', 'Data kelas diperbarui ');
                redirect('admin/kelas');
            }
        }
    }

    public function delete_kelas($id)
    {
        $row = $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();
        if (empty($row['id_kelas'] || !$id)) {
            show_404();
        } else {
            $delete_kelas = $this->db->delete('kelas', ['id_kelas' => $id]);
            if ($delete_kelas) {
                $this->session->set_flashdata('message_success', 'Data kelas dihapus ');
                redirect('admin/kelas');
            }
        }
    }


    public function dosen()
    {
        $data['title'] = 'Dosen';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['user'] = $this->db->get('dosen')->result_array();

        $config = [
            [
                'field' => 'nama_dosen',
                'label' => 'Nama Dosen',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'nidn',
                'label' => 'NIDN',
                'rules' => 'required|trim|is_unique[dosen.nidn]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'id_dosen',
                'label' => 'Kode Dosen',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],


        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_dosen', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->add_dosen();
        }
    }
    private function add_dosen()
    {
        $data = [
            'id_dosen'             => htmlspecialchars($this->input->post('id_dosen', true)),
            'nama_dosen'           => htmlspecialchars($this->input->post('nama_dosen', true)),
            'nidn'                 => htmlspecialchars($this->input->post('nidn', true)),
            'id_user'              => htmlspecialchars($this->input->post('id_user', true)),
            'alamat '              => htmlspecialchars($this->input->post('alamat  ', true)),
        ];

        if ($this->db->insert('dosen', $data)) {
            $this->session->set_flashdata('message_success', 'Data dosen ditambahkan ');
            redirect('admin/dosen');
        }
    }

    public function update_dosen($id)
    {
        $row = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            show_404();
        } else {
            $data = [
                'nama_dosen'           => htmlspecialchars($this->input->post('nama_dosen', true)),
                'id_user'              => htmlspecialchars($this->input->post('id_user', true)),
                'alamat '              => htmlspecialchars($this->input->post('alamat  ', true)),
            ];

            if ($this->db->update('dosen', $data, ['id_dosen' => $id])) {
                $this->session->set_flashdata('message_success', 'Data dosen perbarui ');
                redirect('admin/dosen');
            }
        }
    }

    public function delete_dosen($id)
    {
        $row = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            show_404();
        } else {
            $this->db->delete('dosen', ['id_dosen' => $id]);
            $this->session->set_flashdata('message_success', 'Data dosen dihapus ');
            redirect('admin/dosen');
        }
    }


    public function setting()
    {
        $data['title'] = 'Setting';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get('user')->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/setting', $data);
        $this->load->view('template/backend/footer');
    }


    public function setting_account($id)
    {
        $data['title'] = 'Setting';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get('user')->result_array();

        $config = [
            [
                'filed' => 'email',
                'label' => 'email',
                'rules' => 'required|trim|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            [
                'field' => 'name',
                'label' => 'Username',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/setting', $data);
            $this->load->view('template/backend/footer');
        } else {
            $update_account = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
            ];

            if ($this->db->update('user', $update_account, ['id_user' => $id])) {
                $this->session->set_flashdata('message_success', 'Data berhasil di perbarui');
                redirect('admin/setting');
            }
        }
    }
}
