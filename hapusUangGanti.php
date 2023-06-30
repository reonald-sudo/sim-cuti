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

$id = $_GET['id'];

if (hapusUangGanti($id) > 0) {
    echo "
    <script>
    document.location.href = 'uangGanti.php';
    alert('Data berhasil terhapus !');
    </script>
    ";
} else {
    mysqli_error($conn);
}

require_once 'templates/script.php';
