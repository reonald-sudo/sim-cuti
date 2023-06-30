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


if (isset($_POST['tambahCuti'])) {
    if (tambahCuti($_POST) >= 0) {
        echo "<script>
            alert('Berhasil mengajukan cuti !');
        </script>";
    }
}

$cuti = showSingleTable("SELECT * FROM tb_cuti WHERE nip = $nip");
$hariCuti = editData("SELECT * FROM tb_cuti WHERE nip = '$nip'");
// $uangDiverifikasi = editData("SELECT * FROM tb_uang_ganti WHERE nip = $nip AND status = 'acc'");

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
                                <img src="dist/img/cuti.jpg" class="float-right" alt="" srcset="" style="width: 300px;">
                                <h4>Informasi cuti mu</h4>
                                <p><em>Ini adalah informasi singkat mengenai masa cutimu</em></p>

                                <?php $total = 0 ?>
                                <?php foreach ($cuti as $row) : ?>
                                    <?php $total += $row['hari'] ?>
                                <?php endforeach; ?>

                                <?php if ($total < 10) { ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                        Ajukan cuti
                                    </button>
                                <?php } elseif ($total >= 10) { ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="display: none;">
                                        Ajukan cuti
                                    </button>
                                <?php } ?>

                                <?php if (empty($hariCuti['status'])) { ?>
                                    <a href="cetakCuti.php?nip=<?= $_SESSION['nip']; ?>" target="_blank" class="btn btn-info ml-2" style="display: none;">Cetak SK Cuti</a>
                                <?php } else if ($hariCuti['status'] === 'acc') { ?>
                                    <a href="cetakCuti.php?nip=<?= $_SESSION['nip']; ?>" target="_blank" class="btn btn-info ml-2">Cetak SK Cuti</a>
                                <?php } ?>

                            </div>

                            <h5 class="text-center mt-2">CUTI TAHUNAN</h5>

                            <?php $total = 10 ?>
                            <?php foreach ($cuti as $row) : ?>
                                <?php $total -= $row['hari'] ?>
                            <?php endforeach; ?>
                            <h3 class="text-center"><?= $total; ?> Hari</h3>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pengajuan cuti</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" id="" class="form-control mb-3" value="<?= $_SESSION['nama']; ?>" readonly>

                                            <label for="">NIP</label>
                                            <input type="text" name="nip" id="" class="form-control mb-3" value="<?= $_SESSION['nip']; ?>" readonly>

                                            <div class="row">

                                                <div class="form-group col-lg-6">
                                                    <label for="">Tanggal cuti</label>
                                                    <input type="date" name="tanggalCuti" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="">Tanggal kembali</label>
                                                    <input type="date" name="tanggalKembali" id="" class="form-control">
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="">Hari</label>
                                                <select class="form-control" aria-label="Default select example" name="hari">
                                                    <option selected>Pilih Hari</option>
                                                    <option value="1">1 Hari</option>
                                                    <option value="2">2 Hari</option>
                                                    <option value="3">3 Hari</option>
                                                    <option value="4">4 Hari</option>
                                                    <option value="5">5 Hari</option>
                                                    <option value="6">6 Hari</option>
                                                    <option value="7">7 Hari</option>
                                                    <option value="8">8 Hari</option>
                                                    <option value="9">9 Hari</option>
                                                    <option value="10">10 Hari</option>
                                                </select>
                                                <small style="color: red;"><em>1 - 10 Hari</em></small>
                                            </div>

                                            <input type="hidden" name="status" id="" class="form-control" value='sedang proses'>

                                            <div class="form-group">
                                                <label for="">Surat pengajuan cuti</label>
                                                <input type="file" name="surat_pengajuan" id="" class="form-control">
                                                <small style="color: red;"><em>* Unggah file berekstensi PDF</em></small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="tambahCuti" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="container col-lg-12 p-3">
                                <table id="testing" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Tanggal Cuti</th>
                                            <th>Hari</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Status</th>
                                            <th>Surat Pengajuan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Tanggal Cuti</th>
                                            <th>Hari</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Status</th>
                                            <th>Surat Pengajuan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($cuti as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['nip']; ?></td>
                                                <td><?= $row['tanggal_cuti']; ?></td>
                                                <td><?= $row['hari']; ?></td>
                                                <td><?= $row['tanggal_kembali']; ?></td>
                                                <td><?= $row['status']; ?></td>

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

                                                <td>
                                                    <a href="editCuti.php?id=<?= $row['id']; ?>" class="badge badge-warning">Edit</a>
                                                    <a href="hapusCuti.php?id=<?= $row['id']; ?>" class="badge badge-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
                                                </td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
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