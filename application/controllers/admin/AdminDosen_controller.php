<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminDosen_controller extends CI_Controller
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
        $data['title'] = 'Data Dosen';
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
            redirect('dosen/list');
        }
    }


    public function update_dosen($id)
    {
        $row = $this->db->get_where('tb_dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            show_404();
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
                redirect('dosen/list');
            }
        }
    }


    public function delete_dosen($id)
    {
        $row = $this->db->get_where('tb_dosen', ['id_dosen' => $id])->row_array();
        if (!$row['id_dosen'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_dosen', ['id_dosen' => $id]);
            $this->session->set_flashdata('message_success', 'Data dosen dihapus');
            redirect('dosen/list');
        }
    }
}
