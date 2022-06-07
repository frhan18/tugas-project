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
        // $data['kelas'] = $this->db->select('*')->from('tb_kelas')->where('kode_kelas', 'SIS1J')->get()->result_array();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $data['count_tb_kelas'] = $this->db->count_all('tb_kelas');
        $config = [
            [
                'field' => 'kode_kelas',
                'label' => 'Kode kelas',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],     [
                'field' => 'nama_kelas',
                'label' => 'Nama kelas',
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


    public function detail_kelas($id)
    {
        $data['title'] = 'Data Kelas';
        $data['kelas_id'] = $id;
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['kelas_where'] = $this->db->select('*')->from('tb_kelas')->join('tb_mahasiswa', 'tb_mahasiswa.kode_kelas=tb_kelas.kode_kelas')->where('tb_kelas.kode_kelas', $id)->get()->result_array();
        $data['count_tb_mahasiswa'] = $this->db->count_all('tb_mahasiswa');
        $rows = $this->db->get_where('tb_kelas', ['kode_kelas' => $id])->row_array();

        if (!$rows['kode_kelas'] || !$id) {
            show_404();
        }

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/kelas-detail', $data);
        $this->load->view('template/backend/footer');
    }

    private function add_kelas()
    {
        $data = [
            'kode_kelas' => $this->input->post('kode_kelas', true),
            'nama_kelas' => $this->input->post('nama_kelas', true),
        ];

        if ($this->db->insert('tb_kelas', $data)) {
            $this->session->set_flashdata('message_success', 'Data kelas ditambahkan');
            redirect('data-kelas');
        }
    }



    public function update_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $data = [
                'kode_kelas' => $this->input->post('kode_kelas', true),
                'nama_kelas' => $this->input->post('nama_kelas', true),
            ];

            if ($this->db->update('tb_kelas', $data, ['id' => $id])) {
                $this->session->set_flashdata('message_success', 'Data kelas  diperbarui');
                redirect('data-kelas');
            }
        }
    }

    public function delete_kelas($id)
    {
        $row = $this->db->get_where('tb_kelas', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_kelas', ['id' => $id]);
            $this->session->set_flashdata('message_success', 'Data kelas  dihapus');
            redirect('data-kelas');
        }
    }
}
