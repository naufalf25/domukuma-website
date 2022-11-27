<?php 
session_start();

if ($_SESSION['level'] == "") {
    header("location:../../index.php?alert=belum_login");
};

include '../../connection.php';

$sql = mysqli_query($con, "SELECT * FROM user");
$check = mysqli_num_rows($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Akun | Domukuma</title>
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

        <section class="px-4 pb-4 lg:px-6 lg:w-3/4 lg:h-[86vh] lg:overflow-x-auto">
            <h2 class="uppercase font-bold text-2xl lg:text-4xl tracking-widest lg:sticky lg:top-0 lg:bg-white">Halaman Pengelolaan Akun</h2>
            <h3 class="mt-4 font-bold text-lg lg:text-2xl tracking-widest text-center">Tambahkan Akun</h3>
            <table class="mt-2 mx-auto w-72 lg:w-96">
                <form action="adduser.php" method="POST">
                    <tr>
                        <td class="form-flex">
                            <label for="nama">Masukkan Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama..." required />
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="username">Masukkan Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username..." required />
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="password">Masukkan Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password..." required />
                            <div>
                                <input type="checkbox" name="showpassword" id="showPassword">
                                <label for="showpassword">Show Password</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="permission">Pilih Permission</label>
                            <select class="form-control" name="permission" id="permission">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="submit-button" value="SUBMIT">
                        </td>
                    </tr>
                </form>
            </table>
            <div id="alert" class="mt-4">
                <?php 
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "berhasil") {
                            echo '<p class="font-semibold text-green-600 text-center">Berhasil membuat akun!</p>';
                        } else if ($_GET['alert'] == "berhasilupdate") {
                            echo '<p class="font-semibold text-green-600 text-center">Berhasil mengedit akun!</p>';
                        } else if ($_GET['alert'] == "berhasilhapus") {
                            echo '<p class="font-semibold text-green-600 text-center">Berhasil menghapus akun!</p>';
                        } else if ($_GET['alert'] == "gagal") {
                            echo '<p class="font-semibold text-red-600 text-center">Gagal membuat akun!'. $_SESSION['errorrequest'] .'</p>';
                        }
                    }
                ?>
            </div>
            <div class="mt-10 pb-2 border-b text-center">
                <h3 class="font-bold text-2xl tracking-wider">Daftar Akun Yang Sudah Terdaftar</h3>
            </div>
            <div class="mt-6 h-60 overflow-auto">
                <table class="w-[768px] md:w-full">
                    <thead class="h-10 bg-slate-300 sticky top-0">
                        <tr class="text-sm lg:text-base">
                            <th>Nama Akun</th>
                            <th>Username</th>
                            <th>Sebagai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tBody" class="text-center">
                        <?php 
                        if ($check > 0) {
                            while($data = mysqli_fetch_assoc($sql)) {
                                echo "<tr class=\"h-10 text-sm lg:text-base even:bg-slate-200\">
                                    <td>{$data['nama']}</td>
                                    <td>{$data['username']}</td>
                                    <td>{$data['level']}</td>
                                    <td><a href=\"edituser.php?id={$data['id_user']}\" class=\"py-1 px-2 rounded-lg border border-transparent hover:bg-ukm hover:text-white hover:border-ukm\"><i class=\"fa-solid fa-pen-to-square\"></i></i></a></td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
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

        const password = document.querySelector('#password');
        const showPassword = document.querySelector('#showPassword');
        showPassword.addEventListener('change', () => {
            if (showPassword.checked) {
                console.log(true);
                password.type = 'text';
            } else {
                password.type = 'password';
                console.log(false);
            };
        });

        const alert = document.querySelector('#alert');
        if (alert.innerHTML) {
            setInterval(() => {
                alert.innerHTML = '';
            }, 5000)
        }
    });
</script>
</html>