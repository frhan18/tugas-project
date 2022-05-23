<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function list()
    {
        $array_agama = [
            [
                'key' => 'islam',
                'value' => 'Islam'
            ],
            [
                'key' => 'kristen',
                'value' => 'Kristen'
            ],
            [
                'key' => 'konghucu',
                'value' => 'Konghucu'
            ]
        ];
        $array_jk = [
            [
                'key' => 'L',
                'value' => 'Laki-Laki'
            ],
            [
                'key' => 'P',
                'value' => 'Perempuan'
            ]
        ];

        $data = [
            'error' => form_error(),
            'agama' => $array_agama,
            'jenis_kelamin' => $array_jk,
            'mahasiswa' => $this->db->select('*')
                ->from('mahasiswa')
                ->join('prodi', 'prodi.id_prodi=mahasiswa.id_prodi')
                ->get()->result_array(),
            'prodi' => $this->db->get('prodi')->result_array(),
        ];



        $this->load->view('template/backend/header');
        $this->load->view('template/backend/sidebar');
        $this->load->view('template/backend/topbar');
        $this->load->view('admin/list_mahasiswa', $data);
        $this->load->view('template/backend/footer');
    }


    public function insert()
    {
        $config = [
            [
                'field' => 'nim',
                'label' => 'Nim',
                'rules' => 'required|trim|is_unique[mahasiswa.nim]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!'
                ]
            ],
            [
                'field' => 'nama_mhs',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'no_hp',
                'label' => 'NO HP',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'agama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            [
                'field' => 'id_prodi',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
        ];

        $this->form_validation->set_rules($config);

        if (!$this->form_validation->run()) {
            $array_agama = [
                [
                    'key' => 'islam',
                    'value' => 'Islam'
                ],
                [
                    'key' => 'kristen',
                    'value' => 'Kristen'
                ],
                [
                    'key' => 'konghucu',
                    'value' => 'Konghucu'
                ]
            ];
            $array_jk = [
                [
                    'key' => 'L',
                    'value' => 'Laki-Laki'
                ],
                [
                    'key' => 'P',
                    'value' => 'Perempuan'
                ]
            ];

            $data = [
                'error' => form_error(),
                'agama' => $array_agama,
                'jenis_kelamin' => $array_jk,
                'mahasiswa' => $this->db->select('*')
                    ->from('mahasiswa')
                    ->join('prodi', 'prodi.id_prodi=mahasiswa.id_prodi')
                    ->get()->result_array(),
                'prodi' => $this->db->get('prodi')->result_array(),
            ];
            $this->load->view('template/backend/header');
            $this->load->view('template/backend/sidebar');
            $this->load->view('template/backend/topbar');
            $this->load->view('admin/list_mahasiswa', $data);
            $this->load->view('template/backend/footer');
        } else {
            $id_user = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 12);
            $data = [
                'nim'               => htmlspecialchars($this->input->post('nim', true)),
                'nama_mhs'          => htmlspecialchars($this->input->post('nama_mhs', true)),
                'no_hp'             => htmlspecialchars($this->input->post('no_hp')),
                'agama'             => $this->input->post('agama', true),
                'jenis_kelamin'     => $this->input->post('jenis_kelamin', true),
                'id_user'           => $id_user,
                'id_prodi'          => $this->input->post('id_prodi', true),
            ];

            $data_saved = $this->db->insert('mahasiswa', $data);
            if ($data_saved) {
                $this->session->set_flashdata('message_success', 'Data mahasiswa ditambahkan');
                redirect('/admin-mahasiswa');
            }
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
            $data_update = $this->db->update('mahasiswa', $data, ['nim' => $nim]);
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
            $this->db->delete('mahasiswa', ['nim' => $nim]);
            $this->session->set_flashdata('message_success', 'Data mahasiswa '  .  $rows['nim'] . ' dihapus');
            redirect('/admin-mahasiswa');
        }
    }
}
