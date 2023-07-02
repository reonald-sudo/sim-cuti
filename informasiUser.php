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
$golongan = $informasi['golongan'];

$queryPangkat = editData("SELECT pangkat FROM pangkat WHERE golongan = '$golongan'");
$pangkat = $queryPangkat['pangkat'];


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

            <style>
                /* Gaya CSS untuk card informasi pegawai */
                .employee-card {
                    display: flex;
                    align-items: center;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 4px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    width: 500px;
                    margin-bottom: 6px;
                }

                .employee-card img {
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                    object-fit: cover;
                    margin-right: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                }

                .employee-card .info {
                    flex: 1;
                }

                .employee-card h2 {
                    margin-top: 0;
                }

                .employee-card p {
                    margin-bottom: 0;
                }

                /* Gaya CSS untuk responsif */
                @media (max-width: 600px) {
                    .employee-card {
                        flex-direction: column;
                        align-items: flex-start;
                        width: 100%;
                    }

                    .employee-card img {
                        margin-right: 0;
                        margin-bottom: 10px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                    }
                }
            </style>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="employee-card">
                        <img src="dist/img/reonald.jpeg" alt="Foto Pegawai">
                        <table>
                            <tr>
                                <td>
                                    <h2><?= $informasi['nama']; ?></h2>
                                    <table>
                                        <tr>
                                            <td><strong>Nip </strong></td>
                                            <td>: <?= $informasi['nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Golongan </strong></td>
                                            <td>: <?= $informasi['golongan']; ?>, <?= $pangkat ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email </strong></td>
                                            <td>: <?= $informasi['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat </strong></td>
                                            <td>: <?= $informasi['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telepon </strong></td>
                                            <td>: <?= $informasi['no_telp']; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <a href="#" class="btn btn-warning">Ubah data</a>
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