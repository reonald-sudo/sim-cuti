<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php';

$pegawai = query("SELECT * FROM pegawai");

if (isset($_POST['tambahPegawai'])) {
    if (tambahPegawai($_POST) > 0) {
        echo "<script>
        alert('Berhasil tambah data pegawai');
        document.location.href = 'admin_dataPegawai.php';
        </script>";
    }
}

?>

<?php require_once 'templates/header.php' ?>

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
                            <h1 class="m-0">Data pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data pegawai</a></li>
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
                            <img src="dist/img/pegawai.jpg" alt="" style="width: 250px;" class="float-right pl-3">
                            <h4>Data pegawai, Pengadilan Negeri Banjarbaru</h4>
                            <p><em>Berisikan data para ASN dan Non-Asn yang terdapat pada pengadilan negeri banjarbaru</em></p>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                Tambah Data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah data pegawai negeri banjarbaru</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label for="">Nip</label>
                                                        <input type="text" name="nip" id="" class="form-control mb-3">
                                                    </div>

                                                    <div class="form-group col-lg-4">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="nama" id="" class="form-control mb-3">
                                                    </div>

                                                    <div class="form-group col-lg-4">
                                                        <label for="">Golongan</label>
                                                        <input type="text" name="golongan" id="" class="form-control mb-3">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <input type="text" name="alamat" id="" class="form-control mb-3" placeholder="Bjb">
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Handphone</label>
                                                        <input type="text" name="no_telp" id="" class="form-control mb-3" placeholder="08127361736">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" id="" class="form-control mb-3" placeholder="contoh@gmail.com">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="tambahPegawai" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="container col-lg-12 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Alamat</th>
                                        <th>Handphone</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Alamat</th>
                                        <th>Handphone</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pegawai as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['golongan']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['no_telp']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td>
                                                <a href="editPegawai.php?nip=<?= $row['nip']; ?>" class="badge badge-warning">Edit</a>
                                                <a href="hapusPegawai.php?nip=<?= $row['nip']; ?>" class="badge badge-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
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