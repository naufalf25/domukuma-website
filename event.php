<?php 
    session_start();

    include './connection.php';

    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $sql = mysqli_query($con, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
    $check = mysqli_num_rows($sql);

    if ($check > 0) {
        $data = mysqli_fetch_assoc($sql);

        if ($data['level'] == "admin") {
            $_SESSION['user'] = $data['username'];
            $_SESSION['level'] = "admin";
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['type'] = $data['type'];

            header("location:dist/admin/index.php");
        } else if ($data['level'] == "user") {
            $_SESSION['user'] = $data['username'];
            $_SESSION['level'] = "user";
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['type'] = $data['type'];

            header("location:dist/user/index.php");
        } else {
            header("location:index.php?alert=gagal");
        }
    } else {
        header("location:index.php?alert=gagal");
    }
?>