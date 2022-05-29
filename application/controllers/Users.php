<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('krs_model', 'krs', TRUE);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/dashboard', $data);
        $this->load->view('template/backend/footer');
    }

    public function krs($id = null)
    {
        $data['title'] = 'Krs';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->select('tb_mahasiswa.nama, tb_mahasiswa.nim, tb_krs.semester, tb_krs.tahun, tb_krs.kode_kelas')
            ->from('user')
            ->join('tb_mahasiswa', 'tb_mahasiswa.nim=user.nim', 'left')
            ->join('tb_krs', 'tb_krs.nim=user.nim', 'left')
            ->where('tb_mahasiswa.nim', $data['get_sesi_user']['nim'])
            ->get()->row_array();
        $data['krs'] = $this->db->select('tb_krs.id_mata_kuliah,tb_mata_kuliah.nama_mata_kuliah,tb_krs.sks, tb_kelas.kode_kelas')
            ->from('tb_krs')
            ->join('tb_kelas', 'tb_kelas.kode_kelas=tb_krs.kode_kelas')
            ->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_krs.id_mata_kuliah')
            ->where('tb_krs.nim', $data['get_sesi_user']['nim'])
            ->order_by('tb_mata_kuliah.nama_mata_kuliah', 'ASC')
            ->get()->result_array();



        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('users/krs', $data);
        $this->load->view('template/backend/footer');
    }
}
