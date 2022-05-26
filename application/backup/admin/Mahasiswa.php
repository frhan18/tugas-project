<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_model', 'mahasiswa', TRUE);

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
        $data['title'] = 'Mahasiswa';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['mahasiswa'] = $this->mahasiswa->join_prodi()->result_array();

        $config = [
            [
                'field' => 'id_user',
                'label' => 'ID User',
                'rules' => 'required|trim|is_unique[mahasiswa.id_user]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('admin/list_mahasiswa', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }


    private function _insert()
    {
        $data = [
            'id_user'            => htmlspecialchars($this->input->post('id_user', true)),
            'nim'                => htmlspecialchars($this->input->post('nim', true)),
            'nama_mhs'           => htmlspecialchars($this->input->post('nama_mhs', true)),
            'no_hp'              => htmlspecialchars($this->input->post('no_hp', true)),
            'agama'              => $this->input->post('agama', true),
            'jenis_kelamin'      => $this->input->post('jenis_kelamin', true),
            'id_prodi'           => $this->input->post('id_prodi', true),
            'created_at'         => time(),
            'updated_at'         => time(),
        ];

        $data_saved = $this->mahasiswa->insert($data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data mahasiswa  di tambahkan');
            redirect('/admin-mahasiswa');
        }
    }


    public function update($nim)
    {
        $rows = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        if (empty($rows['nim'])) {
            show_404();
        } else {
            $data = [
                'nama_mhs'          => htmlspecialchars($this->input->post('nama_mhs', true)),
                'no_hp'             => htmlspecialchars($this->input->post('no_hp')),
                'agama'             => $this->input->post('agama', true),
                'jenis_kelamin'     => $this->input->post('jenis_kelamin', true),
                'id_prodi'          => $this->input->post('id_prodi', true),
            ];
            $data_update = $this->mahasiswa->update($data, $nim);
            if ($data_update) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa ' . $rows['nim'] . ' di update');
                redirect('/admin-mahasiswa');
            }
        }
    }

    public function delete($nim)
    {
        $rows = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        if (empty($rows['nim'])) {
            show_404();
        } else {
            $this->mahasiswa->delete($nim);
            $this->session->set_flashdata('message_success', 'Data mahasiswa '  .  $rows['nim'] . ' dihapus');
            redirect('/admin-mahasiswa');
        }
    }
}
