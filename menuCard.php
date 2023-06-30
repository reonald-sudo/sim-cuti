<?php
require_once 'functions.php';

$bulanIni = date('n');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header('Location:../login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$absensiHadir = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'hadir'");

$absensiIzin = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'izin'");

$absensiTerlambat = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'terlambat'");

$absensiTanpaKet = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'tanpa keterangan'");

?>

<div class="card">
    <div class="card-header mb-0">
        <img src="dist/img/landing.jpg" alt="" style="width: 200px;" class="float-right pl-3">
        <h4>Good Morning, <?= $_SESSION['nama']; ?> !</h4>
        <p>Today <?= date('l') ?>, <?= date('F Y'); ?></p>
        <p id="timestamp" class="badge badge-success"></p>
    </div>

    <div class="card-body">
        <p>Shortcut</p>
        <?php

        date_default_timezone_set('Asia/kuala_lumpur');
        $hariIni = date('l');
        $tanggal = date('Y-m-d')
        ?>

        <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="btn btn-outline-success mr-2">Presensi</a>

        <a href="uangGanti.php" class="btn btn-outline-success mr-2">Ajukan uang ganti</a>
        <a href="cuti.php" class="btn btn-outline-success mr-2">Cuti</a>
    </div>
</div>

<div class="row gx-1">

    <div class="col-md-6 col-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mt-2 pr-3">Status presensi, <?= $_SESSION['nama']; ?> [<?= date('F - Y'); ?>]</h6>
            </div>
            <div>
                <canvas id="myChart" class="mb-3"></canvas>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hadir</th>
                            <th scope="col">Izin</th>
                            <th scope="col">Terlambat</th>
                            <th scope="col">Tanpa Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $absensiHadir; ?> Hari</td>
                            <td><?= $absensiIzin; ?> Hari</td>
                            <td><?= $absensiTerlambat; ?> Hari</td>
                            <td><?= $absensiTanpaKet; ?> Hari</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <div class="col-md-3 col-6">
        <div class="card">
            <div class="card-header pr-3">
                <h6 class="mt-2 badge badge-info">Berita Terbaru !</h6>
            </div>
            <img src="dist/img/Civil_Worker_.jpg" alt="" srcset="">
            <h6 style="text-align: justify;" class="ml-2 mr-2 mb-2">Periksa kebijakan terbaru dari kepala dinas. <a href="" class="badge badge-info"> Selengkapnya</a></h6>
        </div>
    </div> -->

    <div class="col-md-6 col-6">
        <div class="card">
            <div class="card-header pr-3">
                <h6 class="mt-2">Cuti tahunan balance <i class="fa fa-info-circle" aria-hidden="true"></i></h6>
            </div>
            <div class="card-body">
                <?php $cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip"); ?>
                <?php $total = 10 ?>
                <?php foreach ($cuti as $row) : ?>
                    <?php $total -= $row['hari'] ?>
                <?php endforeach; ?>
                <h3><?= $total; ?> Hari</h3>
                <a href="cuti.php"> Request Cuti Tahunan <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <br>
                <br>
                <?php $hitungCuti = hitungBaris("SELECT * FROM tb_cuti WHERE nip = $nip"); ?>
                <h3><?= $hitungCuti; ?> Pengajuan cuti</h3>
                <a href="cuti.php">Cek pengajuan <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="card-footer" style="padding-bottom: 20px;">
                <a href="cuti.php">View All</a>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <?php
    date_default_timezone_set('Asia/kuala_lumpur');
    $dateToday = date('l');

    if ($dateToday === 'Saturday') {
    ?>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><?= date('d M'); ?></h5>

                    <p>Libur</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">Presensi ditutup <i class="fa fa-info-circle"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6" style="display: none;">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><?= date('d M'); ?></h5>

                    <p>Presensi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <?php $tanggal = date('Y-m-d') ?>
                <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php
    } elseif ($dateToday === 'Sunday') {
    ?>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><?= date('d M'); ?></h5>

                    <p>Libur</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">Presensi ditutup <i class="fa fa-info-circle"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6" style="display: none;">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><?= date('d M'); ?></h5>

                    <p>Presensi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <?php $tanggal = date('Y-m-d') ?>
                <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><?= date('d M'); ?></h5>

                    <p>Presensi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <?php $tanggal = date('Y-m-d') ?>
                <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="col-lg-4 col-6" style="display: none;">
        <div class="small-box bg-info">
            <div class="inner">
                <h5><?= date('d M'); ?></h5>

                <p>Presensi</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <?php $tanggal = date('Y-m-d') ?>
            <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <?php $hitungUangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE nip = $nip AND status = 'acc'"); ?>
                <?php $total = 0 ?>
                <?php foreach ($hitungUangGanti as $row) : ?>
                    <?php $total += $row['nominal'] ?>
                <?php endforeach; ?>
                <h5>Rp. <?= $total; ?>,-</h5>

                <p>Ajukan uang ganti</p>
            </div>
            <div class="icon">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
            <a href="uangGanti.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <?php $cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip"); ?>
                <?php $total = 10 ?>
                <?php foreach ($cuti as $row) : ?>
                    <?php $total -= $row['hari'] ?>
                <?php endforeach; ?>
                <h5><?= $total; ?> Hari</h5>

                <p>Cuti</p>
            </div>
            <div class="icon">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="cuti.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>