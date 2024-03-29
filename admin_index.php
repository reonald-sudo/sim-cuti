<?php
session_start();

require_once 'templates/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- navbar and sidebar -->
        <?php require_once 'templates/navbar.php' ?>
        <?php require_once 'templates/sidebar.php' ?>

        <div class="content-wrapper">

            <?php require_once 'templates/contentHeader.php' ?>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/admin.jpg" alt="" style="width: 250px;" class="float-right pl-3">
                            <h4>Good Morning, Admin !</h4>
                            <p>Today <?= date('l') ?>, <?= date('F Y'); ?></p>
                            <p id="timestamp" class="badge badge-success"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">

                                    <p>Presensi</p>
                                </div>
                                <?php $tanggal = date('Y-m-d') ?>
                                <a href="admin_presensiPegawai.php" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <p>Reamburstment</p>
                                </div>
                                <a href="admin_pengajuanUangGanti.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">

                                    <p>Cuti</p>
                                </div>
                                <a href="admin_pengajuanCuti.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">

                                    <p>Data Pegawai</p>
                                </div>
                                <a href="admin_dataPegawai.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-light">
                                <div class="inner">

                                    <p>Data Gaji dan Tunjangan</p>
                                </div>
                                <a href="admin_GajidanTunjangan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-secondary">
                                <div class="inner">

                                    <p>Data User</p>
                                </div>
                                <a href="admin_pengguna.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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

</html>