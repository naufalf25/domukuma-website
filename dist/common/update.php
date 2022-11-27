<?php 
session_start();

include '../../connection.php';
$id = $_GET['id'];

$name = $_POST['namabarang'];
if ($_SESSION['level'] == "admin") {
    $owner = $_POST['owner'];
} else if ($_SESSION['level'] == "user") {
    $owner = $_SESSION['type'];
}
$jumlah = $_POST['jumlah'];
ini_set('date.timezone', 'Asia/Jakarta');
$time = date('d M Y - H:i T');

$sql = mysqli_query($con, "UPDATE data SET nama_barang='$name', jumlah='$jumlah', pemilik='$owner', timestamp='$time' WHERE id='$id'");

if ($sql) {
    if ($_SESSION['level'] == "admin") {
        header("location:../{$_SESSION['level']}/baranglist.php?alert=berhasilupdate");
    } else if ($_SESSION['level'] == "user") {
        header("location:../{$_SESSION['level']}/index.php?alert=berhasilupdate");
    }
} else {
    if ($_SESSION['level'] == "admin") {
        $_SESSION['errorupdate'] = "ERROR: Tidak dapat mengupdate barang. " . mysqli_error($con);

        header("location:../{$_SESSION['level']}/baranglist.php?alert=gagal");
    } else if ($_SESSION['level'] == "user") {
        $_SESSION['errorupdate'] = "ERROR: Tidak dapat mengupdate barang. " . mysqli_error($con);

        header("location:../{$_SESSION['level']}/index.php?alert=gagal");
    }
}
?>