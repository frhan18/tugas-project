<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
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
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $config = [

            [
                'field' => 'id_dosen',
                'label' => 'ID Dosen',
                'rules' => 'required|trim|is_unique[dosen.id_dosen]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_dosen', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }



    private function _insert()
    {
        $data = [
            'id_dosen'   => htmlspecialchars($this->input->post('id_dosen', true)),
            'id_user'   => htmlspecialchars($this->input->post('id_user', true)),
            'nidn'       => htmlspecialchars($this->input->post('nidn', true)),
            'nama_dosen' => htmlspecialchars($this->input->post('nama_dosen', true)),
            'alamat'     => htmlspecialchars($this->input->post('alamat', true)),
        ];
        $data_saved = $this->db->insert('dosen', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data dosen ditambahkan');
            redirect('admin-dosen');
        }
    }

    public function update($id)
    {
        $rows = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
        if (empty($rows['id_dosen'] || !$id)) {
            show_404();
        } else {
            $data = [
                'nama_dosen' => htmlspecialchars($this->input->post('nama_dosen', true)),
                'alamat'     => htmlspecialchars($this->input->post('alamat', true)),
            ];
            $data_updated = $this->db->update('dosen', $data, ['id_dosen' => $id]);
            if ($data_updated) {
                $this->session->set_flashdata('message_success', 'Data dosen diperbarui');
                redirect('admin-dosen');
            }
        }
    }

    public function delete($id)
    {
        $rows = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();

        if (empty($rows['id_dosen'] || !$id)) {
            show_404();
        } else {
            $this->db->delete('dosen', ['id_dosen' => $id]);
            $this->session->set_flashdata('message_success', 'Data dosen di hapus');
            redirect('admin-dosen');
        }
    }
}
