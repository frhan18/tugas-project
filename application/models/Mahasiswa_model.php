<?php

class Mahasiswa_model extends CI_Model
{

    public function get_mahasiswa()
    {
        $query = $this->db->select('*')
            ->from('mahasiswa')
            ->join('prodi', 'prodi.id_prodi=mahasiswa.id_prodi', 'LEFT')
            ->order_by('nim, nama_mhs, created_at', 'ASC');
        return $query->get();
    }

    public function insert($data)
    {
        $query = $this->db->insert('mahasiswa', $data);
        return $query;
    }

    public function update($data, $nim)
    {
        if (empty($nim)) {
            show_404();
        }

        $query = $this->db->update('mahasiswa', $data, ['nim' => $nim]);
        return $query;
    }

    public function delete($nim)
    {
        if (empty($nim)) {
            show_404();
        }

        $query = $this->db->delete('mahasiswa', ['nim' => $nim]);
        return $query;
    }
}
