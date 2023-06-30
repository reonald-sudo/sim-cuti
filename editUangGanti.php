<?php

session_start();

$id = $_GET['id'];

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

require_once 'functions.php';

if (isset($_POST['edit'])) {
    if (ubahPengajuanUang($_POST) >= 0) {
        echo "<script>
            alert('Berhasil ubah data!');
            document.location.href = 'uangGanti.php';
        </script>";
    }
}

$uangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE nip = $nip");
$uangDiverifikasi = editData("SELECT * FROM tb_uang_ganti WHERE id = $id");

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
                            <h1 class="m-0">Uang Ganti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Uang Ganti</a></li>
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
                            <div class="card-header pb-3">
                                <img src="dist/img/edit.jpg" class="float-right" alt="" srcset="" style="width: 180px;">
                                <h4>Informasi pengajuan penggantian uang, <?= $_SESSION['nama']; ?></h4>
                                <p><em>Halaman ini untuk merubah informasi pengajuan anda</em></p>


                                <button type="submit" name="edit" class="btn btn-primary">Edit data</button>
                            </div>

                            <div class="card-body">


                                <div class="row">

                                    <input class="form-control" type="hidden" name="id" id="" value="<?= $uangDiverifikasi['id']; ?>">

                                    <div class="form-group col-lg-4">
                                        <label for="" class="">Nip</label>
                                        <input class="form-control" type="text" name="nip" id="" value="<?= $uangDiverifikasi['nip']; ?>" readonly>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="" class="">Tanggal Transaksi</label>
                                        <input class="form-control" type="date" name="tanggalTransaksi" id="" value="<?= $uangDiverifikasi['tanggal_transaksi']; ?>">
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="" class="">Nominal</label>
                                        <input class="form-control" type="text" name="nominal" id="" value="<?= $uangDiverifikasi['nominal']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="">Nota</label>
                                    <input class="form-control" type="file" name="nota" id="">
                                </div>

                                <input class="form-control" type="hidden" name="status" id="" value="<?= $uangDiverifikasi['status']; ?>">

                            </div>
                    </form>
                </div>
        </div>
        <br>
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
    $(function() {
        $('#testing').DataTable()
    });
</script>

</html>