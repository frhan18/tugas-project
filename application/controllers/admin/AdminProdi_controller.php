<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminProdi_controller extends CI_Controller
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
        $data['title'] = 'Data Prodi';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();
        $data['count_tb_prodi'] = $this->db->count_all('tb_prodi');
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
            $this->session->set_flashdata('message_success', 'Data prodi  ditambahkan');
            redirect('data-prodi');
        }
    }
    public function update_prodi($id)
    {
        $row = $this->db->get_where('tb_prodi', ['kode_prodi' => $id])->row_array();
        if (!$row['kode_prodi'] || !$id) {
            show_404();
        } else {
            $data = [
                'kode_prodi' => $this->input->post('kode_prodi', true),
                'nama_prodi' => $this->input->post('nama_prodi', true),
            ];

            if ($this->db->update('tb_prodi', $data, ['kode_prodi' => $id])) {
                $this->session->set_flashdata('message_success', 'Data prodi  diperbarui');
                redirect('data-prodi');
            }
        }
    }

    public function delete_prodi($id)
    {
        $row = $this->db->get_where('tb_prodi', ['kode_prodi' => $id])->row_array();
        if (!$row['kode_prodi'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_prodi', ['kode_prodi' => $id]);
            $this->session->set_flashdata('message_success', 'Data prodi  dihapus');
            redirect('data-prodi');
        }
    }
}
