<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php';
require_once 'templates/header.php';

$tahunSekarang = date('Y');


if (isset($_GET['tahun']) && isset($_GET['status'])) {
    $tahun = $_GET['tahun'];
    $status = $_GET['status'];

    $absensi = query("SELECT * FROM tb_absensi WHERE YEAR(tanggal_absen) = '$tahun' AND catatan = '$status'");
} else {
    $absensi = query("SELECT * FROM tb_absensi WHERE YEAR(tanggal_absen) = '$tahunSekarang' AND catatan = 'hadir'");
}

$absensiData = [];  // Inisialisasi array untuk menyimpan data bulanan

// Inisialisasi array data dengan nilai awal 0 untuk setiap bulan
for ($i = 0; $i < 12; $i++) {
    $absensiData[$i] = 0;
}

// Loop melalui data absensi yang didapatkan dan hitung jumlah kejadian untuk setiap bulan
foreach ($absensi as $data) {
    $bulan = date('n', strtotime($data['tanggal_absen']));  // Ambil bulan dari tanggal
    $absensiData[$bulan - 1]++;  // Tambahkan jumlah untuk bulan yang sesuai
}

// Konversi array absensiData menjadi string yang dipisahkan oleh koma
$absensiDataString = implode(', ', $absensiData);

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
                        <?php if (isset($_GET['tahun']) && isset($_GET['status'])) : ?>
                            <a href="humas_cetakPresensi.php?tahun=<?= $_GET['tahun']; ?>&status=<?= $_GET['status']; ?>" class="btn btn-success btn-sm" target="_blank">Cetak berdasarkan pencarian</a>
                        <?php else : ?>
                            <a href="humas_cetakPresensiAll.php" class="btn btn-success btn-sm" target="_blank">Cetak semua data</a>
                        <?php endif; ?>
                    </div>

                    <div class="card">

                        <!-- header card -->
                        <div class="ml-3">
                            <img src="dist/img/humas_absensi.jpg" alt="" style="width: 180px;" class="float-right pl-3 mr-2">

                            <h5 class="mt-3"><strong>Laporan presensi pegawai pengadilan negeri banjarbaru</strong></h5>
                            <p><em>Data presensi para pegawai pengadilan negeri banjarbaru, pada aplikasi SIM Cuti yang tersaji dalam diagram.</em></p>

                            <div class="row">

                                <form action="humas_laporanPresensi.php" method="get">

                                    <div class="row">
                                        <div class="mr-2">
                                            <!-- TAHUN -->
                                            <select class="form-select form-control" name="tahun">
                                                <option selected>Tahun</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>

                                        <div class="mr-2">
                                            <!-- STATUS -->
                                            <select class="form-select form-control" name="status">
                                                <option selected>Status</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="tanpa keterangan">Tanpa keterangan</option>
                                                <option value="terlambat">Terlambat</option>
                                            </select>
                                        </div>

                                        <button class="submit btn-primary btn" type="submit">Cari</button>
                                    </div>

                                </form>


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
                label: '<?php
                        if (isset($_GET['tahun']) && isset($_GET['status'])) {
                            echo $tahun . ' - ' . $status;
                        } else {
                            echo $tahunSekarang . ' - Hadir';
                        }
                        ?>',
                data: [<?= $absensiDataString; ?>],
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