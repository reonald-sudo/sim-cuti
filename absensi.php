<script src="sweetalert2-11.3.4/package/dist/sweetalert2.all.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<?php
// if (!isset($_SESSION)) {
//     session_start();
// }

session_start();

require_once 'functions.php';

$tanggal = $_GET['tanggal_absen'];

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

?>

<?php require_once 'templates/header.php' ?>

<?php

if (isset($_POST['masukKerja'])) {
    if (tambahAbsensi($_POST) >= 0) {
        echo "<script>
            alert('Berhasil Catat Presensi Masuk');
        </script>
    ";
    } else if (tambahAbsensi($_POST) <= 0) {
        echo "<script>
            alert('Anda sudah presensi hariini');
        </script>
    ";
    }
}

if (isset($_POST['pulangKerja'])) {
    if (tambahPulangKerja($_POST) >= 0) {
        echo "<script>
            alert('Berhasil Catat Presensi Pulang');
        </script>
    ";
    } elseif (tambahPulangKerja($_POST) <= 0) {
        echo "<script>
        alert('Anda sudah presensi pulang hari ini');
    </script>";
    }
};

$absensi = showSingleTable("SELECT * FROM tb_absensi WHERE nip = $nip");
$absensiCek = editData("SELECT * FROM tb_absensi WHERE nip = $nip");

$absensiMasukCek = editData("SELECT * FROM tb_absensi WHERE nip = $nip AND tanggal_absen = '$tanggal'");
// $absensiPulang = showSingleTable("SELECT * FROM tb_absensi WHERE nip = '12345' AND tanggal_absen = '$tanggal' AND jam_pulang = 'Belum Tercatat'");

// print_r($absensiPulang);
// die;
date_default_timezone_set('Asia/kuala_lumpur');
$jamMasuk = date('H:i:s');
$menit = date('i');

$tanggalSekarang = date('Y-m-d');
$cekHari = date('D');
// error_reporting(0);

if (empty($absensiMasukCek) && $jamMasuk >= '17:00:00') {
    global $conn;

    $query = "INSERT INTO tb_absensi VALUE ('', '$nip', '$nama', '$tanggalSekarang', '-', '-', 'tanpa keterangan')";
    mysqli_query($conn, $query);
} else if (empty($absensiMasukCek) && $jamMasuk >= '07:30:00') {
    global $conn;

    $query = "INSERT INTO tb_absensi VALUE ('', '$nip', '$nama', '$tanggalSekarang', '$jamMasuk', 'belum tercatat', 'terlambat')";
    mysqli_query($conn, $query);
}

if ($cekHari === 'Sat' && empty($absensiMasukCek)) {
    global $conn;

    $query = "INSERT INTO tb_absensi VALUE ('', '$nip', '$tanggalSekarang', '-', '-', 'Libur')";
    mysqli_query($conn, $query);
} elseif ($cekHari === 'Sun' && empty($absensiMasukCek)) {
    global $conn;

    $query = "INSERT INTO tb_absensi VALUE ('', '$nip', '$tanggalSekarang', '-', '-', 'Libur')";
    mysqli_query($conn, $query);
}

// if (isset($_POST['simpan'])) {
//     if (cetakFilterAbsensi($_POST) > 0) {
//     }
// }

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
                            <h1 class="m-0">Absensi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Absensi</a></li>
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
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal">
                                Cetak bukti presensi
                            </button>

                            <!-- Modal -->
                            <form action="cetakPresensiUser.php" method="get" target="_blank">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak bukti presensi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h6><b>Filter berdasarkan tanggal</b></h6>

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <input type="date" class="form-control" name="dari" id="">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <input type="date" class="form-control" name="sampai" id="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <h4>Absensi & Catatan kehadiran</h4>
                        </div>

                        <div class="card-body text-center" style="padding-left: 250px;">

                            <div class="card col-lg-8">

                                <div class="card-header">
                                    <h3 id="timestamp" class="pt-3"></h3>
                                    <p><?= date('l') ?>, <?= date('F Y'); ?></p>
                                </div>

                                <div class="card-body">
                                    <form action="" method="post">
                                        <p>Schedule, <?= date('d l Y'); ?></p>
                                        <h6><strong><?= date('l'); ?></strong></h6>
                                        <h6><strong>08 : 00 WITA - 17.00 WITA</strong></h6>

                                        <input type="hidden" name="tanggalAbsen" value="<?= $tanggal; ?>">

                                        <input type="hidden" name="nip" value="<?= $_SESSION['nip']; ?>">

                                        <input type="hidden" name="nama" value="<?= $_SESSION['nama']; ?>">

                                        <input type="text" class="form-control mb-3" name="catatan" id="" placeholder="Hadir / Izin" value="hadir">

                                        <button type="submit" name="masukKerja" class="btn btn-success mr-2" id="masukKerja">Masuk Kerja</button>

                                        <button type="submit" name="pulangKerja" class="btn btn-danger">Pulang Kerja</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="card container mb-3 col-lg-11 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Absen</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Catatan</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($absensi as $row) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['tanggal_absen']; ?></td>
                                            <td><?= $row['jam_masuk']; ?></td>
                                            <td><?= $row['jam_pulang']; ?></td>
                                            <td><?= $row['catatan']; ?></td>
                                        </tr>

                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
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