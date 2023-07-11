<?php
session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$gaji = showSingleTable("SELECT * FROM tb_penggajian");

if (isset($_POST['submitGaji'])) {
    if (tambahDataGaji($_POST) >= 0) {
        echo "<script>
        alert('berhasil tambah data');
        document.location.href = 'admin_gaji.php';
        </script>";
    }
}

?>

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
                                <li class="breadcrumb-item"><a href="absensi.php">Gaji pegawai</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/gaji.jpg" alt="" style="width: 210px;" class="float-right pl-3">
                            <h4>Data gaji pegawai berdasarkan golongan</h4>
                            <p><em>Berisikan data gaji pegawai pengadilan negeri banjarbaru, berdasarkan golongan pegawai.</em></p>

                            <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#tambahGaji">
                                Tambah Data
                            </button>

                            <!-- Modal -->
                            <form method="post">
                                <div class="modal fade" id="tambahGaji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah data penggajian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-text" for="">Kode Gaji :</label>
                                                    <input type="text" class="form-control" name="kodeGaji" id="kodeGaji">
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-text" for="">Golongan :</label>
                                                        <input type="text" class="form-control" name="golongan" id="golongan">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-text" for="">Gaji :</label>
                                                        <input type="text" class="form-control" name="gaji" id="gaji">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="submitGaji">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                        <div class="container col-lg-12 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode gaji</th>
                                        <th>Golongan</th>
                                        <th>Gaji</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode gaji</th>
                                        <th>Golongan</th>
                                        <th>Gaji</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($gaji as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['kode_gaji']; ?></td>
                                            <td><?= $row['golongan']; ?></td>
                                            <td>Rp. <?= number_format($row['gaji'], 0, ",", "."); ?></td>

                                            <td>
                                                <a href="admin_editGaji.php?kode_gaji=<?= $row['kode_gaji']; ?>" class="badge badge-warning">Edit</a>

                                                <a href="admin_hapusGaji.php?kode_gaji=<?= $row['kode_gaji']; ?>" class="badge badge-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
                                            </td>

                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

<script>
    $(function() {
        $('#testing').DataTable()
    });

    $(".verifikasiPengajuan").change(function() {
        var alasanDitolak = $(this).closest('.form-group').find('.alasanDitolak');
        if ($(this).val() == "ditolak") {
            alasanDitolak.removeAttr("readonly");
        } else {
            alasanDitolak.attr("readonly", "readonly");
        }
    });
</script>

</html>