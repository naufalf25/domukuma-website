<?php 
    session_start();

    if ($_SESSION['level'] == "") {
        header("location:../../index.php?alert=belum_login");
    };

    include '../../connection.php';

    $user = mysqli_query($con, "SELECT * FROM user");
    $data = mysqli_query($con, "SELECT * FROM data");
    $usercount = mysqli_num_rows($user);
    $datacount = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin | Domukuma</title>
    <link rel="shortcut icon" href="../../src/image/logoukm.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="../../src/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/736f9082a4.js" crossorigin="anonymous"></script>
</head>
<body class="font-primary h-screen">
    <header class="p-4 flex flex-wrap justify-between items-center lg:px-6">
        <div class="mb-4 md:mb-0">
            <a href="index.php" class="uppercase font-bold text-3xl tracking-widest lg:text-4xl">Domukuma</a>
            <div class="flex font-semibold text-sm">
                <p>Powered by</p>
                <img src="../../src/image/logoukm.png" alt="logo" width="30rem">
            </div>
        </div>
        <nav class="flex items-center gap-2">
            <a href="https://wa.me/6282134787081" target="_blank" class="px-2 py-1 lg:px-4 lg:py-2 font-semibold text-lg rounded-lg border border-ukm hover:bg-ukm hover:text-white">Hubungi Admin</a>
            <a href="../common/logout.php" class="px-2 py-1 lg:px-4 lg:py-2 font-semibold text-lg rounded-lg border border-red-600 hover:bg-red-600 hover:text-white">Logout</a>
            <button id="openMenu" class="py-1 px-2 font-semibold text-lg border border-ukm rounded-lg cursor-pointer hover:bg-ukm hover:text-white lg:hidden"><i class="fa-solid fa-bars"></i> Menu</button>
        </nav>
    </header>

    <div class="w-full lg:flex lg:overflow-auto">
        <section id="menu" class="absolute w-full left-0 top-0 p-4 bg-slate-800 lg:rounded-tr-xl text-white -translate-y-64 transition-all duration-500 z-10 lg:static lg:h-[86.2vh] lg:w-1/4 lg:translate-y-0">
            <a id="closeMenu" href="#" class="text-xl"><i class="fa-solid fa-xmark lg:hidden"></i></a>
            <h2 class="mt-4 lg:mt-0">Selamat Datang <b><?php echo $_SESSION['nama'] ?></b></h2>
            <nav class="mt-6">
                <div class="flex flex-col gap-2">
                    <a class="nav-side" href="index.php">Beranda</a>
                    <a class="nav-side" href="account.php">Pengelolaan Akun</a>
                    <a class="nav-side" href="baranglist.php">Data Barang</a>
            </div>
            </nav>
        </section>

        <section class="p-4 lg:px-6 lg:w-3/4">
            <h2 class="uppercase font-bold text-2xl lg:text-4xl tracking-widest">Halaman Utama</h2>
            <div class="mt-10 flex flex-col lg:flex-row gap-2">
                <div class="w-full p-4 bg-green-500 rounded-lg text-white text-center">
                    <h2 class="uppercase font-bold text-xl lg:text-2xl">Jumlah Akun User</h2>
                    <p class="mt-2 font-semibold text-xl lg:text-3xl"><?php echo $usercount ?></p>
                </div>
                <div class="w-full p-4 bg-blue-500 rounded-lg text-white text-center">
                    <h2 class="uppercase font-bold text-xl lg:text-2xl">Jumlah Barang Terdaftar</h2>
                    <p class="mt-2 font-semibold text-xl lg:text-3xl"><?php echo $datacount ?></p>
                </div>
            </div>
            <h4 class="mt-10 lg:text-lg">Isi dashboard ini masih dalam <b>tahap pengembangan</b>. Kedepannya akan ditambahkan fitur baru yang menarik</h4>
        </section>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openMenu = document.querySelector('#openMenu');
        const closeMenu = document.querySelector('#closeMenu');
        const menubar = document.querySelector('#menu');

        openMenu.addEventListener('click', (e) => {
            e.preventDefault();
            menu.style.transform = 'translateY(0)';
            openMenu.classList.add('hidden');
        });

        closeMenu.addEventListener('click', (e) => {
            e.preventDefault();
            menu.style.transform = 'translateY(-16rem)';
            openMenu.classList.remove('hidden');
        });
    })
</script>
</html>