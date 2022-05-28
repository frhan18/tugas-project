<?php


class Matakuliah_model extends CI_Model
{

    public function get_matakuliah()
    {
        $query = $this->db->select('*')
            ->from('matakuliah')
            ->join('prodi', 'prodi.id_prodi=matakuliah.id_prodi')
            ->order_by('id_matakuliah, sks', 'ASC')
            ->get();

        return $query;
    }

    public function insert($data)
    {
        $query = $this->db->insert('matakuliah', $data);
        return $query;
    }

    public function update($data, $id)
    {
        if (empty($id)) {
            return;
        }

        $query = $this->db->update('matakuliah', $data, ['id_matakuliah' => $id]);
        return $query;
    }

    public function delete($id)
    {
        if (empty($id)) {
            return;
        }

        $query = $this->db->delete('matakuliah', ['id_matakuliah' => $id]);
        return $query;
    }
}
