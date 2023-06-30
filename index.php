<!DOCTYPE html>
<html lang="en">


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
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

// $absensiHadir = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'hadir'");

// $absensiIzin = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'izin'");

// $absensiTanpaKet = hitungBaris("SELECT * FROM tb_absensi WHERE nip = '$nip' AND MONTH(tanggal_absen) = '$bulanIni' AND catatan = 'tanpa keterangan'");
?>



<?php require_once 'templates/header.php'; ?>



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

                    <?php require_once 'menuCard.php' ?>

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
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Hadir',
                'Izin',
                'Terlambat',
                'Tanpa keterangan'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?= $absensiHadir; ?>, <?= $absensiIzin; ?>, <?= $absensiTerlambat; ?>, <?= $absensiTanpaKet; ?>],
                backgroundColor: [
                    'rgb(23, 99, 11)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
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