<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/backend/header');
        $this->load->view('template/backend/sidebar');
        $this->load->view('template/backend/topbar');
        $this->load->view('template/backend/index');
        $this->load->view('template/backend/footer');
    }
}
