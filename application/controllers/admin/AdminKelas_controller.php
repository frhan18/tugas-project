<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminKelas_controller extends CI_Controller
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
        $data['title'] = 'Data Kelas';
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
            redirect('kelas/list');
        }
    }



    public function update_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['kode_kelas' => $id])->row_array();
        if (!$row['kode_kelas'] || !$id) {
            show_404();
        } else {
            $data = [
                'kode_kelas' => $this->input->post('kode_kelas', true),
                'nama_kelas' => $this->input->post('nama_kelas', true),
                'lokasi_kelas' => $this->input->post('lokasi_kelas', true),
            ];

            if ($this->db->update('tb_kelas', $data, ['kode_kelas' => $id])) {
                $this->session->set_flashdata('message_success', 'Data kelas berhasil diperbarui');
                redirect('kelas/list');
            }
        }
    }

    public function delete_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['kode_kelas' => $id])->row_array();
        if (!$row['kode_kelas'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_kelas', ['kode_kelas' => $id]);
            $this->session->set_flashdata('message_success', 'Data kelas berhasil dihapus');
            redirect('kelas/list');
        }
    }
}
