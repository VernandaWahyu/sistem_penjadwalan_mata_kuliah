<?php

class M_ruang extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('ruang');
    }

    public function detail_ruang($id_ruang = null)
    {
        $query = $this->db->get_where('ruang', array('id_ruang' => $id_ruang))->row();
        return $query;
    }   

    public function delete_ruang($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_ruang($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}