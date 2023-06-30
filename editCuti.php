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

require_once 'functions.php';

if (isset($_POST['ubahCuti'])) {
    if (ubahCuti($_POST) >= 0) {
        echo "<script>
            alert('Berhasil mengubah data !');
            document.location.href = 'cuti.php';
        </script>";
    }
}

// $cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip");
$editCuti = editData("SELECT * FROM tb_cuti WHERE nip = $nip");

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
                                <h4>Informasi pengajuan cuti, <?= $_SESSION['nama']; ?></h4>
                                <p><em>Halaman ini untuk merubah informasi pengajuan anda</em></p>

                                <button type="submit" class="btn btn-primary" name="ubahCuti">Edit data</button>
                            </div>

                            <div class="card-body">
                                <div class="modal-body">

                                    <input type="hidden" name="id" value="<?= $editCuti['id']; ?>">

                                    <label for="">NIP</label>
                                    <input type="text" name="nip" id="" class="form-control mb-3" value="<?= $_SESSION['nip']; ?>" readonly>

                                    <div class="row">

                                        <div class="form-group col-lg-6">
                                            <label for="">Tanggal cuti</label>
                                            <input type="date" name="tanggalCuti" id="" class="form-control" value="<?= $editCuti['tanggal_cuti']; ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Tanggal kembali</label>
                                            <input type="date" name="tanggalKembali" id="" class="form-control" value="<?= $editCuti['tanggal_kembali']; ?>">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="">Hari</label>
                                        <input type="number" name="hari" id="" class="form-control" placeholder="10" value="<?= $editCuti['hari']; ?>" min="1" max="10">
                                        <small style="color: red;"><em>1 - 10 Hari</em></small>
                                    </div>

                                    <input type="hidden" name="status" id="" class="form-control" value='sedang proses'>

                                    <div class="form-group">
                                        <label for="">Surat pengajuan cuti</label>
                                        <input type="file" name="surat_pengajuan" id="" class="form-control">
                                        <small style="color: red;"><em>* Unggah file berekstensi PDF</em></small>
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