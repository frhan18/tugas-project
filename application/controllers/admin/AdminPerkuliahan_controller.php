<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminPerkuliahan_controller extends CI_Controller
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


    public function index() // Dashboard
    {
        $data['title'] = 'Data Perkuliahan';
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
            redirect('perkuliahan/list');
        }
    }

    public function edit_perkuliahan($id)
    {
        $row = $this->db->get_where('tb_perkuliahan', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
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
                redirect('perkuliahan/list');
            }
        }
    }

    public function delete_perkuliahan($id)
    {
        $row = $this->db->get_where('tb_perkuliahan', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_perkuliahan', ['id' => $id]);
            $this->session->set_flashdata('message_success', 'Data perkuliahan dihapus');
            redirect('perkuliahan/list');
        }
    }
}
