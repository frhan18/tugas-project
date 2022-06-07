<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminMahasiswa_controller extends CI_Controller
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

    public function index() // Mahasiswa
    {
        $data['title'] = 'Data Mahasiswa';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['mahasiswa'] = $this->db->get('tb_mahasiswa')->result_array();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $data['count_tb_mahasiswa'] = $this->db->count_all('tb_mahasiswa');
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
                'field' => 'kode_kelas',
                'label' => 'Kode kelas',
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
            'agama'                 => $this->input->post('agama', true),
            'jenis_kelamin'         => $this->input->post('jenis_kelamin', true),
            'tahun_masuk'           => $this->input->post('tahun_masuk', true),
            'alamat'                => $this->input->post('alamat', true),
            'kode_kelas'            => $this->input->post('kode_kelas', true),
        ];

        if ($this->db->insert('tb_mahasiswa', $data)) {
            $this->session->set_flashdata('message_success', 'Data mahasiswa ditambahkan');
            redirect('data-mahasiswa');
        }
    }

    public function update_mahasiswa($id)
    {
        $row = $this->db->get_where('tb_mahasiswa', ['nim' => $id])->row_array();
        if (!$row['nim'] || !$id) {
            show_404();
        } else {
            $data = [
                'nim'                   => $this->input->post('nim', true),
                'nama'                  => $this->input->post('nama', true),
                'tempat_tanggal_lahir'  => $this->input->post('tempat_tanggal_lahir', true),
                'agama'                 => $this->input->post('agama', true),
                'jenis_kelamin'         => $this->input->post('jenis_kelamin', true),
                'tahun_masuk'           => $this->input->post('tahun_masuk', true),
                'alamat'                => $this->input->post('alamat', true),
                'kode_kelas'            => $this->input->post('kode_kelas', true),
            ];

            if ($this->db->update('tb_mahasiswa', $data, ['nim' => $id])) {
                $this->session->set_flashdata('message_success', ' Data mahasiswa ' . $row['nim'] .  ' di perbarui.');
                redirect('data-mahasiswa');
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
                $this->session->set_flashdata('message_success', ' Data mahasiswa ' . $row['nim'] .  ' di hapus.');
                redirect('data-mahasiswa');
            }
        }
    }
}
