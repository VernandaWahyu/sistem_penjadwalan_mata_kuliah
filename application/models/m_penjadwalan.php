<?php

class M_penjadwalan extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('penjadwalan.*, dosen.nama_dosen, mata_kuliah.nama_matakuliah, ruang.no_ruang');
        $this->db->from('penjadwalan');
        $this->db->join('pengampu', 'penjadwalan.id_pengampu = pengampu.id_pengampu');
        $this->db->join('dosen', 'pengampu.id_dosen = dosen.id_dosen');
        $this->db->join('mata_kuliah', 'pengampu.id_matkul = mata_kuliah.id_matkul');
        $this->db->join('kelas', 'pengampu.id_kelas = kelas.id_kelas');
        $this->db->join('ruang', 'penjadwalan.id_ruang = ruang.id_ruang');
        $query = $this->db->get();
        return $query->result();
    }


    public function detail_penjadwalan($id_jadwal = null)
    {
        $query = $this->db->get_where('penjadwalan', array('id_jadwal' => $id_jadwal))->row();
        return $query;
    }   

    public function reset_penjadwalan($table)
    {
        $this->db->empty_table($table);
    }
    

    public function update_penjadwalan($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function generate_jadwal_otomatis($id_pengampu) {
        // Ambil data pengampu
        $pengampu = $this->db->get_where('pengampu', ['id_pengampu' => $id_pengampu])->row();
    
        // Ambil data mata kuliah
        $matkul = $this->db->get_where('mata_kuliah', ['id_matkul' => $pengampu->id_matkul])->row();
    
        // Ambil data kelas
        $kelas = $this->db->get_where('kelas', ['id_kelas' => $pengampu->id_kelas])->row();
    
        // Tentukan nama kelas
        $nama_kelas = $kelas->nama_kelas;
    
        // Kelas yang tidak boleh digabungkan
        $excluded_classes = ['khusus 1.1', 'khusus 1.3', 'khusus 1.5', 'khusus 2.3'];
    
        // Cek jumlah siswa untuk penggabungan kelas
        if ($kelas->jumlah_siswa < 17 && !in_array(strtolower($kelas->nama_kelas), $excluded_classes)) {
            // Cari kelas lain untuk digabungkan
            $kelas_lain = $this->db->get_where('kelas', ['jumlah_siswa <' => 17, 'id_kelas !=' => $kelas->id_kelas])->result();
    
            if ($kelas_lain) {
                foreach ($kelas_lain as $k_lain) {
                    if (!in_array(strtolower($k_lain->nama_kelas), $excluded_classes)) {
                        $kelas_gabungan = $k_lain;
                        $nama_kelas = $kelas->nama_kelas . '.' . $kelas_gabungan->nama_kelas;
                        break;
                    }
                }
            }
        }
    
        // Tentukan jadwal berdasarkan SKS
        $jadwal_times = [
            ['06:40', '07:30'],
            ['07:30', '08:20'],
            ['08:20', '09:10'],
            ['09:10', '10:00'],
            ['10:00', '10:50'],
            ['10:50', '11:40'],
            ['11:40', '12:30'],
            ['12:30', '13:20'],
            ['13:20', '14:10'],
            ['14:10', '15:00'],
            ['15:00', '15:50'],
            ['15:50', '16:40']
        ];
    
        // Kombinasi SKS dan jumlah slot yang diperlukan
        $sks_combinations = [
            1 => 1,
            2 => 2,
            3 => 3
        ];
    
        // Ambil data ruangan
        $ruangans = $this->db->get('ruang')->result();
    
        // Daftar mata kuliah praktikum
        $practical_subjects = [
            'praktikum algoritma dasar',
            'praktikum pemrograman berorientasi objek',
            'praktikum pemrograman perangkat bergerak',
            'praktikum jaringan komputer',
            'praktikum komputasi paralel'
        ];
    
        $jadwal = [];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    
        // Array untuk mengecek jadwal yang sudah terpakai
        $used_times = [];
        $used_classes = [];
    
        $attempt = 0;
        $max_attempts = 1000; // Batasi jumlah percobaan untuk menghindari looping tak berujung
    
        while ($attempt < $max_attempts) {
            $ruangan = $ruangans[array_rand($ruangans)]; // Pilih ruangan secara acak
            $day = $days[array_rand($days)]; // Pilih hari secara acak
            $time_slot = $jadwal_times[array_rand($jadwal_times)]; // Pilih slot waktu secara acak
    
            $index = array_search($time_slot, $jadwal_times);
            $sks_required_slots = $sks_combinations[$matkul->SKS];
            $end_index = $index + $sks_required_slots - 1;
    
            if ($end_index >= count($jadwal_times)) {
                $attempt++;
                continue; // Jika slot waktu tidak cukup untuk jumlah SKS yang diperlukan, lanjutkan ke percobaan berikutnya
            }
    
            $jam_mulai = $jadwal_times[$index][0];
            $jam_selesai = $jadwal_times[$end_index][1];
    
            // Cek apakah ruangan sesuai dengan mata kuliah praktikum
            if (in_array(strtolower($matkul->nama_matakuliah), $practical_subjects)) {
                if ($ruangan->no_ruang != '507' && $ruangan->no_ruang != '508') {
                    $attempt++;
                    continue; // Jika mata kuliah praktikum tetapi ruangan bukan 507/508, lanjutkan ke percobaan berikutnya
                }
            } else {
                if ($ruangan->no_ruang == '507' || $ruangan->no_ruang == '508') {
                    $attempt++;
                    continue; // Jika bukan mata kuliah praktikum tetapi ruangan 507/508, lanjutkan ke percobaan berikutnya
                }
            }
    
            // Cek apakah jadwal sudah terpakai
            if (!isset($used_times[$day][$jam_mulai]) && !in_array($nama_kelas, $used_classes)) {
                $jadwal[] = [
                    'id_pengampu' => $id_pengampu,
                    'id_ruang' => $ruangan->id_ruang,
                    'hari' => $day,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai,
                    'nama_kelas' => $nama_kelas
                ];
    
                $used_times[$day][$jam_mulai] = true;
                $used_classes[] = $nama_kelas;
                break; // Keluar dari loop setelah mendapatkan jadwal yang sesuai
            }
    
            $attempt++;
        }
    
        if ($attempt >= $max_attempts) {
            // Gagal menjadwalkan semua durasi, log atau tangani sesuai kebutuhan
        }
    
        return $jadwal;
    }
    
}    

?>
