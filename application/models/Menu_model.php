<?php

class Menu_model extends CI_Model
{

    public function get_menu()
    {
        $query = $this->db
            ->select('*')
            ->from('user_menu')
            ->order_by('id', 'asc');
        return $query->get()->result_array();
    }

    public function menu_insert($data)
    {
        $query = $this->db->insert('user_menu', $data);
        return $query;
    }

    public function menu_update($data, $id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->update('user_menu', $data, ['id' => $id]);
        return $query;
    }

    public function delete_menu($id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->delete('user_menu', ['id' => $id]);
        return $query;
    }


    public function get_submenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu` . `menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`

        ";

        return $this->db->query($query)->result_array();
    }


    public function submenu_insert($data)
    {
        $query = $this->db->insert('user_sub_menu', $data);
        return $query;
    }

    public function submenu_update($data, $id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->update('user_sub_menu', $data, ['id' => $id]);
        return $query;
    }

    public function submenu_delete($id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->delete('user_sub_menu', ['id' => $id]);
        return $query;
    }

    public function join_user_access()
    {
        $query = "SELECT `user_access_menu`.*, `user_menu`. `menu` , `user_role`.`role_name`
                    FROM `user_access_menu`
                    JOIN `user_menu` ON `user_access_menu`.`menu_id` = `user_menu`.`id`
                    JOIN `user_role` ON `user_access_menu`.`role_id` = `user_role`. `role_id`
           ";

        return $this->db->query($query)->result_array();
    }



    public function access_menu_insert($data)
    {
        $query = $this->db->insert('user_access_menu', $data);
        return $query;
    }

    public function update_access_menu($data, $id)
    {
        if (empty($id)) {
            show_404();
        }
        $query = $this->db->update('user_access_menu', $data, ['id' => $id]);
        return $query;
    }


    public function acces_menu_delete($id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->delete('user_access_menu', ['id' => $id]);
        return $query;
    }
}
