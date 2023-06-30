<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIM Cuti</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION['nama']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">


                    <?php if ($_SESSION['hak_akses'] === 'user') {
                    ?>
                        <a href="index.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard User
                                <i class="right"></i>
                            </p>
                        </a>
                    <?php
                    } elseif ($_SESSION['hak_akses'] === 'admin') {
                    ?>

                        <a href="admin_index.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard Admin
                                <i class="right"></i>
                            </p>
                        </a>
                    <?php
                    } ?>

                </li>

                <?php if ($_SESSION['hak_akses'] == 'user') { ?>
                    <li class="nav-header">MENU KEPEGAWAIAN & INFORMASI</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Kepegawaian
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">



                            <?php

                            date_default_timezone_set('Asia/kuala_lumpur');
                            $hariIni = date('l');

                            if ($hariIni === 'Saturday') {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file nav-icon"></i>
                                        <p>Presensi Ditutup</p>
                                    </a>
                                </li>
                            <?php
                            } else if ($hariIni === 'Sunday') {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file nav-icon"></i>
                                        <p>Presensi Ditutup</p>
                                    </a>
                                </li>
                            <?php
                            } else {
                                $tanggal = date('Y-m-d')
                            ?>
                                <li class="nav-item">
                                    <a href="absensi.php?tanggal_absen=<?= $tanggal; ?>" class="nav-link">
                                        <i class="fas fa-file nav-icon"></i>
                                        <p>Presensi</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                            <li class="nav-item">
                                <a href="uangGanti.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Ajukan uang ganti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="cuti.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Cuti</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Informasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="informasiUser.php?nip=<?= $_SESSION['nip']; ?>" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Informasi saya</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } elseif ($_SESSION['hak_akses'] == 'admin') {
                ?>

                    <li class="nav-header">MENU ADMIN</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Kepegawaian
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin_presensiPegawai.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Presensi Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin_pengajuanUangGanti.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Pengajuan uang ganti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin_pengajuanCuti.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Pengajuan Cuti</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Arsip
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Arsip Presensi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Arsip Penggantian Uang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Arsip Cuti</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Informasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin_dataPegawai.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Data Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin_pengguna.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Data Pengguna</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php
                } ?>

            </ul>
        </nav>
    </div>
</aside>