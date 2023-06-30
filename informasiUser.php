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
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$nipPegawai = $_GET['nip'];

$informasi = editData("SELECT * FROM pegawai WHERE nip = '$nipPegawai'");

?>



<?php require_once 'templates/header.php'; ?>



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
                            <h1 class="m-0">Informasi User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Informasi User</a></li>
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

                            <h5><b>Papan Informasi, <?= $_SESSION['nama']; ?></b></h5>
                            <hr>
                            <img src="dist/img/user2-160x160.jpg" class="float-right" alt="" srcset="">


                            <h5>Nama : <?= $_SESSION['nama']; ?></h5>
                            <h5>Nip : <?= $informasi['nip']; ?></h5>
                            <h5>Pangkat : <?= $informasi['golongan']; ?></h5>
                            <h5>Alamat : <?= $informasi['alamat']; ?></h5>
                            <h5>Handphone : <?= $informasi['no_telp']; ?></h5>
                            <h5>Email : <?= $informasi['email']; ?></h5>





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
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Hadir',
                'Izin',
                'Tanpa keterangan'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?= $absensiHadir; ?>, <?= $absensiIzin; ?>, <?= $absensiTanpaKet; ?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
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