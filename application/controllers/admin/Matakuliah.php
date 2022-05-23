<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{

    public function list()
    {

        $data['matakuliah'] = $this->db->select('*')->from('matakuliah')->join('prodi', 'prodi.id_prodi=matakuliah.id_prodi')->get()->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $config = [
            [
                'field' => 'nama_matakuliah',
                'label' => 'Nama Matakuliah',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ],
            [
                'field' => 'sks',
                'label' => 'Jumlah SKS',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ],
            [
                'field' => 'semester',
                'label' => 'Semester aktif',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ],
            [
                'field' => 'id_prodi',
                'label' => 'Program studi',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ],
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $this->load->view('template/backend/header');
            $this->load->view('template/backend/sidebar');
            $this->load->view('template/backend/topbar');
            $this->load->view('admin/list_matakuliah', $data);
            $this->load->view('template/backend/footer');
        } else {
            $this->_insert();
        }
    }

    public function update($id)
    {
        $rows = $this->db->get_where('matakuliah', ['id_matakuliah' => $id])->row_array();
        if (empty($rows['id_matakuliah'])) {
            show_404();
        } else {
            $data = [
                'nama_matakuliah'       => htmlspecialchars($this->input->post('nama_matakuliah', true)),
                'sks'                   => htmlspecialchars($this->input->post('sks', true)),
                'semester'              => htmlspecialchars($this->input->post('semester', true)),
                'id_prodi'              => htmlspecialchars($this->input->post('id_prodi', true)),
            ];
            $data_update = $this->db->update('matakuliah', $data, ['id_matakuliah' => $id]);
            if ($data_update) {
                $this->session->set_flashdata('message_success', ' Data matakuliah '  . $rows['nama_matakuliah'] .  ' diperbarui');
                redirect('admin-matakuliah');
            }
        }
    }

    public  function delete($id)
    {
        $rows = $this->db->get_where('matakuliah', ['id_matakuliah' => $id])->row_array();
        if (empty($rows['id_matakuliah'])) {
            show_404();
        } else {
            $this->db->delete('matakuliah', ['id_matakuliah' => $id]);
            $this->session->set_flashdata('message_success', ' Data matakuliah ' . $rows['nama_matakuliah'] .   ' dihapus');
            redirect('admin-matakuliah');
        }
    }


    private function _insert()
    {
        $id_matakuliah = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        $data = [
            'id_matakuliah'         => $id_matakuliah,
            'nama_matakuliah'       => htmlspecialchars($this->input->post('nama_matakuliah', true)),
            'sks'                   => htmlspecialchars($this->input->post('sks', true)),
            'semester'              => htmlspecialchars($this->input->post('semester', true)),
            'id_prodi'              => htmlspecialchars($this->input->post('id_prodi', true)),
        ];

        $data_saved = $this->db->insert('matakuliah', $data);
        if ($data_saved) {
            $this->session->set_flashdata('message_success', 'Data matakuliah ditambahkan');
            redirect('admin-matakuliah');
        }
    }
}
