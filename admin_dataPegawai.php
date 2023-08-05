<?php
session_start();

require_once 'functions.php';

$pegawai = query("SELECT * FROM pegawai");
$golongan = query("SELECT * FROM pangkat");

if (isset($_POST['tambahPegawai'])) {

    if (tambahPegawai($_POST) > 0) {
        echo "<script>
        alert('Berhasil tambah data pegawai');
        document.location.href = 'admin_dataPegawai.php';
        </script>";
    }
}

?>

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
                            <h1 class="m-0">Data pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data pegawai</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
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
                            <img src="dist/img/pegawai.jpg" alt="" style="width: 250px;" class="float-right pl-3">
                            <h4>Data pegawai, Pengadilan Negeri Banjarbaru</h4>
                            <p><em>Berisikan data para ASN dan Non-Asn yang terdapat pada pengadilan negeri banjarbaru</em></p>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                Tambah Data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah data pegawai negeri banjarbaru</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Nip</label>
                                                        <input type="text" name="nip" id="" class="form-control mb-3">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label for="golongan">golongan</label>
                                                        <select name="golongan" id="golongan" class="form-control js-example-basic-single" style="width: 100%;" required>
                                                            <option value="" selected disabled hidden></option>
                                                            <?php
                                                            foreach ($golongan as $row) { ?>
                                                                <option value="<?= $row['golongan']; ?>"> <?= $row['golongan']; ?> - <?= $row['pangkat']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" name="nama" id="" class="form-control mb-3">
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-control mb-3">
                                                            <option value="" disabled selected>-- Silahkan Pilih --</option>
                                                            <option value="L">Laki-laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>



                                                    <div class="form-group col-lg-6">
                                                        <label for="agama">Agama</label>
                                                        <select name="agama" id="agama" class="form-control mb-3">
                                                            <option value="" disabled selected>-- Silahkan Pilih --</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                                            <option value="Kristen Katolik">Kristen Katolik</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Buddha">Buddha</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Tempat lahir</label>
                                                        <input type="text" name="tLahir" id="tLahir" class="form-control mb-3">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label for="">Tanggal Lahir</label>
                                                        <input type="date" name="tglLahir" id="tglLahir" class="form-control mb-3">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Pendidikan</label>
                                                    <input type="text" name="pendidikan" id="" class="form-control mb-3">
                                                </div>


                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <input type="text" name="alamat" id="" class="form-control mb-3" placeholder="Bjb">
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Handphone</label>
                                                        <input type="text" name="no_telp" id="" class="form-control mb-3" placeholder="08127361736">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" id="" class="form-control mb-3" placeholder="contoh@gmail.com">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="tambahPegawai" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="container col-lg-12 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip & Nama</th>
                                        <th>Jk</th>
                                        <th>Agama</th>
                                        <th>Pendidikan</th>
                                        <th>Gol</th>
                                        <th>Alamat</th>
                                        <th>TTL</th>
                                        <th>Telp</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip & Nama</th>
                                        <th>Jk</th>
                                        <th>Agama</th>
                                        <th>Pendidikan</th>
                                        <th>Gol</th>
                                        <th>Alamat</th>
                                        <th>TTL</th>
                                        <th>Telp</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pegawai as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nip']; ?><br><?= $row['nama']; ?></td>
                                            <td><?= $row['jk']; ?></td>
                                            <td><?= $row['agama']; ?></td>
                                            <td><?= $row['pendidikan']; ?></td>
                                            <td><?= $row['golongan']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['t_lahir']; ?>, <?= $row['tgl_lahir']; ?></td>
                                            <td><?= $row['no_telp']; ?></td>
                                            <td>
                                                <a href="editPegawai.php?nip=<?= $row['nip']; ?>" class="mr-2"><i class="fa fa-edit" style="color: orange;"></a></i>
                                                <a href="hapusPegawai.php?nip=<?= $row['nip']; ?>" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa fa-trash" style="color: red;"></a></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.js-example-basic-single').select2({
        dropdownParent: $('#exampleModal')
    });
</script>

</html>