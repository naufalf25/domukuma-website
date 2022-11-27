<?php 
session_start();
include '../../connection.php';

$id = $_GET['id'];
$sql = mysqli_query($con, "DELETE FROM data WHERE id='$id'");

if ($sql) {
    if ($_SESSION['level'] == "admin") {
        header("location:../{$_SESSION['level']}/baranglist.php?alert=berhasilhapus");
    } else if ($_SESSION['level'] == "user") {
        header("location:../{$_SESSION['level']}/index.php?alert=berhasilhapus");
    }
} else {
    if ($_SESSION['level'] == "admin") {
        $_SESSION['error'] = "ERROR: Tidak dapat menghapus barang. " . mysqli_error($con);

        header("location:../{$_SESSION['level']}/baranglist.php?alert=gagal");
    } else if ($_SESSION['level'] == "user") {
        $_SESSION['error'] = "ERROR: Tidak dapat menghapus barang. " . mysqli_error($con);

        header("location:../{$_SESSION['level']}/index.php?alert=gagal");
    }   
}
?>