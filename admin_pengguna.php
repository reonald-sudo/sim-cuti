<?php
session_start();

require_once 'functions.php' ?>
<?php require_once 'templates/header.php' ?>

<?php
$pengguna = showSingleTable("SELECT * FROM user");
$pegawai = showSingleTable("SELECT * FROM pegawai");

if (isset($_POST['tambahPengguna'])) {
    if (tambahPengguna($_POST) > 0) {
        echo "<script>
        document.location.href = 'admin_pengguna.php';
        alert ('Berhasil tambah Pengguna')
        </script>";
    } else {
        mysqli_error($conn);
    }
}

?>



<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- navbar and sidebar -->
        <?php require_once 'templates/navbar.php' ?>
        <?php require_once 'templates/sidebar.php' ?>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Pengguna</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data Pengguna</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/pengguna.jpg" class="float-right" style="width: 250px;">
                            <h5>Halaman data pengguna </h5>
                            <p><em>Halaman ini, berisikan rincian pengguna aplikasi SIM Cuti</em></p>


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                Tambah data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah pengguna SIM Cuti</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <select name="nip" id="nip" class="form-control js-example-basic-single" style="width: 100%;" required onchange="autoFillPengguna()">
                                                        <option value="" selected disabled hidden></option>
                                                        <?php
                                                        foreach ($pegawai as $row) { ?>
                                                            <option value="<?= $row['nip']; ?>"> <?= $row['nip']; ?> - <?= $row['nama']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <small style="color: red;">* Sesuaikan NIP</small>
                                                </div>

                                                <input type="hidden" name="golongan" id="golongan" class="form-control" placeholder="Masukkan Golongan" required>

                                                <input type="hidden" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>

                                                <div class="form-group">
                                                    <h6 for="">Password</h6>
                                                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                                </div>

                                                <div class="form-group">
                                                    <h6 for="">Hak akses</h6>
                                                    <select class="form-control" aria-label="Default select example" name="hakAkses">
                                                        <option selected>Pilih hak akses</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="tambahPengguna" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="card-body">
                            <div class="card container mb-3 col-lg-12 p-3">
                                <table id="testing" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nip</th>
                                            <th>Hak Akses</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nip</th>
                                            <th>Hak Akses</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pengguna as $row) : ?>

                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nip']; ?></td>
                                                <td><?= $row['hak_akses']; ?></td>
                                                <td>
                                                    <a href="admin_editDataPengguna.php?nip=<?= $row['nip']; ?>" class="badge badge-warning mr-1">Edit</a>

                                                    <a href="admin_hapusDataPengguna.php?nip=<?= $row['nip']; ?>" class="badge badge-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
                                                </td>
                                            </tr>

                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>
            </section>
        </div>

        <!-- Footer -->
        <?php require_once 'templates/footer.php' ?>

        </aside>
    </div>

    <?php require_once 'templates/script.php' ?>
</body>

<script src="js/script.js"></script>
<script src="js/tambahPengguna.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.js-example-basic-single').select2({
        dropdownParent: $('#exampleModal')
    });
</script>

<script>
    $(function() {
        $('#testing').DataTable()
    });
</script>

</html>