<?php 
session_start();
if ($_SESSION['level'] == "") {
    header("location:../../index.php?alert=belum_login");
};

include '../../connection.php';
$name = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$permission = $_POST['permission'];

$sql = mysqli_query($con, "INSERT INTO user (`id_user`, `nama`, `username`, `password`, `type`, `level`) VALUES (NULL, '$name', '$username', '$password', '$name', '$permission')");

if ($sql) {
    header("location:account.php?alert=berhasil");
} else {
    $_SESSION['errorrequest'] = "ERROR: Tidak dapat membuat akun. " . mysqli_error($con);

    header("location:account.php?alert=gagal");
};
?>