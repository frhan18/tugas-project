<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminKrs_controller extends CI_Controller
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
        $data['title'] = 'Data Krs';
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
            show_404();
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
            show_404();
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
}
