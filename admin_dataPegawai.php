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
                                <div class="modal-dialog modal-lg">
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

                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="nama" id="" class="form-control mb-3">
                                                    </div>

                                                    <div class="form-group col-lg-6 mb-3">
                                                        <label for="jabatan">Jabatan</label>
                                                        <select name="jabatan" id="jabatan" class="form-control jabatan" style="width: 100%;" required>
                                                            <option value="" selected disabled>Pilih jabatan</option>
                                                            <option value="hakim">Hakim</option>
                                                            <option value="panitera">Panitera</option>
                                                            <option value="jurusita">Jurusita</option>
                                                            <option value="petugas keuangan">Petugas Keuangan</option>
                                                            <option value="panitera muda">Panitera Muda</option>
                                                            <option value="petugas admin keuangan">Petugas Administrasi Keuangan</option>
                                                            <option value="petugas admin SDM">Petugas Administrasi SDM</option>
                                                            <option value="petugas admin umum">Petugas Administrasi Umum</option>
                                                            <option value="petugas admin perpustakaan">Petugas Administrasi Perpustakaan</option>
                                                            <option value="petugas admin SI">Petugas Administrasi Sistem Informasi</option>
                                                            <option value="petugas admin pelayanan">Petugas Administrasi Pelayanan Masyarakat</option>
                                                            <option value="petugas admin anak">Petugas Administrasi Pengadilan Anak</option>
                                                            <option value="petugas admin pemasyarakatan">Petugas Administrasi Pemasyarakatan</option>
                                                            <option value="petugas mediasi keluarga">Petugas Mediasi Keluarga</option>
                                                            <option value="petugas mediasi perdata">Petugas Mediasi Perdata</option>
                                                            <option value="petugas mediasi pidana">Petugas Mediasi Pidana</option>
                                                            <option value="petugas penelitian hukum">Petugas Penelitian Hukum</option>
                                                            <option value="petugas penelitian sosial">Petugas Penelitian Sosial</option>
                                                            <option value="petugas penelitian kesehatan">Petugas Penelitian Kesehatan</option>
                                                            <option value="petugas teknisi perangkat keras">Petugas Teknisi Perangkat Keras</option>
                                                            <option value="petugas teknisi jaringan">Petugas Teknisi Jaringan</option>
                                                            <option value="petugas teknisi perangkat lunak">Petugas Teknisi Perangkat Lunak</option>
                                                            <option value="petugas TI pidana">Petugas Teknologi Informasi Pidana</option>
                                                            <option value="petugas TI perdata">Petugas Teknologi Informasi Perdata</option>
                                                            <option value="petugas bahasa inggris">Petugas Bahasa Inggris</option>
                                                            <option value="petugas bahasa lain">Petugas Bahasa Lain</option>
                                                            <option value="petugas kesehatan jiwa">Petugas Kesehatan Jiwa</option>
                                                            <option value="petugas rekam medis">Petugas Rekam Medis</option>
                                                            <option value="petugas fotografi">Petugas Fotografi</option>
                                                            <option value="petugas keamanan pengadilan">Petugas Keamanan Pengadilan</option>
                                                            <option value="petugas pemeliharaan fasilitas">Petugas Pemeliharaan Fasilitas</option>
                                                            <option value="petugas transportasi">Petugas Transportasi</option>
                                                            <option value="petugas penerjemah sumpah">Petugas Penerjemah Sumpah</option>
                                                            <option value="petugas pengawas tahanan">Petugas Pengawas Tahanan</option>
                                                            <option value="petugas pengadilan maritim">Petugas Pengadilan Maritim</option>
                                                            <option value="petugas pengadilan agama">Petugas Pengadilan Agama</option>
                                                            <option value="petugas pengadilan militer">Petugas Pengadilan Militer</option>
                                                            <option value="petugas pengadilan adat">Petugas Pengadilan Adat</option>
                                                            <option value="petugas hubungan industri">Petugas Pengadilan Hubungan Industri</option>
                                                            <option value="petugas saksi ahli">Petugas Saksi Ahli</option>
                                                            <option value="petugas penyidik pengadilan">Petugas Penyidik Pengadilan</option>
                                                            <option value="petugas penasehat hukum">Petugas Penasehat Hukum</option>
                                                            <option value="petugas bantuan hukum">Petugas Bantuan Hukum</option>
                                                            <option value="petugas layanan korban">Petugas Layanan Korban</option>
                                                            <!-- Lanjutkan dengan opsi lainnya -->
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="form-group">
                                                    <label for="pendidikan">Pendidikan</label>
                                                    <select name="pendidikan" id="pendidikan" class="form-control pendidikan" style="width: 100%;" required>
                                                        <option value="" selected disabled>Pilih pendidikan</option>
                                                        <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                                        <option value="S1 Teknik Sipil">S1 Teknik Sipil</option>
                                                        <option value="S1 Ilmu Hukum">S1 Ilmu Hukum</option>
                                                        <option value="S1 Psikologi">S1 Psikologi</option>
                                                        <option value="S1 Ekonomi">S1 Ekonomi</option>
                                                        <option value="S1 Akuntansi">S1 Akuntansi</option>
                                                        <option value="S1 Manajemen">S1 Manajemen</option>
                                                        <option value="S1 Pendidikan Matematika">S1 Pendidikan Matematika</option>
                                                        <option value="S1 Pendidikan Bahasa Inggris">S1 Pendidikan Bahasa Inggris</option>
                                                        <option value="S1 Pendidikan Guru Sekolah Dasar (PGSD)">S1 Pendidikan Guru Sekolah Dasar (PGSD)</option>
                                                        <option value="S1 Teknik Elektro">S1 Teknik Elektro</option>
                                                        <option value="S1 Kimia">S1 Kimia</option>
                                                        <option value="S1 Fisika">S1 Fisika</option>
                                                        <option value="S1 Biologi">S1 Biologi</option>
                                                        <option value="S1 Kedokteran">S1 Kedokteran</option>
                                                        <option value="S1 Farmasi">S1 Farmasi</option>
                                                        <option value="S1 Keperawatan">S1 Keperawatan</option>
                                                        <option value="S1 Teknik Mesin">S1 Teknik Mesin</option>
                                                        <option value="S1 Arsitektur">S1 Arsitektur</option>
                                                        <option value="S1 Desain Grafis">S1 Desain Grafis</option>
                                                        <option value="S1 Desain Interior">S1 Desain Interior</option>
                                                        <option value="S1 Hubungan Internasional">S1 Hubungan Internasional</option>
                                                        <option value="S1 Ilmu Komunikasi">S1 Ilmu Komunikasi</option>
                                                        <option value="S1 Jurnalistik">S1 Jurnalistik</option>
                                                        <option value="S1 Sastra Inggris">S1 Sastra Inggris</option>
                                                        <option value="S1 Pendidikan Seni Rupa">S1 Pendidikan Seni Rupa</option>
                                                        <option value="S1 Pendidikan Musik">S1 Pendidikan Musik</option>
                                                        <option value="S1 Ilmu Politik">S1 Ilmu Politik</option>
                                                        <option value="S1 Agribisnis">S1 Agribisnis</option>
                                                        <option value="S1 Peternakan">S1 Peternakan</option>
                                                        <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                                                        <option value="D3 Teknik Sipil">D3 Teknik Sipil</option>
                                                        <option value="D3 Akuntansi">D3 Akuntansi</option>
                                                        <option value="D3 Manajemen">D3 Manajemen</option>
                                                        <option value="D3 Keperawatan">D3 Keperawatan</option>
                                                        <option value="D3 Teknik Elektro">D3 Teknik Elektro</option>
                                                        <option value="D3 Farmasi">D3 Farmasi</option>
                                                        <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                                                        <option value="D3 Desain Grafis">D3 Desain Grafis</option>
                                                        <option value="D3 Kebidanan">D3 Kebidanan</option>
                                                        <option value="D3 Teknik Kimia">D3 Teknik Kimia</option>
                                                        <option value="D3 Analis Kimia">D3 Analis Kimia</option>
                                                        <option value="D3 Teknologi Pangan">D3 Teknologi Pangan</option>
                                                        <option value="D3 Teknologi Informasi">D3 Teknologi Informasi</option>
                                                        <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                                        <option value="D3 Keuangan">D3 Keuangan</option>
                                                        <option value="D3 Pariwisata">D3 Pariwisata</option>
                                                        <option value="D3 Komunikasi">D3 Komunikasi</option>
                                                        <option value="D3 Bahasa Inggris">D3 Bahasa Inggris</option>
                                                        <option value="D3 Administrasi Bisnis">D3 Administrasi Bisnis</option>
                                                        <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                                                        <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                                        <option value="D3 Perhotelan">D3 Perhotelan</option>
                                                        <option value="D3 Tata Rias">D3 Tata Rias</option>
                                                        <option value="D3 Tata Busana">D3 Tata Busana</option>
                                                        <option value="D3 Seni Musik">D3 Seni Musik</option>
                                                        <option value="D3 Teknologi Multimedia">D3 Teknologi Multimedia</option>
                                                        <option value="D3 Perpustakaan">D3 Perpustakaan</option>
                                                        <option value="D3 Penyiaran">D3 Penyiaran</option>
                                                        <option value="D3 Teknik Telekomunikasi">D3 Teknik Telekomunikasi</option>
                                                        <option value="D3 Teknik Otomotif">D3 Teknik Otomotif</option>
                                                    </select>

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
                                        <th>Jabatan</th>
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
                                        <th>Jabatan</th>
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
                                            <td><?= $row['jabatan']; ?></td>
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

    $('.pendidikan').select2({
        dropdownParent: $('#exampleModal')
    });

    $('.jabatan').select2({
        dropdownParent: $('#exampleModal')
    });
</script>

</html>