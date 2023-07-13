<?php

session_start();

$kodeGaji = $_GET['kode_gaji'];

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

if (isset($_POST['ubahGaji'])) {
    if (ubahGaji($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengubah data !');
            document.location.href = 'admin_gaji.php';
        </script>";
    }
}

// $cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip");
$editGaji = editData("SELECT * FROM tb_penggajian WHERE kode_gaji = '$kodeGaji'");
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
                            <h1 class="m-0">Gaji pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Gaji Pegawai</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                <img src="dist/img/edit.jpg" class="float-right" alt="" srcset="" style="width: 180px;">
                                <h4>Informasi gaji, <?= $editGaji['kode_gaji']; ?></h4>
                                <p><em>Halaman ini untuk merubah informasi gaji dengan kode gaji <?= $editGaji['kode_gaji']; ?></em></p>

                                <button type="submit" class="btn btn-primary" name="ubahGaji">Edit data</button>
                            </div>

                            <div class="card-body">
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="">Kode Gaji</label>
                                            <input type="text" name="kodeGaji" id="" class="form-control mb-3" value="<?= $editGaji['kode_gaji']; ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="">Golongan</label>
                                            <input type="text" name="golongan" id="" class="form-control mb-3" value="<?= $editGaji['golongan']; ?>">
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="">Gaji</label>
                                            <input type="text" name="gaji" id="" class="form-control mb-3" value="<?= $editGaji['gaji']; ?>">
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