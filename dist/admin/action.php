<?php 
    session_start();

    include '../../connection.php';

    $name = ucfirst($_POST['namabarang']);
    $owner = $_POST['owner'];
    $addby = $_SESSION['type'];
    $jumlah = $_POST['jumlah'];
    ini_set('date.timezone', 'Asia/Jakarta');
    $time = date('d M Y - H:i T');

    if ($owner == "UKM Riptek") {
        $id = rand(100, 200);
        $_SESSION['idrandom'] = $id;
    } else if ($owner == "PSDM") {
        $id = rand(201, 300);
        $_SESSION['idrandom'] = $id;
    } else if ($owner == "Technopreneur") {
        $id = rand(301, 400);
        $_SESSION['idrandom'] = $id;
    } else if ($owner == "Kominfo") {
        $id = rand(401, 500);
        $_SESSION['idrandom'] = $id;
    } else if ($owner == "PTI") {
        $id = rand(501, 600);
        $_SESSION['idrandom'] = $id;
    } else if ($owner == "Robotika") {
        $id = rand(601, 700);
        $_SESSION['idrandom'] = $id;
    };

    $idrandom = $_SESSION['idrandom'];

    $sql = mysqli_query($con, "INSERT INTO data (`id`, `nama_barang`, `jumlah`, `pemilik`, `dibuat_oleh`, `timestamp`) VALUES ('$idrandom', '$name', '$jumlah', '$owner', '$addby', '$time')");

    if ($sql) {
        header("location:baranglist.php?alert=berhasil");
    } else {
        $_SESSION['error'] = "ERROR: Tidak dapat menginput barang. " . mysqli_error($con);

        header("location:baranglist.php?alert=gagal");
    };
?>