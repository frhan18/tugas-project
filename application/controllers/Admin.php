<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user', TRUE);
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
        // $data['user'] = $this->db->get('user')->result_array();
        $data['user'] = $this->user->get_user();
        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/list_account', $data);
        $this->load->view('template/backend/footer');
    }


    public function new_account()
    {
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
            $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
            $data['user'] = $this->db->get('user')->result_array();
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_account', $data);
            $this->load->view('template/backend/footer');
        } else {
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

            if ($this->db->insert('user', $data)) {
                $this->session->set_flashdata('message_success', 'Account berhasil dibuat');
                redirect('admin/user_account');
            }
        }
    }

    public function update_account($id)
    {
        $row = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (!$row['id_user'] || !$id) {
            show_404();
        } else {
            $data_update = [
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'role_id'       => $this->input->post('role_id', true),
                'is_active'     => $this->input->post('is_active', true),
                'updated_at'    => time(),
            ];

            if ($this->db->update('user', $data_update, ['id_user' => $id])) {
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
            $delete_user = $this->db->delete('user', ['id_user' => $id]);
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
        $data['mahasiswa'] = $this->db->select('*')
            ->from('mahasiswa')
            ->join('prodi', 'prodi.id_prodi=mahasiswa.id_prodi')
            ->join('user', 'user.id_user=mahasiswa.id_user')
            ->get()->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/list_mahasiswa', $data);
        $this->load->view('template/backend/footer');
    }

    public function add_mahasiswa()
    {
        $config = [
            [
                'field' => 'id_user',
                'label' => 'ID User',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
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
                'field' => 'tempat_tanggal_lahir',
                'label' => 'Tempat Tanggal Lahir',
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
            $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
            $data['mahasiswa'] = $this->db->select('*')
                ->from('mahasiswa')
                ->join('prodi', 'prodi.id_prodi=mahasiswa.id_prodi')
                ->join('user', 'user.id_user=mahasiswa.id_user')
                ->get()->result_array();

            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_mahasiswa', $data);
            $this->load->view('template/backend/footer');
        } else {
            $data = [
                'id_user' => $this->input->post('id_user', true),
                'nim' => htmlspecialchars($this->input->post('nim', true)),
                'tempat_tanggal_lahir' => htmlspecialchars($this->input->post('tempat_tanggal_lahir', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'id_prodi' => $this->input->post('id_prodi', true),
                'created_at' => time(),
                'updated_at' => time(),
            ];

            if ($this->db->insert('mahasiswa', $data)) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa ditambahkan');
                redirect('admin/mahasiswa');
            }
        }
    }

    public function update_mahasiswa($id)
    {
        $row = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $data = [
                'id_user' => $this->input->post('id_user', true),
                'tempat_tanggal_lahir' => htmlspecialchars($this->input->post('tempat_tanggal_lahir', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'id_prodi' => $this->input->post('id_prodi', true),
                'updated_at' => time(),
            ];

            if ($this->db->update('mahasiswa', $data, ['nim' => $id])) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa ' . $row['nim'] . ' diperbarui');
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
            $delete_mahasiswa = $this->db->delete('mahasiswa', ['nim' => $id]);
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
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/list_prodi', $data);
        $this->load->view('template/backend/footer');
    }

    public function add_prodi()
    {
        $config = [
            [
                'field' => 'id_prodi',
                'label' => 'ID Prodi',
                'rules' => 'required|trim',
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
            $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
            $data['prodi'] = $this->db->get('prodi')->result_array();

            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_prodi', $data);
            $this->load->view('template/backend/footer');
        } else {
            $data  = [
                'id_prodi'    => htmlspecialchars($this->input->post('id_prodi', true)),
                'nama_prodi'  => htmlspecialchars($this->input->post('nama_prodi', true)),
                'akreditasi'  => htmlspecialchars($this->input->post('akreditasi', true)),
                'tahun'       => htmlspecialchars($this->input->post('tahun', true)),
                'is_active'   => $this->input->post('is_active', true)
            ];

            if ($this->db->insert('prodi', $data)) {
                $this->session->set_flashdata('message_success', 'Data prodi ditambahkan');
                redirect('admin/prodi');
            }
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

            if ($this->db->update('prodi', $data, ['id_prodi' => $id])) {
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
            $delete_prodi = $this->db->delete('prodi', ['id_prodi' => $id]);
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
        $data['matakuliah'] = $this->db->select('*')
            ->from('matakuliah')
            ->join('prodi', 'prodi.id_prodi=matakuliah.id_prodi')
            ->get()->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/list_matakuliah', $data);
        $this->load->view('template/backend/footer');
    }

    public function add_matakuliah()
    {
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
            $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
            $data['matakuliah'] = $this->db->select('*')
                ->from('matakuliah')
                ->join('prodi', 'prodi.id_prodi=matakuliah.id_prodi')
                ->get()->result_array();

            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_matakuliah', $data);
            $this->load->view('template/backend/footer');
        } else {
            $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
            $data = [
                'id_matakuliah' => $id,
                'nama_matakuliah' => htmlspecialchars($this->input->post('nama_matakuliah', true)),
                'sks'    => htmlspecialchars($this->input->post('sks', true)),
                'semester'    => htmlspecialchars($this->input->post('semester', true)),
                'id_prodi'    => htmlspecialchars($this->input->post('id_prodi', true)),
            ];

            if ($this->db->insert('matakuliah', $data)) {
                $this->session->set_flashdata('message_success', 'Data matakuliah ditambahkan');
                redirect('admin/matakuliah');
            }
        }
    }

    public function delete_matakuliah($id)
    {
        $row = $this->db->get_where('matakuliah', ['id_matakuliah' => $id])->row_array();
        if (!$row['id_matakuliah'] || !$id) {
            show_404();
        } else {
            $delete_matakuliah = $this->db->delete('matakuliah', ['id_matakuliah' => $id]);
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
                'sks'    => htmlspecialchars($this->input->post('sks', true)),
                'semester'    => htmlspecialchars($this->input->post('semester', true)),
                'id_prodi'    => htmlspecialchars($this->input->post('id_prodi', true)),
            ];

            if ($this->db->update('matakuliah', $data, ['id_matakuliah' => $id])) {
                $this->session->set_flashdata('message_success', 'Data matakuliah ' . $row['nama_matakuliah']  . ' diperbarui');
                redirect('admin/matakuliah');
            }
        }
    }
}
