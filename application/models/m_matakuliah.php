<?php

class M_matakuliah extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('mata_kuliah');
        return $query;
    }

    public function detail_matakuliah($id_matkul = null)
    {
        $query = $this->db->get_where('mata_kuliah', array('id_matkul' => $id_matkul))->row();
        return $query;
    }   

    public function delete_matakuliah($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_matakuliah($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}