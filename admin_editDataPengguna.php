<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php' ?>
<?php require_once 'templates/header.php' ?>

<?php
$nip = $_GET['nip'];

$pengguna = editData("SELECT * FROM user WHERE nip ='$nip'");

if (isset($_POST['ubahData'])) {
    if (ubahPengguna($_POST) > 0) {
        echo "<script>
        document.location.href = 'admin_pengguna.php';
        alert ('Berhasil ubah data pengguna')
        </script>";
    } else {
        mysqli_error($conn);
    }
}

?>

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
                    <form action="" method="post">

                        <div class="card">
                            <div class="card-header mb-0">
                                <img src="dist/img/edit.jpg" class="float-right" style="width: 180px;">
                                <h5>Ubah data, <?= $pengguna['nama']; ?></h5>
                                <p><em>Halaman ini, untuk mengubah data terkait pengguna dengan nama <?= $pengguna['nama']; ?></em></p>


                                <button type="submit" class="btn btn-primary" name="ubahData"> Ubah data</button>


                            </div>


                            <div class="card-body">


                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="" class="">Nip</label>
                                        <input class="form-control" type="text" name="nip" id="" value="<?= $pengguna['nip']; ?>" readonly>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="" class="">Nama</label>
                                        <input class="form-control" type="text" name="nama" id="" value="<?= $pengguna['nama']; ?>">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="" class="">Hak akses</label>
                                        <select class="form-control" aria-label="Default select example" name="hakAkses">
                                            <option selected>Ubah hak akses</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="" class="">Password baru</label>
                                        <input class="form-control" type="password" name="password" id="" placeholder="Input password baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
        </div>
        <br>

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