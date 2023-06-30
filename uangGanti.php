<?php

session_start();

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

if (isset($_POST['simpan'])) {
    if (tambahPengajuanUang($_POST) >= 0) {
        echo "<script>
            alert('Berhasil mengajukan');
        </script>";
    }
}

$uangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE nip = $nip");
$hitungUangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE nip = $nip AND status = 'acc'");
?>

<!DOCTYPE html>
<html lang="en">

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
                            <h1 class="m-0">Uang Ganti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Uang Ganti</a></li>
                                <li class="breadcrumb-item active">Dashboard User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header pb-3">
                            <img src="dist/img/duit bro.jpg" class="float-right" alt="" srcset="" style="width: 280px;">
                            <h4>Pengajuan penggantian uang</h4>
                            <p><em>Halaman ini berisikan pengajuan penggantian uang anda</em></p>


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#exampleModal">
                                Lakukan pengajuan
                            </button>
                            <h5>Uang diverifikasi</h5>
                            <?php $total = 0 ?>
                            <?php foreach ($hitungUangGanti as $row) : ?>
                                <?php $total += $row['nominal'] ?>
                            <?php endforeach; ?>
                            <h3>Rp.<?= $total; ?>,-</h3>

                            <a href="cetakPengajuanUang.php?nip=<?= $_SESSION['nip']; ?>&status=acc" class="btn btn-info mb-3" onclick="javascript: return confirm('Dengan mencairkan dana, data pengajuan yang telah acc akan terhapus, yakin ?');">Cairkan</a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pengajuan penggantian uang</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">


                                                    <label for="">Nama</label>
                                                    <input type="text" name="nama" id="" class="form-control mb-3" value="<?= $_SESSION['nama']; ?>" readonly>

                                                    <label for="">NIP</label>
                                                    <input type="text" name="nip" id="" class="form-control mb-3" value="<?= $_SESSION['nip']; ?>" readonly>

                                                    <label for="">Tanggal transaksi</label>
                                                    <input type="date" name="tanggalTransaksi" id="" class="form-control mb-3">

                                                    <label for="">Nominal</label>
                                                    <input type="text" name="nominal" id="" class="form-control mb-3" placeholder="1000000">

                                                    <label for="">Nota</label>
                                                    <input type="file" name="nota" id="" class="form-control">

                                                    <input type="hidden" name="status" id="" class="form-control" value='sedang proses'>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="simpan">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card container mb-3 p-3">
                                <table id="testing" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nominal</th>
                                            <th>Nota</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nominal</th>
                                            <th>Nota</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php $total = 0 ?>
                                        <?php foreach ($uangGanti as $row) : ?>
                                            <?php $total += $row['nominal'] ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['tanggal_transaksi']; ?></td>
                                                <td>Rp.<?= $row['nominal']; ?>,-</td>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nota<?= $row['id']; ?>">
                                                        <i class="far fa-eye"></i> Lihat
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="nota<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Nota <?= $row['tanggal_transaksi']; ?></h5>
                                                                </div>
                                                                <div class="modal-body modal-xl" id="modal-body">
                                                                    <div>
                                                                        <img src="dist/img/<?= $row['nota']; ?>" alt="" srcset="" width="100%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $row['status']; ?></td>
                                                <td><a href="editUangGanti.php?id=<?= $row['id']; ?>" class="badge badge-warning">Edit</a>
                                                    <a href="hapusUangGanti.php?id=<?= $row['id']; ?>" class="badge badge-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
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