<?php

session_start();

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $golongan = $_SESSION['golongan'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$bulanSekarang = date('n');

$gaji = editData("SELECT * FROM tb_penggajian WHERE golongan = '$golongan'");

// $jHadir = editData("SELECT * FROM tb_penggajian WHERE golongan = '$golongan'");

// hadir, terlambat, dan tanpa keterangan
$jHadir = editData("SELECT COUNT(*) AS total_hadir FROM tb_absensi WHERE nip = '$nip' AND catatan LIKE 'hadir'");
$jTerlambat = editData("SELECT COUNT(*) AS total_terlambat FROM tb_absensi WHERE nip = '$nip' AND catatan LIKE 'terlambat'");
$jTanpaKet = editData("SELECT COUNT(*) AS total_tanpaKet FROM tb_absensi WHERE nip = '$nip' AND catatan LIKE 'tanpa keterangan'");

$totalHadir = $jHadir['total_hadir'];
$totalTerlambat = $jTerlambat['total_terlambat'];
$totalTanpaKet = $jTanpaKet['total_tanpaKet'];

// ambil kode gaji
$gaji = editData("SELECT * FROM tb_penggajian WHERE golongan = '$golongan'");
$kodeGaji = $gaji['kode_gaji'];
$angkaGaji = $gaji['gaji'];

// ambil kode tunjangan
$tunjangan = editData("SELECT * FROM tb_tunjangan WHERE golongan = '$golongan'");
$kodeTunjangan = $tunjangan['kode_tunjangan'];

// hitung tunjangan berdasarkan absensi
$absensi = showSingleTable("SELECT * FROM tb_absensi WHERE nip = $nip AND MONTH(tanggal_absen) = $bulanSekarang");

$totalTunjangan = 0;
foreach ($absensi as $row) {
    $totalTunjangan += (float)$row['tunjangan'];
}

// total gaji + tunjangan
$totalGajiTunjangan = $angkaGaji + $totalTunjangan;

$gajiTunjangan = showSingleTable("SELECT * FROM tb_tunjangan_dan_gaji_pegawai WHERE nip = $nip");

if (isset($_POST['refreshGaji'])) {
    if (updateGaji($_POST) > 0) {
        echo "<script>
            alert('Berhasil Update!');
            document.location.href = 'gaji_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Berhasil Update!');
            document.location.href = 'gaji_user.php';
        </script>";
    }
}

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
                            <h1 class="m-0">Gaji & Tunjangan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Cuti</a></li>
                                <li class="breadcrumb-item active">Dashboard User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <img src="dist/img/gajian.jpg" class="float-right" alt="" srcset="" style="width: 220px;">
                                <h4>Gaji dan Tunjangan bulan ini</h4>
                                <p><em>Dashboard ini memberikan informasi mengenai gaji dan tunjangan mu.</em></p>

                                <form action="" method="post">

                                    <input type="hidden" name="idGaji" id="idGaji" value="<?= $kodeGaji; ?>">
                                    <input type="hidden" name="bulan" id="bulan" value="<?= date('F-Y'); ?>">
                                    <input type="hidden" name="nip" id="nip" value="<?= $nip; ?>">
                                    <input type="hidden" name="golongan" id="golongan" value="<?= $golongan; ?>">
                                    <input type="hidden" name="nama" id="nama" value="<?= $nama; ?>">
                                    <input type="hidden" name="jHadir" id="jHadir" value="<?= $totalHadir; ?>">
                                    <input type="hidden" name="jTerlambat" id="jTerlambat" value="<?= $totalTerlambat; ?>">
                                    <input type="hidden" name="jTanpaKet" id="jTanpaKet" value="<?= $totalTanpaKet; ?>">
                                    <input type="hidden" name="kGaji" id="kGaji" value="<?= $kodeGaji; ?>">
                                    <input type="hidden" name="gaji" id="gaji" value="<?= $angkaGaji; ?>">
                                    <input type="hidden" name="kTunjangan" id="kTunjangan" value="<?= $kodeTunjangan; ?>">
                                    <input type="hidden" name="tunjangan" id="tunjangan" value="<?= $totalTunjangan; ?>">
                                    <input type="hidden" name="gajiTunjangan" id="gajiTunjangan" value="<?= $totalGajiTunjangan; ?>">
                                    <input type="hidden" name="status" id="status" value="belum verifikasi">

                                    <button type="submit" name="refreshGaji" class="btn btn-success">Update</button>
                                </form>

                                <div class="container col-lg-12 p-3">
                                    <table id="testing" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Gaji</th>
                                                <th>Bulan</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Slip Gaji</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Gaji</th>
                                                <th>Bulan</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Slip Gaji</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($gajiTunjangan as $row) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $row['kode_gaji']; ?></td>
                                                    <td><?= $row['bulan']; ?></td>
                                                    <td style="color: green;">Rp. <?= number_format($gaji['gaji'], 0, ",", "."); ?></td>
                                                    <td style="color: green;">Rp. <?= number_format($totalTunjangan, 0, ",", "."); ?></td>
                                                    <td style="color: green;">Rp. <?= number_format($row['total_gaji'], 0, ",", "."); ?></td>
                                                    <td>
                                                        <?php if ($row['status'] === 'acc admin') : ?>
                                                            <p class="badge badge-success"><?= $row['status']; ?></p>
                                                        <?php elseif ($row['status'] === 'belum verifikasi') : ?>
                                                            <p class="badge badge-warning"><?= $row['status']; ?></p>
                                                        <?php elseif ($row['status'] === 'ditolak') : ?>
                                                            <p class="badge badge-danger"><?= $row['status']; ?></p>
                                                        <?php elseif ($row['status'] === 'acc humas') : ?>
                                                            <p class="badge badge-success" target="_blank">[Acc humas]</p>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($row['status'] == 'acc humas') : ?>
                                                            <a href="cetakSlipGaji.php?nip=<?= $row['nip']; ?>&id=<?= $row['id']; ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Cetak</a>
                                                        <?php elseif ($row['status'] !== 'acc admin') : ?>
                                                            <p>-</p>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>
                                                <?php $i++ ?>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                    </form>

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