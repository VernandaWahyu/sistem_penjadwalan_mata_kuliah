<?php

class M_dosen extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('dosen');
        return $query;
    }

    public function detail_dosen($nik = null)
    {
        $query = $this->db->get_where('dosen', array('nik' => $nik))->row();
        return $query;
    }   

    public function delete_dosen($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_dosen($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}