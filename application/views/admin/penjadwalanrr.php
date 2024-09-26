<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Data Penjadwalan - UMPO</title>

    <!-- General CSS Files -->
    <link rel="icon" href="<?=base_url('assets/')?>img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/')?>stisla-assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url('assets/')?>stisla-assets/css/components.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../assets/stisla-assets/img/avatar/avatar-2.png" class="rounded-circle mr-1 my-auto">
                            <div class="d-sm-none d-lg-inline-block" style="font-size:15px;">Hello, <?php
$data['user'] = $this->db->get_where('admin', ['email' =>
    $this->session->userdata('email')])->row_array();
echo $data['user']['username'];
?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Admin - Penjadwalan Round Robin</div>
                            <a href="<?=base_url('welcome/logout')?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand text-danger">
                        <a href="<?=base_url('admin')?>" class="text-success text-center">
                            <i class="fas fa-graduation-cap"></i> | UMPO
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?=base_url('admin')?>">LY</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="<?=base_url('admin')?>"><i class="fas fa-desktop"></i> <span>Dashboard</span></a></li>
                        <!-- Add other menu items here -->
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="">
                        <div class="card" style="width:100%;">
                            <div class="card-body">
                                <h2 class="card-title">Management Data Penjadwalan Round Robin</h2>
                                <hr>
                                <p class="card-text">
                                    Jumlah penjadwalan yang terdaftar sekarang adalah
                                    <span class="font-weight-bold"><?php echo $this->db->count_all('penjadwalan'); ?> penjadwalan.</span>
                                    Hanya admin yang diperkenankan untuk mendaftarkan penjadwalan.
                                </p>
                                <a href="<?=base_url('admin/add_penjadwalan')?>" class="btn btn-primary">Tambah Data penjadwalan</a>
                                <a href="<?=base_url('admin/penjadwalan')?>" class="btn btn-success">Generate Penjadwalan Round Robin</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="overflow: scroll">
                        <div class="col-md-12">
                            <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                <table id="example" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th scope="col">Hari</th>
                                            <th scope="col">Jam Mulai</th>
                                            <th scope="col">Jam Selesai</th>
                                            <th scope="col">Nama Mata Kuliah</th>
                                            <th scope="col">Nama Dosen</th>
                                            <th scope="col">Nama Kelas</th>
                                            <th scope="col">No Ruang</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($jadwal)): ?>
                                            <?php foreach ($jadwal as $item): ?>
                                                <tr class="text-center">
                                                    <td><?php echo isset($item->hari) ? $item->hari : ''; ?></td>
                                                    <td><?php echo isset($item->jam_mulai) ? $item->jam_mulai : ''; ?></td>
                                                    <td><?php echo isset($item->jam_selesai) ? $item->jam_selesai : ''; ?></td>
                                                    <td><?php echo isset($item->nama_matakuliah) ? $item->nama_matakuliah : ''; ?></td>
                                                    <td><?php echo isset($item->nama_dosen) ? $item->nama_dosen : ''; ?></td>
                                                    <td><?php echo isset($item->nama_kelas) ? $item->nama_kelas : ''; ?></td>
                                                    <td><?php echo isset($item->no_ruang) ? $item->no_ruang : ''; ?></td>
                                                    <td>
                                                        <a href="<?php echo site_url('admin/update_penjadwalan/' . $item->id_jadwal); ?>"
                                                           class="btn btn-info">Update</a>
                                                        <a href="<?php echo site_url('admin/delete_penjadwalan/' . $item->id_jadwal); ?>"
                                                           class="btn btn-danger remove">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7">Tidak ada data jadwal tersedia.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <p class="small font-weight-bold">Pendaftaran penjadwalan hanya dapat dilakukan admin. Jika penjadwalan ingin mendaftar, cukup datang ke admin.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; 2020 <div class="bullet"></div> Code & Design by <a href="https://syauqizaidan.github.io/">Syaauqi</a>
        </div>
        <div class="footer-right">
            Made with <span class="text-danger"> &#10084;</span> by Syaauqi
        </div>
    </footer>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJTY8Pb6OL8uh9D3rCjmlgE8YXEmGII/gLDmY4UCN/Uzr3Qm9" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIyFQFLkt+Flf/tAj3zVn7/6p+c/vlTf1W1Q3V4g" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url('assets/')?>stisla-assets/js/stisla.js"></script>
    <script src="<?=base_url('assets/')?>stisla-assets/js/scripts.js"></script>
    <script src="<?=base_url('assets/')?>stisla-assets/js/custom.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // SweetAlert for delete confirmation
        $('.remove').on('click', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
        });
    </script>
</body>

</html>
