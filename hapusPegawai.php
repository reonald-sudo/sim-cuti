<?php require_once 'functions.php' ?>
<?php require_once 'templates/header.php' ?>

<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$nip = $_GET['nip'];

if (hapusPegawai($nip) > 0) {
    echo "
    <script>
    document.location.href = 'admin_dataPegawai.php';
    alert('Data berhasil terhapus !');
    </script>
    ";
} else {
    mysqli_error($conn);
}

require_once 'templates/script.php';
