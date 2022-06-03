<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminMatakuliah_controller extends CI_Controller
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
        $data['title'] = 'Data Matakuliah';
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
            show_404();
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
            show_404();
        } else {
            $this->db->delete('tb_mata_kuliah', ['id_mata_kuliah' => $id]);
            $this->session->set_flashdata('message_success', 'Data matakuliah berhasil dihapus');
            redirect('admin/matakuliah');
        }
    }
}
