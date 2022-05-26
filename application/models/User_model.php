<?php

class User_model extends CI_Model
{
    public function login_user($nim)
    {
        return $this->db->select('*')
            ->from('user')
            ->join('mahasiswa', 'mahasiswa.id_user=user.id_user')
            ->where('nim', $nim)
            ->get();
    }

    public function login_admin($email)
    {
        return $this->db->select('*')
            ->from('user')
            ->where('email', $email)
            ->or_where('name', $email)
            ->get();
    }

    public function get_user()
    {
        $query = "SELECT `user`.*, `user_role`.`role_name`
                FROM `user`
                INNER JOIN `user_role`ON `user`.`role_id`= `user_role`.`role_id`";

        return $this->db->query($query)->result_array();
    }
    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update($data, $id)
    {
        return $this->db->update('user', $data, ['id_user' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('user', ['id_user' => $id]);
    }
}
