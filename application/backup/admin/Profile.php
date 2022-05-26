<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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

    public function index()
    {
        $data['title'] = 'Profile';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('template/backend/footer');
    }
}
