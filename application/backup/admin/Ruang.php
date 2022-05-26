<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang extends CI_Controller
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
        $data['ruang'] = $this->db->get('ruangan')->result_array();

        $config = [
            [
                'field' => 'id_ruangan',
                'label' => 'ID Ruangan',
                'rules' => 'required|trim|is_unique[ruangan.id_ruangan]',
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
            $this->load->view('admin/list_ruang', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }

    public function update($id)
    {
        $rows = $this->db->get_where('ruangan', ['id_ruangan' => $id])->row_array();
        if (empty($rows['id_ruangan'] || !$id)) {
            show_404();
        } else {
            $data = [
                'nama_ruangan'  => htmlspecialchars($this->input->post('nama_ruangan', true)),
                'kapasitas'     => htmlspecialchars($this->input->post('kapasitas', true)),
                'nama_gedung'   => htmlspecialchars($this->input->post('nama_gedung', true)),
            ];

            $data_update = $this->db->update('ruangan', $data, ['id_ruangan' => $id]);
            if ($data_update) {
                $this->session->set_flashdata('message_success', 'Data ruangan diperbarui');
                redirect('admin-ruang');
            }
        }
    }


    private function _insert()
    {
        $data = [
            'id_ruangan'    => htmlspecialchars($this->input->post('id_ruangan', true)),
            'nama_ruangan'  => htmlspecialchars($this->input->post('nama_ruangan', true)),
            'kapasitas'     => htmlspecialchars($this->input->post('kapasitas', true)),
            'nama_gedung'   => htmlspecialchars($this->input->post('nama_gedung', true)),
        ];

        $data_saved = $this->db->insert('ruangan', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data ruangan ditambahkan');
            redirect('admin-ruang');
        }
    }
}
