<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminDashboard_controller extends CI_Controller
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


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->order_by('role_id, name')->get('user')->result_array();
        $data['count_all_mahasiswa'] = $this->db->count_all('tb_mahasiswa');
        $data['count_all_dosen'] = $this->db->count_all('tb_dosen');
        $data['count_all_matakuliah'] = $this->db->count_all('tb_mata_kuliah');
        $data['count_all_prodi'] = $this->db->count_all('tb_prodi');
        $data['count_all_user'] = $this->db->count_all('user');

        $data['berita'] = $this->db->get('tb_berita')->result_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/backend/footer');
    }



    public function hapus_pengguna($id)
    {
        $row = $this->db->get_where('user', ['id_user' => $id])->row_array();
        if (!$row['id_user'] || !$id) {
            show_404();
        } else {
            $this->db->delete('user', ['id_user' => $id]);
            redirect('dashboard');
        }
    }
}
