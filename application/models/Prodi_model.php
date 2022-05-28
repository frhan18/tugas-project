<?php


class Prodi_model extends CI_Model
{

    public function get_prodi()
    {
        $query = $this->db->select('*')->from('prodi')->order_by('id_prodi, nama_prodi, is_active', 'ASC')->get();
        return $query;
    }

    public function insert($data)
    {
        $query = $this->db->insert('prodi', $data);
        return $query;
    }

    public function update($data, $id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->update('prodi', $data,  ['id_prodi' => $id]);

        return $query;
    }

    public function delete($id)
    {
        if (empty($id)) {
            show_404();
        }

        $query = $this->db->delete('prodi',  ['id_prodi' => $id]);

        return $query;
    }
}
