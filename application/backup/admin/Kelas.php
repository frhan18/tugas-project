<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['kelas'] = $this->db->select('*')
        //     ->from('kelas')
        //     ->join('dosen', 'dosen.id_dosen=kelas.id_dosen')
        //     ->join('ruangan', 'ruangan.id_ruangan=kelas.id_ruangan')
        //     ->join('matakuliah', 'matakuliah.id_matakuliah=kelas.id_matakuliah')
        //     ->get()->result_array();
        $config = [
            [
                'field' => 'id_kelas',
                'label' => 'ID Kelas',
                'rules' => 'required|trim|is_unique[kelas.id_kelas]'
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_kelas', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }

    private function _insert()
    {
        $data = [
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
            'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas')),
            'id_dosen' => htmlspecialchars($this->input->post('id_dosen', true)),
            'id_ruangan' => htmlspecialchars($this->input->post('id_ruangan', true)),
            'id_matakuliah' => htmlspecialchars($this->input->post('id_matakuliah', true)),
            'jam' => htmlspecialchars($this->input->post('jam', true)),
            'hari' => htmlspecialchars($this->input->post('hari', true)),
        ];

        $data_saved = $this->db->insert('kelas', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data kelas ditambahkan');
            redirect('admin-kelas');
        }
    }


    public function delete($id)
    {
        $rows = $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();
        if (empty($rows['id_kelas'] || !$id)) {
            show_404();
        } else {
            $this->db->delete('kelas', ['id_kelas' => $id]);
            $this->session->set_flashdata('message_success', 'Data kelas dihapus');
            redirect('admin-kelas');
        }
    }
}
