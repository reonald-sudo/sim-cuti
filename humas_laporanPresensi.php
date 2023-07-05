<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php';
require_once 'templates/header.php'

?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- navbar and sidebar -->
        <?php require_once 'templates/navbar.php' ?>
        <?php require_once 'templates/sidebar.php' ?>

        <!-- Header 🗣 -->
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Presensi pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="humas_laporanPresensi.php">Presensi pegawai</a></li>
                                <li class="breadcrumb-item active">Humas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- \\Content Area 😗 -->

            <section class="content">
                <div class="container-fluid">

                    <div class="mb-2">
                        <a href="#" class="btn btn-primary btn-sm">Cetak keseluruhan</a>
                        <a href="#" class="btn btn-success btn-sm">Cetak Spesifik</a>
                    </div>

                    <div class="card">

                        <!-- header card -->
                        <div class="ml-3">
                            <img src="dist/img/humas_absensi.jpg" alt="" style="width: 180px;" class="float-right pl-3 mr-2">

                            <h5 class="mt-3"><strong>Laporan presensi pegawai pengadilan negeri banjarbaru</strong></h5>
                            <p><em>Data presensi para pegawai pengadilan negeri banjarbaru, pada aplikasi SIM Cuti yang tersaji dalam diagram.</em></p>

                            <div class="row">

                                <!-- dropdown tahun -->
                                <div class="dropdown mr-2">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Tahun
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">2022</a></li>
                                        <li><a class="dropdown-item" href="#">2023</a></li>
                                        <li><a class="dropdown-item" href="#">2024</a></li>
                                        <li><a class="dropdown-item" href="#">2025</a></li>
                                        <li><a class="dropdown-item" href="#">2026</a></li>
                                    </ul>
                                </div>

                                <!-- dropdown berdasarkan apa ? -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Keterangan
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Hadir</a></li>
                                        <li><a class="dropdown-item" href="#">Izin</a></li>
                                        <li><a class="dropdown-item" href="#">Sakit</a></li>
                                        <li><a class="dropdown-item" href="#">Tanpa Keterangan</a></li>
                                        <li><a class="dropdown-item" href="#">Terlambat</a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <hr>

                        <!-- chart 📊 -->
                        <div class="p-4">
                            <canvas id="chartAbsensiHumas"></canvas>
                        </div>

                    </div>
                    <br>
                </div>
            </section>

            <!-- \\End Content Area 👋 -->
        </div>



        <!-- Footer -->
        <?php require_once 'templates/footer.php' ?>
    </div>

</body>

<!-- PER SCRIPT AN DUNIAWI 👩‍🔬 -->

<?php require_once 'templates/script.php' ?>
<script src="js/script.js"></script>

<!-- Scipt untuk Chart.Js-->
<script>
    const ctx = document.getElementById('chartAbsensiHumas');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 8, 3, 12, 19, 3, 5, 8, 3],
                borderWidth: 0,
                pointRadius: 4,
                backgroundColor: 'transparent',
                borderColor: 'rgb(75, 192, 192)',
                pointBackgroundColor: 'black',
                pointBorderColor: 'black',
                pointHoverRadius: 6
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>