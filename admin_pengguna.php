<!DOCTYPE html>
<html lang="en">

<?php require_once 'functions.php' ?>
<?php require_once 'templates/header.php' ?>

<?php
$pengguna = showSingleTable("SELECT * FROM user");

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
                            <h1 class="m-0">Data Pengguna SIM Cuti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data Pengguna SIM Cuti</a></li>
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
                            <h5>Halaman data pengguna sim cuti</h5>
                            <p><em>Halam ini, berisikan rincian pengguna aplikasi SIM Cuti</em></p>


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

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <h6 for="">NIP</h6>
                                                        <input type="text" name="nip" class="form-control" placeholder="Masukkan Nip" required>
                                                        <small style="color: red;">* Sesuaikan nip</small>
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <h6 for="">Nama</h6>
                                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                                                        <small style="color: red;">* Sesuaikan dengan gelar</small>
                                                    </div>
                                                </div>

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
                                            <th>Nama</th>
                                            <th>Hak Akses</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nip</th>
                                            <th>Nama</th>
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
                                                <td><?= $row['nama']; ?></td>
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

<script>
    $(function() {
        $('#testing').DataTable()
    });
</script>

</html>