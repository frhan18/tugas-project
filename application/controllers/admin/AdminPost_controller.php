<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminPost_controller extends CI_Controller
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
        $data['title'] = 'Berita';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['berita'] = $this->db->get('tb_berita')->result_array();

        $config = [
            [
                'field' => 'judul_berita',
                'label' => 'Judul berita',
                'rules' => 'required|trim|is_unique[tb_berita.judul_berita]',
                'errors' => [
                    'required' => '{field} berita belum di isi',
                    'is_unique' => '{field} berita sudah diterbitkan'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/berita', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->tambahBerita();
        }
    }

    public function tambahBerita()
    {
        $data = [
            'judul_berita' => $this->input->post('judul_berita', true),
            'penulis'      => $this->input->post('penulis', true),
            'content'      => $this->input->post('content', true),
            'created_at'   => time(),
            'is_active'    => $this->input->post('is_active', true)
        ];

        if ($this->db->insert('tb_berita', $data)) {
            $this->session->set_flashdata('berita_berhasil', 'Berita baru  ditambahkan');
            redirect('post');
        }
    }

    public function update_berita($id)
    {
        $rows = $this->db->get_where('tb_berita', ['id_berita' => $id])->row_array();
        if (!$rows['id_berita'] || !$id) {
            show_404();
        } else {
            $data = [
                'judul_berita' => $this->input->post('judul_berita', true),
                'penulis'      => $this->input->post('penulis', true),
                'content'      => $this->input->post('content', true),
                'is_active'    => $this->input->post('is_active', true)
            ];

            if ($this->db->update('tb_berita', $data, ['id_berita' => $id])) {
                $this->session->set_flashdata('berita_berhasil', 'Data Berita  diperbarui.');
                redirect('post');
            }
        }
    }

    public function delete_berita($id)
    {
        $rows = $this->db->get_where('tb_berita', ['id_berita' => $id])->row_array();
        if (!$rows['id_berita'] || !$id) {
            show_404();
        } else {
            $this->db->delete('tb_berita', ['id_berita' => $id]);
            $this->session->set_flashdata('berita_berhasil', 'Data Berita  dihapus.');
            redirect('post');
        }
    }
}
