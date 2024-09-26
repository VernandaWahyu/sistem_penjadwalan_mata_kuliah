<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/admin');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/index');
    }

    public function about_developer()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/about_developer');
    }

    public function about_learnify()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/about_learnify');
    }

    // manajemen dosen

    public function data_dosen()
    {
        $this->load->model('m_dosen');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['dosen'] = $this->m_dosen->tampil_data()->result();
        $this->load->view('admin/data_dosen', $data);

    }

    public function detail_dosen($nik)
    {
        $this->load->model('m_dosen');
        $where = array('nik' => $nik);
        $detail = $this->m_dosen->detail_dosen($nik);
        $data['detail'] = $detail;
        $this->load->view('admin/detail_dosen', $data);
    }

    public function update_dosen($nik)
    {
        $this->load->model('m_dosen');
        $where = array('nik' => $nik);
        $data['dosen'] = $this->m_dosen->update_dosen($where, 'dosen')->result();
        $this->load->view('admin/update_dosen', $data);
    }

    public function dosen_edit()
    {
        $this->load->model('m_dosen');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $data = array(
            'nik' => $nik,
            'nama_dosen' => $nama,
            'email' => $email,

        );

        $where = array(
            'nik' => $nik,
        );

        $this->m_dosen->update_data($where, $data, 'dosen');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_dosen');

    }

    public function delete_dosen($nik)
    {
        $this->load->model('m_dosen');
        $where = array('nik' => $nik);
        $this->m_dosen->delete_dosen($where, 'dosen');
        $this->session->set_flashdata('dosen-delete', 'berhasil');
        redirect('admin/data_dosen');
    }

    public function add_dosen()
    {

        $this->form_validation->set_rules('nik', 'nik', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom nik.',
            'min_length' => 'nik terlalu pendek.',
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[dosen.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom nAMA.',
            'min_length' => 'Nama terlalu pendek.',
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('dosen/registration');
        } else {

            $data = [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nama_dosen' => htmlspecialchars($this->input->post('nama', true)),
            ];

            $this->db->insert('dosen', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_dosen'));

        }

    }
    // manajemen admin

    public function data_admin()
    {
        $this->load->model('m_admin');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->m_admin->tampil_data()->result();
        $this->load->view('admin/data_admin', $data);

    }


    public function update_admin($id)
    {
        $this->load->model('m_admin');
        $where = array('id' => $id);
        $data['admin'] = $this->m_admin->update_admin($where, 'admin')->result();
        $this->load->view('admin/update_admin', $data);
    }

    public function admin_edit()
    {
        $this->load->model('m_admin');
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');


        $data = array(
            'id' => $id,
            'username' => $username,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $email,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_admin->update_data($where, $data, 'admin');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_admin');

    }

    public function delete_admin($id)
    {
        $this->load->model('m_admin');
        $where = array('id' => $id);
        $this->m_admin->delete_admin($where, 'admin');
        $this->session->set_flashdata('admin-delete', 'berhasil');
        redirect('admin/data_admin');
    }

    public function add_admin()
    {



        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[2]', [
            'required' => 'Harap isi kolom Username.',
            'min_length' => 'Username terlalu pendek.',
        ]);
        

        $this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[5]', [
            'required' => 'Harap isi kolom Email.',
            'min_length' => 'Email terlalu pendek.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_admin');
        } else {

            $data = [
                'id' => htmlspecialchars($this->input->post('id', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => htmlspecialchars($this->input->post('email'), true),
            ];

            $this->db->insert('admin', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_admin'));

        }

    }

    //manajemen kelas

    public function data_kelas()
    {
        $this->load->model('m_kelas');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['kelas'] = $this->m_kelas->tampil_data()->result();
        $this->load->view('admin/data_kelas', $data);

    }

    public function update_kelas($id_kelas)
    {
        $this->load->model('m_kelas');
        $where = array('id_kelas' => $id_kelas);
        $data['kelas'] = $this->m_kelas->update_kelas($where, 'kelas')->result();
        $this->load->view('admin/update_kelas', $data);
    }

    public function kelas_edit()
    {
        $this->load->model('m_kelas');
        $id_kelas = $this->input->post('id_kelas');
        $nama_kelas = $this->input->post('nama_kelas');
        $jumlah_siswa = $this->input->post('jumlah_siswa');
        $semester = $this->input->post('semester');

        $data = array(
            'id_kelas' => $id_kelas,
            'nama_kelas' => $nama_kelas,
            'jumlah_siswa' => $jumlah_siswa,
            'semester' => $semester,

        );

        $where = array(
            'id_kelas' => $id_kelas,
        );

        $this->m_kelas->update_data($where, $data, 'kelas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_kelas');

    }

    public function delete_kelas($id_kelas)
    {
        $this->load->model('m_kelas');
        $where = array('id_kelas' => $id_kelas);
        $this->m_kelas->delete_kelas($where, 'kelas');
        $this->session->set_flashdata('kelas-delete', 'berhasil');
        redirect('admin/data_kelas');
    }

    public function add_kelas()
    {

        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required|trim', [
            'required' => 'Harap isi kolom nama_kelas.',
            
        ]);

        $this->form_validation->set_rules('jumlah_siswa', 'jumlah_siswa', 'required|trim', [
            'required' => 'Harap isi kolom jumlah_siswa.',

        ]);

        $this->form_validation->set_rules('semester', 'semester', 'required|trim', [
            'required' => 'Harap isi kolom semester',
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_kelas');
        } else {

            $data = [
                'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', true)),
                'jumlah_siswa' => htmlspecialchars($this->input->post('jumlah_siswa', true)),
                'semester' => htmlspecialchars($this->input->post('semester', true)),
            ];

            $this->db->insert('kelas', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_kelas'));

        }
    }

    // manajemen mata kuliah

    public function data_matakuliah()
    {
        $this->load->model('m_matakuliah');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['mata_kuliah'] = $this->m_matakuliah->tampil_data()->result();
        $this->load->view('admin/data_matakuliah', $data);

    }

    public function update_matakuliah($id_matkul)
    {
        $this->load->model('m_matakuliah');
        $where = array('id_matkul' => $id_matkul);
        $data['mata_kuliah'] = $this->m_matakuliah->update_matakuliah($where, 'mata_kuliah')->result();
        $this->load->view('admin/update_matakuliah', $data);
    }
  
    public function matakuliah_edit()
    {
        $this->load->model('m_matakuliah');
        $id_matkul = $this->input->post('id_matkul');
        $kode_matakuliah = $this->input->post('kode_matakuliah');
        $nama_matakuliah = $this->input->post('nama_matakuliah');
        $SKS = $this->input->post('SKS');
        $semester = $this->input->post('semester');

        $data = array(
            'id_matkul' => $id_matkul,
            'kode_matakuliah' => $kode_matakuliah,
            'nama_matakuliah' => $nama_matakuliah,
            'SKS' => $SKS,
            'semester' => $semester,

        );

        $where = array(
            'id_matkul' => $id_matkul,
        );

        $this->m_matakuliah->update_data($where, $data, 'mata_kuliah');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_matakuliah');

    }

    public function delete_matakuliah($id_matkul)
    {
        $this->load->model('m_matakuliah');
        $where = array('id_matkul' => $id_matkul);
        $this->m_matakuliah->delete_matakuliah($where, 'mata_kuliah');
        $this->session->set_flashdata('matakuliah-delete', 'berhasil');
        redirect('admin/data_matakuliah');
    }

    public function add_matakuliah()
    {
        $this->form_validation->set_rules('nama_matakuliah', 'nama_matakuliah', 'required|trim', [
            'required' => 'Harap isi kolom nama_matakuliah.',
        ]);

        $this->form_validation->set_rules('SKS', 'SKS', 'required|trim', [
            'required' => 'Harap isi kolom SKS.',
        ]);

        $this->form_validation->set_rules('semester', 'Semester', 'required|trim', [
            'required' => 'Harap isi kolom Semester.',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_matakuliah');
        } else {

            $data = [
                'nama_matakuliah' => htmlspecialchars($this->input->post('nama_matakuliah', true)),
                'kode_matakuliah' => htmlspecialchars($this->input->post('kode_matakuliah', true)),
                'SKS' => htmlspecialchars($this->input->post('SKS', true)),
                'semester' => htmlspecialchars($this->input->post('semester', true)),
            ];

            $this->db->insert('mata_kuliah', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_matakuliah'));

        }

    }

   // manajemen ruang

   public function data_ruang()
   {
       $this->load->model('m_ruang');
       $data['user'] = $this->db->get_where('admin', ['email' =>
           $this->session->userdata('email')])->row_array();

       $data['ruang'] = $this->m_ruang->tampil_data()->result();
       $this->load->view('admin/data_ruang', $data);

   }

   public function update_ruang($id_ruang)
   {
       $this->load->model('m_ruang');
       $where = array('id_ruang' => $id_ruang);
       $data['ruang'] = $this->m_ruang->update_ruang($where, 'ruang')->result();
       $this->load->view('admin/update_ruang', $data);
   }

   public function ruang_edit()
   {
       $this->load->model('m_ruang');
       $id_ruang = $this->input->post('id_ruang');
       $no_ruang = $this->input->post('no_ruang');
       $kapasitas = $this->input->post('kapasitas');

       $data = array(
           'id_ruang' => $id_ruang,
           'no_ruang' => $no_ruang,
           'kapasitas' => $kapasitas,

       );

       $where = array(
           'id_ruang' => $id_ruang,
       );

       $this->m_ruang->update_data($where, $data, 'ruang');
       $this->session->set_flashdata('success-edit', 'berhasil');
       redirect('admin/data_ruang');

   }

   public function delete_ruang($id_ruang)
   {
       $this->load->model('m_ruang');
       $where = array('id_ruang' => $id_ruang);
       $this->m_ruang->delete_ruang($where, 'ruang');
       $this->session->set_flashdata('ruang-delete', 'berhasil');
       redirect('admin/data_ruang');
   }

   public function add_ruang()
   {
       $this->form_validation->set_rules('no_ruang', 'no_ruang', 'required|trim', [
           'required' => 'Harap isi kolom no_ruang.',
       ]);

       $this->form_validation->set_rules('kapasitas', 'kapasitas', 'required|trim', [
           'required' => 'Harap isi kolom kapasitas.',
       ]);

       if ($this->form_validation->run() == false) {
           $this->load->view('admin/add_ruang');
       } else {

           $data = [
               'no_ruang' => htmlspecialchars($this->input->post('no_ruang', true)),
               'kapasitas' => htmlspecialchars($this->input->post('kapasitas', true)),
           ];

           $this->db->insert('ruang', $data);

           $this->session->set_flashdata('success-reg', 'Berhasil!');
           redirect(base_url('admin/data_ruang'));

       }

   }
     // manajemen pengampu

public function data_pengampu() {
    $this->load->model('m_pengampu');

    $data['user'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

    $data['pengampu'] = $this->m_pengampu->tampil_data()->result();

    $this->load->view('admin/data_pengampu', $data);
}

  
public function update_pengampu($id_pengampu) {
    $this->load->model('m_pengampu');
    $this->load->model('m_dosen');
    $this->load->model('m_matakuliah');
    $this->load->model('m_kelas');

    $where = array('id_pengampu' => $id_pengampu);
    $data['pengampu'] = $this->m_pengampu->update_pengampu($where, 'pengampu')->row();
    $data['dosen'] = $this->m_dosen->tampil_data()->result();
    $data['mata_kuliah'] = $this->m_matakuliah->tampil_data()->result();
    $data['kelas'] = $this->m_kelas->tampil_data()->result();

    $this->load->view('admin/update_pengampu', $data);
}


public function pengampu_edit() {
    $this->load->model('m_pengampu');

    $id_pengampu = $this->input->post('id_pengampu');
    $id_dosen = $this->input->post('id_dosen');
    $id_matkul = $this->input->post('id_matkul');
    $id_kelas = $this->input->post('id_kelas');

    $data = array(
        'id_dosen' => $id_dosen,
        'id_matkul' => $id_matkul,
        'id_kelas' => $id_kelas,
    );

    $where = array(
        'id_pengampu' => $id_pengampu,
    );

    $this->m_pengampu->update_data($where, $data, 'pengampu');

    $this->session->set_flashdata('success-edit', 'Data berhasil diperbarui!');
    redirect('admin/data_pengampu');
}

  
     public function delete_pengampu($id_pengampu)
     {
         $this->load->model('m_pengampu');
         $where = array('id_pengampu' => $id_pengampu);
         $this->m_pengampu->delete_pengampu($where, 'pengampu');
         $this->session->set_flashdata('pengampu-delete', 'berhasil');
         redirect('admin/data_pengampu');
     }
     public function add_pengampu() {
        $this->load->model('m_dosen');
        $this->load->model('m_matakuliah');
        $this->load->model('m_kelas');
        $this->load->model('m_pengampu');
    
        $data['dosen'] = $this->m_dosen->tampil_data()->result();
        $data['mata_kuliah'] = $this->m_matakuliah->tampil_data()->result();
        $data['kelas'] = $this->m_kelas->tampil_data()->result();
    
        $this->form_validation->set_rules('id_dosen', 'NIK Dosen', 'required|trim');
        $this->form_validation->set_rules('id_matkul', 'Kode Mata Kuliah', 'required|trim');
        $this->form_validation->set_rules('id_kelas[]', 'Kelas', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_pengampu', $data);
        } else {
            $id_dosen = htmlspecialchars($this->input->post('id_dosen', true));
            $id_matkul = htmlspecialchars($this->input->post('id_matkul', true));
            $id_kelas = $this->input->post('id_kelas', true);
    
            // Membuat array untuk data yang akan dimasukkan
            $data = [];
            foreach ($id_kelas as $kelas) {
                $data[] = [
                    'id_dosen' => $id_dosen,
                    'id_matkul' => $id_matkul,
                    'id_kelas' => $kelas
                ];
            }
    
            // Menggunakan insert_batch untuk memasukkan data sekaligus
            $this->m_pengampu->insert_multiple_data($data, 'pengampu');
    
            $this->session->set_flashdata('success-reg', 'Berhasil Ditambahkan!');
            redirect(base_url('admin/data_pengampu'));
        }
    }
    
      // manajemen pengampu
      public function data_penjadwalan() {
        $this->load->model('m_penjadwalan');

        $data['user'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['penjadwalan'] = $this->m_penjadwalan->tampil_data();

        $this->load->view('admin/data_penjadwalan', $data);
    }

    public function update_penjadwalan($id_jadwal) {
        $this->load->model('m_penjadwalan');
        $this->load->model('m_pengampu');
        $this->load->model('m_ruang');

        $where = array('id_jadwal' => $id_jadwal);
        $data['penjadwalan'] = $this->m_penjadwalan->update_penjadwalan($where, 'penjadwalan')->row();
        $data['pengampu'] = $this->m_pengampu->tampil_data();
        $data['ruang'] = $this->m_ruang->tampil_data();

        $this->load->view('admin/update_penjadwalan', $data);
    }

    public function penjadwalan_edit() {
        $this->load->model('m_penjadwalan');

        $id_jadwal = $this->input->post('id_jadwal');
        $id_pengampu = $this->input->post('id_pengampu');
        $id_ruang = $this->input->post('id_ruang');

        $data = array(
            'id_pengampu' => $id_pengampu,
            'id_ruang' => $id_ruang,
        );

        $where = array(
            'id_jadwal' => $id_jadwal,
        );

        $this->m_penjadwalan->update_data($where, $data, 'penjadwalan');

        $this->session->set_flashdata('success-edit', 'Data berhasil diperbarui!');
        redirect('admin/data_penjadwalan');
    }

    public function reset_penjadwalan()
{
    $this->load->model('m_penjadwalan');
    $this->m_penjadwalan->reset_penjadwalan('penjadwalan');
    $this->session->set_flashdata('penjadwalan-reset', 'Semua data berhasil direset!');
    redirect('admin/data_penjadwalan');
}


public function add_penjadwalan() {
    // Load models
    $this->load->model('m_pengampu');
    $this->load->model('m_penjadwalan');

    // Ambil semua data pengampu
    $pengampus = $this->m_pengampu->tampil_data()->result();

    foreach ($pengampus as $pengampu) {
        // Hapus jadwal sebelumnya jika ada
        $this->db->where('id_pengampu', $pengampu->id_pengampu);
        $this->db->delete('penjadwalan');

        $jadwal_otomatis = $this->m_penjadwalan->generate_jadwal_otomatis($pengampu->id_pengampu);

        if ($jadwal_otomatis) {
            foreach ($jadwal_otomatis as $jadwal) {
                $this->db->insert('penjadwalan', $jadwal);
            }
        }
    }

    $this->session->set_flashdata('success-reg', 'Penjadwalan Berhasil Ditambahkan!');
    redirect(base_url('admin/data_penjadwalan'));
}



    
        public function penjadwalan() {
            $this->load->model('m_jadwal');
            $this->load->model('m_pengampu');
        
            $data['jadwal'] = $this->m_jadwal->get_jadwal();
            $data['pengampu'] = $this->m_pengampu->tampil_data()->result();
        
            $this->load->view('admin/penjadwalan', $data);
        }
    
        public function generate() {
            $this->load->model('m_jadwal');
            
            // Kosongkan tabel penjadwalan sebelum generate baru
            $this->db->truncate('penjadwalan');
            
            $jadwal = $this->m_jadwal->generate_jadwal_otomatis();
            
            foreach ($jadwal as $item) {
                $this->m_jadwal->simpan_jadwal($item);
            }
            
            redirect('admin/penjadwalan');
        }
        
    }
    
    
    
    
    
    
    
    

