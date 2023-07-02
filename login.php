<?php
session_start();

require_once 'templates/header.php';
require_once 'functions.php';

if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}

if (isset($_POST['login'])) {
    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE nip = '$nip'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);

        // variabel
        $_SESSION['nip'] = $row['nip'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['hak_akses'] = $row['hak_akses'];

        if ($password == $row['password']) {

            // set session
            $_SESSION['login'] = true;

            // cek hak akses
            if ($row['hak_akses'] === 'user') {
                echo "
                <script>
                document.location.href = 'index.php';
                </script>
                ";
            } else if ($row['hak_akses'] == 'admin') {
                echo "
                <script>
                document.location.href = 'admin_index.php';
                </script>
                ";
            } else if ($row['hak_akses'] == 'humas') {
                echo "
                <script>
                document.location.href = 'humas_index.php';
                </script>
                ";
            } else if ($row['hak_akses'] == 'bendahara') {
                echo "
                <script>
                document.location.href = 'bendahara_index.php';
                </script>
                ";
            }
        }
        exit;
    }
}

$error = true;

?>

<style>
    .background {
        background-image: url(dist/img/background.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }
</style>

<body class="hold-transition login-page background">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>SIM CUTI</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login untuk memulai</p>

                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="" class="form-control" placeholder="Nip" name="nip" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</body>
<?php require_once 'templates/script.php' ?>