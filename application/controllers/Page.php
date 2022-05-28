<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

    public function index()
    {
        $this->load->view('template/page/header');
        $this->load->view('template/page/index');
        $this->load->view('template/page/footer');
    }
}
