<?php 
    session_start();

    if ($_SESSION['level'] == "") {
        header("location:../../index.php?alert=belum_login");
    };

    include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User | Domukuma</title>
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
        <nav class="mx-auto sm:m-0">
            <ul>
                <li class="inline">
                    <a href="https://wa.me/6282134787081" target="_blank" class="px-4 py-2 font-semibold text-lg rounded-lg hover:bg-ukm hover:text-white">Hubungi Admin</a>
                </li>
                <li class="inline">
                    <a class="px-4 py-2 font-semibold text-end text-sm md:text-base lg:text-lg rounded-lg hover:bg-red-600 hover:text-white" href="../common/logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="w-full p-4 lg:px-6">
        <h2>Selamat Datang <b><?php echo $_SESSION['nama']; ?></b></h2>
        <p>Untuk menambahkan barang ke dalam daftar silahkan tekan tombol <b>Tambahkan Barang</b></p>
    </section>

    <section class="w-full p-4 flex flex-col lg:px-6">
        <button id="addButton" class="mx-auto w-60 py-2 px-4 text-black hover:text-white border rounded-lg font-bold tracking-widest add-style"><i class="fa-solid fa-plus"></i> Tambahkan Barang</button>
        <div id="inputForm" class="mt-10 hidden">
            <table class="mx-auto w-72 lg:w-96">
                <form action="action.php" method="POST">
                    <tr>
                        <td class="form-flex">
                            <label for="namabarang">Masukkan Nama Barang</label>
                            <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Contoh: Meja, Perkakas, ..." required />
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="owner">Kepemilikan</label>
                            <input type="text" class="form-control disabled:bg-slate-100 cursor-not-allowed disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" name="owner" id="owner" placeholder="Contoh: UKM Riptek, PTI, ..." value="<?php echo $_SESSION['type']; ?>" required disabled />
                        </td>
                    </tr>
                    <tr>
                        <td class="mt-4 form-flex">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Contoh: 0, 5, 10, ..." required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="submit-button" value="SUBMIT">
                        </td>
                    </tr>
                </form>
            </table>
        </div>
        <div class="mt-10 font-semibold text-center">
        <?php 
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] == "berhasil") {
                    echo '<p id="alertPHP" class="text-green-600">Input Barang Berhasil!</p>';
                } else if ($_GET['alert'] == "berhasilupdate") {
                    echo '<p id="alertPHP" class="text-green-600">Update Barang Berhasil!</p>';
                } else if ($_GET['alert'] == "berhasilhapus") {
                    echo '<p id="alertPHP" class="text-green-600">Hapus Barang Berhasil!</p>';
                } else if ($_GET['alert'] == "gagal") {
                    echo '<p id="alertPHP" class="text-red-600">' . $_SESSION['error'] . '</p>';
                };
            };
        ?>
        </div>
    </section>

    <section class="w-full p-4 lg:px-6">
        <div class="pb-2 border-b text-center">
            <h2 class="font-bold text-2xl tracking-wider">Daftar Barang Yang Sudah Ditambahkan</h2>
            <p class="mt-2">Jumlah barang adalah sebanyak <b><span id="rowCount"></span> barang</b></p>
            <div class="mt-4">
                <form action="index.php" method="GET">
                    <label for="search">Pencarian Barang :</label>
                    <input type="text" id="search" name="search" class="px-2 border border-slate-500 rounded-lg" value="<?php if(isset($_GET['search'])) echo $_GET['search'] ?>" placeholder="contoh: buku, meja, ..." />
                    <input type="submit" value="CARI" class="px-2 border border-ukm bg-ukm font-bold text-white cursor-pointer rounded-lg tracking-wider hover:bg-white hover:text-ukm">
                </form>
            </div>
        </div>
        <div class="mt-6 h-60 overflow-auto">
            <table class="w-[768px] md:w-full">
                <thead class="h-10 bg-slate-300 sticky top-0">
                    <tr class="text-sm lg:text-base">
                        <th>No. ID</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Pemilik</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tBody" class="text-center">
                    <?php
                    if (isset($_GET['search'])) {
                        $katacari = ucfirst($_GET['search']);
                        $query = "SELECT * FROM data WHERE nama_barang LIKE '%".$katacari."%'";
                    } else {
                        $query = "SELECT * FROM data";
                    }

                    $sql = mysqli_query($con, $query);
                    $check = mysqli_num_rows($sql);

                    if ($check > 0) {
                        while($data = mysqli_fetch_assoc($sql)) {
                            if ($data['pemilik'] == $_SESSION['type']) {
                                echo "<tr class=\"h-10 text-sm lg:text-base even:bg-slate-200\">
                                    <td>{$data['id']}/RIPTEK</td>
                                    <td>{$data['nama_barang']}</td>
                                    <td>{$data['jumlah']}</td>
                                    <td>{$data['pemilik']}</td>
                                    <td>{$data['dibuat_oleh']}</td>
                                    <td>{$data['timestamp']}</td>
                                    <td><a href=\"../common/edit.php?id={$data['id']}\"><i class=\"fa-solid fa-pen-to-square p-2 rounded-lg border border-transparent hover:border-slate-400\"></i></a></td>
                                </tr>";
                            };
                        };
                    } else {
                        echo "<p colspan=\"6\" class=\"mb-4 text-sm lg:text-base text-center\">Belum Ada Data Ditambahkan/Ditemukan</td>";
                    }
                    ?>
            </table>
        </div>
        <form action="../common/exportexcel.php" method="POST" class="flex flex-col gap-2">
            <label for="export"><b>Menu Export ke Excel</b>.</label>
            <div class="flex items-center gap-3">
                <input type="text" class="form-control" value="<?php echo $_SESSION['type'] ?>" disabled>
                <input type="submit" class="px-2 py-1 border border-green-500 bg-green-500 text-white cursor-pointer rounded-lg hover:bg-white hover:text-green-500" value="EXPORT">
            </div>
        </form>
    </section>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addButton = document.querySelector('#addButton');
        addButton.addEventListener('click', (e) => {
            e.preventDefault();
            const inputForm = document.querySelector('#inputForm');
            inputForm.classList.toggle('hidden');
            addButton.classList.toggle('close-style');
            
            if (inputForm.classList.contains('hidden')) {
                addButton.innerHTML = '<i class="fa-solid fa-plus"></i> Tambahkan Barang';
            } else {
                addButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Tutup Menu';
            };
        });

        const alert = document.querySelector('#alertPHP');
        if (alert) {
            setInterval(() => {
                alert.remove();
            }, 3000);
        };

        const tbody = document.querySelector('#tBody');
        const rowCount = document.querySelector('#rowCount');
        rowCount.innerHTML = tbody.rows.length;
    });
</script>
</html>