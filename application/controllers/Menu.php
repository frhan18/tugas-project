<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model', 'menu', TRUE);

        _is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Menu management';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['menu'] = $this->menu->get_menu();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('template/backend/footer');
    }

    public function add_menu()
    {
        $config = [
            [
                'field' => 'menu',
                'label' => 'Menu',
                'rules' => 'required|trim|is_unique[user_menu.menu]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia'
                ]
            ]
        ];

        $this->form_validation->set_rules($config);
        if (!$this->form_validation->run()) {
            $data['title'] = 'Menu management';
            $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
            $data['menu'] = $this->menu->get_menu();

            $this->load->view('template/backend/header', $data);
            $this->load->view('template/backend/sidebar', $data);
            $this->load->view('template/backend/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/backend/footer');
        } else {
            $data = ['menu' => htmlspecialchars($this->input->post('menu', true))];
            if ($this->menu->menu_insert($data)) {
                $this->session->set_flashdata('message_success', 'Data menu di tambahkan');
                redirect('menu/index');
            }
        }
    }

    public function delete_menu($id)
    {
        $row = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $this->menu->delete_menu($id);
            $this->session->set_flashdata('message_success', 'Data menu di dihapus');
            redirect('menu/index');
        }
    }

    public function update_menu($id)
    {
        $row = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $data = ['menu' => htmlspecialchars($this->input->post('menu', true))];
            if ($this->menu->menu_update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Data menu di perbarui');
                redirect('menu/index');
            }
        }
    }

    public function submenu() // Submenu
    {
        $data['title'] = 'Submenu management';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['submenu'] = $this->menu->get_submenu();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('template/backend/footer');
    }

    public function add_submenu()
    {
        $data = [
            'menu_id'    => $this->input->post('menu_id', true),
            'title'      => htmlspecialchars($this->input->post('title', true)),
            'url'        => htmlspecialchars($this->input->post('url', true)),
            'icon'       => htmlspecialchars($this->input->post('icon', true)),
            'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
        ];

        if ($this->menu->submenu_insert($data)) {
            $this->session->set_flashdata('message_success', 'Submenu ditambahkan');
            redirect('menu/submenu');
        }
    }


    public function delete_submenu($id)
    {
        $row = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

        if (!$row['id'] || !$id) {
            show_404();
        } else {
            if ($this->menu->submenu_delete($id)) {
                $this->session->set_flashdata('message_success', 'Submenu ' . $row['title']  . ' dihapus');
                redirect('menu/submenu');
            }
        }
    }

    public function update_submenu($id)
    {
        $row = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $data = [
                'menu_id'    => $this->input->post('menu_id', true),
                'title'      => htmlspecialchars($this->input->post('title', true)),
                'url'        => htmlspecialchars($this->input->post('url', true)),
                'icon'       => htmlspecialchars($this->input->post('icon', true)),
                'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
            ];

            if ($this->menu->submenu_update($data, $id)) {
                $this->session->set_flashdata('message_success', 'Submenu ' . $row['title'] . ' diperbarui');
                redirect('menu/submenu');
            }
        }
    }


    public function access() // access
    {
        $data['title'] = 'Access menu';
        $data['get_sesi_user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['access_menu'] = $this->db->get('user_access_menu')->result_array();
        $data['access_menu'] = $this->menu->join_user_access();



        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('template/backend/topbar', $data);
        $this->load->view('menu/access_menu', $data);
        $this->load->view('template/backend/footer');
    }


    public function add_access_menu()
    {
        $menu_access = [
            'role_id' => $this->input->post('role_id', true),
            'menu_id' => $this->input->post('menu_id', true),
        ];

        if ($this->menu->access_menu_insert($menu_access)) {
            $this->session->set_flashdata('message_success', 'Access menu ditambahkan');
            redirect('menu/access');
        }
    }

    public function update_access_menu($id)
    {
        $row = $this->db->get_where('user_access_menu', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            $menu_access = [
                'role_id' => $this->input->post('role_id', true),
                'menu_id' => $this->input->post('menu_id', true),
            ];

            if ($this->menu->update_access_menu($menu_access, $id)) {
                $this->session->set_flashdata('message_success', 'Access menu di perbarui');
                redirect('menu/access');
            }
        }
    }

    public function delete_access_menu($id)
    {
        $row = $this->db->get_where('user_access_menu', ['id' => $id])->row_array();
        if (!$row['id'] || !$id) {
            show_404();
        } else {
            if ($this->menu->delete_menu($id)) {
                $this->session->set_flashdata('message_success', 'Access menu di dihapus');
                redirect('menu/access');
            }
        }
    }
}
