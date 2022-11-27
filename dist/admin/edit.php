<?php 
session_start();

include '../../connection.php';
$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM data WHERE id='$id'");
$data = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Editing | Domukuma</title>
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
            <h2 class="uppercase font-bold text-2xl lg:text-4xl tracking-widest lg:sticky lg:top-0 lg:bg-white">Halaman Pengeditan Barang</h2>
            <p>Untuk mengedit barang, silahkan perbaiki melalui <b>form berikut</b>.</p>
            <div id="idItem" class="hidden"><?php echo $id ?></div>
            <table class="mt-10 mx-auto w-72 lg:w-96">
                <form action="../common/update.php?id=<?php echo $id ?>" method="POST">
                    <tr>
                        <td class="form-flex">
                            <label for="namabarang">Masukkan Nama Barang</label>
                            <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Contoh: Meja, Perkakas, ..." value="<?php echo $data['nama_barang'] ?>" required />
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="owner">Kepemilikan</label>
                            <select name="owner" id="owner" class="form-control">
                                <option value="UKM Riptek" <?php if ($data['pemilik'] == "UKM Riptek") echo 'selected' ?>>UKM Riptek</option>
                                <option value="Technopreneur" <?php if ($data['pemilik'] == "Technopreneur") echo 'selected' ?>>Technopreneur</option>
                                <option value="Kominfo" <?php if ($data['pemilik'] == "Kominfo") echo 'selected' ?>>Kominfo</option>
                                <option value="PTI" <?php if ($data['pemilik'] == "PTI") echo 'selected' ?>>PTI</option>
                                <option value="Robotika" <?php if ($data['pemilik'] == "Robotika") echo 'selected' ?>>Robotika</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Contoh: 0, 5, 10, ..." value="<?php echo $data['jumlah'] ?>" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="submit-button" value="SUBMIT">
                            <button id="deleteButton" class="w-full mt-6 py-2 px-4 rounded-lg font-bold tracking-widest text-white cursor-pointer border border-red-600 bg-red-600 hover:bg-white hover:text-red-600">HAPUS</button>
                        </td>
                    </tr>
                </form>
            </table>

            <h4 class="mt-10 lg:text-lg">Isi dashboard ini masih dalam <b>tahap pengembangan</b>. Kedepannya akan ditambahkan fitur baru yang menarik</h4>
        </section>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteButton = document.querySelector('#deleteButton');
    const idItem = document.querySelector('#idItem');
    deleteButton.addEventListener('click', (e) => {
        e.preventDefault();
        
        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Barang Ini?',
            text: "Anda tidak dapat mengembalikan data barang ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batalkan'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../common/delete.php?id=${idItem.innerHTML}`;
            };
        });
    });

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
    });
</script>
</html>