<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

    public function list()
    {

        $data['prodi'] = $this->db->get('prodi')->result_array();

        $config = [
            [
                'field' => 'id_prodi',
                'label'  => 'ID Prodi',
                'rules' => 'required|trim|is_unique[prodi.id_prodi]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{fiels} sudah terdaftar'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header');
            $this->load->view('template/backend/sidebar');
            $this->load->view('template/backend/topbar');
            $this->load->view('admin/list_prodi', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }


    private function _insert()
    {
        $data = [
            'id_prodi'   => htmlspecialchars($this->input->post('id_prodi', true)),
            'nama_prodi' => htmlspecialchars($this->input->post('nama_prodi', true)),
            'akreditasi' => htmlspecialchars($this->input->post('akreditasi', true)),
            'tahun'      => htmlspecialchars($this->input->post('tahun', true)),
            'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
        ];

        $data_saved = $this->db->insert('prodi', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data prodi  ditambahkan');
            redirect('admin-prodi');
        }
    }

    public function delete($id)
    {
        $rows = $this->db->get_where('prodi', ['id_prodi' => $id])->row_array();
        if (empty($rows['id_prodi'])) {
            show_404();
        } else {
            $this->db->delete('prodi', ['id_prodi' => $id]);
            $this->session->set_flashdata('message_success', 'Data prodi ' . $rows['nama_prodi'] . ' dihapus');
            redirect('admin-prodi');
        }
    }
}
