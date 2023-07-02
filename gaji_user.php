<?php

session_start();

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
                                <img src="dist/img/gaji_user.jpg" class="float-right" alt="" srcset="" style="width: 200px;">
                                <h4>Gaji dan Tunjangan bulan ini</h4>
                                <p><em>Dashboard ini memberikan informasi mengenai gaji dan tunjangan mu.</em></p>

                                <div class="container col-lg-12 p-3">
                                    <table id="testing" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Status</th>
                                                <th>Slip Gaji</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Status</th>
                                                <th>Slip Gaji</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <tr>
                                                <td>Juni</td>
                                                <td style="color: green;">Rp.2.500.000</td>
                                                <td style="color: green;">Rp.740.000</td>
                                                <td>Verified</td>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#surat_pengajuan<?= $row['id']; ?>">
                                                        <i class="far fa-eye"></i> Lihat
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="surat_pengajuan<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Surat pengajuan, <?= $row['nip']; ?></h5>
                                                                </div>
                                                                <div class="modal-body modal-xl" id="modal-body">
                                                                    <div>
                                                                        <iframe src="dist/pdf/<?= $row['surat_pengajuan']; ?>" frameborder="0" width="470" height="520"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

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