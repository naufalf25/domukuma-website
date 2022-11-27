<?php 
session_start();
include '../../connection.php';

$id = $_GET['id'];
$sql = mysqli_query($con, "DELETE FROM user WHERE id_user='$id'");

if ($sql) {
    header("location:account.php?alert=berhasilhapus");
} else {
    $_SESSION['errorupdate'] = "ERROR: Tidak dapat menghapus user. " . mysqli_error($con);

    header("location:account.php?alert=gagal");
}
?>