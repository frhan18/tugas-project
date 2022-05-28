<?php

class User_model extends CI_Model
{

    public function access_app($email)
    {
        $query = $this->db->select('user.*')
            ->from('user')
            ->where('name', $email)
            ->or_where('email', $email)
            ->get()->row_array();

        return $query;
    }


    public function access_app_member($nim)
    {
        $query = $this->db->select('*')->from('user')
            ->where('nim', $nim)
            ->join('mahasiswa', 'mahasiswa.id_user=user.id_user', 'LEFT')->get();


        return $query;
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
