<?php

class Krs_model extends CI_Model
{

    public function joinMK()
    {
        $this->db->select('*');
        $this->db->from('tb_krs');
        $this->db->join('tb_kelas', 'tb_kelas.kode_kelas=tb_krs.kode_kelas', 'left');
        $this->db->join('tb_mata_kuliah', 'tb_mata_kuliah.id_mata_kuliah=tb_mata_kuliah.id_mata_kuliah');
        $query = $this->db->get();
        return $query->result_array();
    }
}
