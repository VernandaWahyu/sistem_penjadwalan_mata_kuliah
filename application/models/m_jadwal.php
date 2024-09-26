<?php
class M_jadwal extends CI_Model {

public function generate_jadwal_otomatis() {
    // Ambil data pengampu dan ruangan
    $pengampus = $this->db->select('pengampu.id_pengampu, dosen.nama_dosen, mata_kuliah.nama_matakuliah, mata_kuliah.sks, kelas.nama_kelas')
                          ->from('pengampu')
                          ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen')
                          ->join('mata_kuliah', 'pengampu.id_matkul = mata_kuliah.id_matkul')
                          ->join('kelas', 'pengampu.id_kelas = kelas.id_kelas')
                          ->get()
                          ->result();

    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $slots = [
        '06:50-08:30', '08:30-10:10', '10:20-12:00', 
        '12:30-14:10', '14:20-16:00'
    ];

    $ruangan = $this->db->select('id_ruang, no_ruang')->get('ruang')->result();

    // Inisialisasi struktur data untuk tracking
    $jadwal = [];
    $ruangTimeTable = []; // Tracking jadwal ruangan per hari dan slot
    $dosenTimeTable = []; // Tracking jadwal dosen per hari dan slot

    foreach ($pengampus as $pengampu) {
        $isScheduled = false;

        // Randomize hari dan slot untuk variasi
        shuffle($days);
        shuffle($slots);

        // Tentukan jadwal untuk setiap hari
        foreach ($days as $day) {
            if ($isScheduled) break; // Jika sudah terjadwal, keluar dari loop

            foreach ($slots as $slot) {
                // Cek apakah slot ini sudah digunakan oleh dosen pada hari yang sama
                if (isset($dosenTimeTable[$pengampu->id_pengampu][$day])) {
                    continue; // Jika slot sudah ada, lanjutkan ke slot berikutnya
                }

                // Cek apakah slot ini sudah digunakan di ruangan lain pada hari yang sama
                $isSlotUsed = false;
                foreach ($ruangan as $ruang) {
                    if (isset($ruangTimeTable[$ruang->id_ruang][$day][$slot])) {
                        $isSlotUsed = true;
                        break;
                    }
                }

                if (!$isSlotUsed) {
                    // Cari ruangan yang tersedia untuk slot ini
                    $ruangFound = null;
                    foreach ($ruangan as $ruang) {
                        if (!isset($ruangTimeTable[$ruang->id_ruang][$day][$slot])) {
                            $ruangFound = $ruang;
                            break;
                        }
                    }

                    if ($ruangFound) {
                        // Alokasikan ruangan dan slot waktu
                        if (!isset($ruangTimeTable[$ruangFound->id_ruang])) {
                            $ruangTimeTable[$ruangFound->id_ruang] = [];
                        }
                        if (!isset($ruangTimeTable[$ruangFound->id_ruang][$day])) {
                            $ruangTimeTable[$ruangFound->id_ruang][$day] = [];
                        }
                        $ruangTimeTable[$ruangFound->id_ruang][$day][$slot] = true;

                        if (!isset($dosenTimeTable[$pengampu->id_pengampu])) {
                            $dosenTimeTable[$pengampu->id_pengampu] = [];
                        }
                        $dosenTimeTable[$pengampu->id_pengampu][$day] = true;

                        list($jam_mulai, $jam_selesai) = explode('-', $slot);
                        $jadwal[] = [
                            'id_pengampu' => $pengampu->id_pengampu,
                            'id_ruang' => $ruangFound->id_ruang,
                            'hari' => $day,
                            'jam_mulai' => $jam_mulai,
                            'jam_selesai' => $jam_selesai
                        ];

                        $isScheduled = true;
                        break; // Keluar dari loop slot setelah terjadwal
                    }
                }
            }
        }

        if (!$isScheduled) {
            echo "Tidak dapat menemukan slot untuk: " . $pengampu->nama_dosen . " - " . $pengampu->nama_matakuliah;
        }
    }

    // Simpan jadwal ke database
    foreach ($jadwal as $entry) {
        $this->simpan_jadwal($entry);
    }

    return $jadwal;
}

public function simpan_jadwal($data) {
    $this->db->insert('penjadwalan', $data);
}

public function get_jadwal() {
    return $this->db->select('penjadwalan.*, dosen.nama_dosen, mata_kuliah.nama_matakuliah, kelas.nama_kelas, ruang.no_ruang')
                    ->from('penjadwalan')
                    ->join('pengampu', 'penjadwalan.id_pengampu = pengampu.id_pengampu')
                    ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen')
                    ->join('mata_kuliah', 'pengampu.id_matkul = mata_kuliah.id_matkul')
                    ->join('kelas', 'pengampu.id_kelas = kelas.id_kelas')
                    ->join('ruang', 'penjadwalan.id_ruang = ruang.id_ruang')
                    ->get()
                    ->result();
}

public function get_pengampu() {
    return $this->db->select('pengampu.id_pengampu, dosen.nama_dosen, mata_kuliah.kode_matakuliah')
                    ->from('pengampu')
                    ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen')
                    ->join('mata_kuliah', 'pengampu.id_matkul = mata_kuliah.id_matkul')
                    ->get()
                    ->result();
}
}
