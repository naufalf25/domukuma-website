<?php 
session_start();
include '../../connection.php';

$id = $_GET['id'];
$name = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$permission = $_POST['permission'];

$sql = mysqli_query($con, "UPDATE user SET nama='$name', username='$username', password='$password', level='$permission' WHERE id_user='$id'");

if ($sql) {
    header("location:account.php?alert=berhasilupdate");
} else {
    $_SESSION['error'] = "ERROR: Tidak dapat membuat akun. " . mysqli_error($con);

    header("location:account.php?alert=gagal");
};
?>