<?php
class M_pengampu extends CI_Model {
    
    public function tampil_data() {
        $this->db->select('pengampu.id_pengampu, dosen.nik, dosen.nama_dosen, mata_kuliah.kode_matakuliah, kelas.nama_kelas');
        $this->db->from('pengampu');
        $this->db->join('dosen', 'pengampu.id_dosen = dosen.id_dosen');
        $this->db->join('kelas', 'pengampu.id_kelas = kelas.id_kelas');
        $this->db->join('mata_kuliah', 'pengampu.id_matkul = mata_kuliah.id_matkul');
        $query = $this->db->get();
        return $query;
    }

    public function insert_multiple_data($data, $table) {
        $this->db->insert_batch($table, $data);
    }

    public function detail_pengampu($id_pengampu = null) {
        $query = $this->db->get_where('pengampu', array('id_pengampu' => $id_pengampu))->row();
        return $query;
    }   

    public function delete_pengampu($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_pengampu($where, $table) {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
