<?php

session_start();

$nip1 = $_GET['nip'];

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

if (isset($_POST['ubahPegawai'])) {
    if (ubahPegawai($_POST) >= 0) {
        echo "<script>
            alert('Berhasil mengubah data !');
            document.location.href = 'admin_dataPegawai.php';
        </script>";
    }
}

// $cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip");
$editPegawai = editData("SELECT * FROM pegawai WHERE nip = $nip1");

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
                            <h1 class="m-0">Cuti</h1>
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
                                <img src="dist/img/edit.jpg" class="float-right" alt="" srcset="" style="width: 180px;">
                                <h4>Informasi pegawai, <?= $editPegawai['nama']; ?></h4>
                                <p><em>Halaman ini untuk merubah informasi kepegawaian <?= $editPegawai['nama']; ?></em></p>

                                <button type="submit" class="btn btn-primary" name="ubahPegawai">Edit data</button>
                            </div>

                            <div class="card-body">
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="">NIP</label>
                                            <input type="text" name="nip" id="" class="form-control mb-3" value="<?= $editPegawai['nip']; ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" id="" class="form-control" value="<?= $editPegawai['nama']; ?>">
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="">Golongan</label>
                                            <input type="text" name="golongan" id="" class="form-control" value="<?= $editPegawai['golongan']; ?>">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" name="alamat" id="" class="form-control" placeholder="10" value="<?= $editPegawai['alamat']; ?>">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="">Handphone</label>
                                            <input type="text" name="no_telp" id="" class="form-control" value="<?= $editPegawai['no_telp']; ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Email</label>
                                            <input type="text" name="email" id="" class="form-control" value="<?= $editPegawai['email']; ?>">
                                        </div>
                                    </div>
                                </div>
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