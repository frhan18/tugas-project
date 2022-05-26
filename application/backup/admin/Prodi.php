<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id') || !$this->session->userdata('remember_me') || !$this->session->userdata('role')) {
            redirect('/login');
        } elseif ($this->session->userdata('role') == 2) {
            redirect('users/dashboard');
        } elseif ($this->session->userdata('role') == 3) {
            redirect('dosen/dashboard');
        }
    }

    public function list()
    {
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $config = [
            [
                'field' => 'id_prodi',
                'label'  => 'ID Prodi',
                'rules' => 'required|trim|is_unique[prodi.id_prodi]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_prodi', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }


    public function update($id)
    {
        $rows = $this->db->get_where('prodi', ['id_prodi' => $id])->row_array();
        if (empty($rows['id_prodi']) || !$id) {
            show_404();
        } else {
            $data = [
                'nama_prodi' => htmlspecialchars($this->input->post('nama_prodi', true)),
                'akreditasi' => htmlspecialchars($this->input->post('akreditasi', true)),
                'tahun'      => htmlspecialchars($this->input->post('tahun', true)),
                'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
            ];

            $data_saved = $this->db->update('prodi', $data, ['id_prodi' => $id]);
            if ($data_saved) {
                $this->session->set_flashdata('message_success', 'Data prodi di perbarui');
                redirect('admin-prodi');
            }
        }
    }


    private function _insert()
    {
        $data = [
            'id_prodi'   => htmlspecialchars($this->input->post('id_prodi', true)),
            'nama_prodi' => htmlspecialchars($this->input->post('nama_prodi', true)),
            'akreditasi' => htmlspecialchars($this->input->post('akreditasi', true)),
            'tahun'      => htmlspecialchars($this->input->post('tahun', true)),
            'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
        ];

        $data_saved = $this->db->insert('prodi', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data prodi  ditambahkan');
            redirect('admin-prodi');
        }
    }

    public function delete($id)
    {
        $rows = $this->db->get_where('prodi', ['id_prodi' => $id])->row_array();
        if (empty($rows['id_prodi'])) {
            show_404();
        } else {
            $this->db->delete('prodi', ['id_prodi' => $id]);
            $this->session->set_flashdata('message_success', 'Data prodi ' . $rows['nama_prodi'] . ' dihapus');
            redirect('admin-prodi');
        }
    }
}
