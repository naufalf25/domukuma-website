<?php
session_start();
include '../../connection.php';
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
                if (isset($_GET['search'], $_GET['owner'])) {
                    $katacari = ucfirst($_GET['search']);
                    $owner = ucfirst($_GET['owner']);
                    if ($owner == "Semua") {
                        $query = "SELECT * FROM data WHERE `nama_barang` LIKE '%".$katacari."%'";
                    } else {
                        $query = "SELECT * FROM `data` WHERE `nama_barang` LIKE '%".$katacari."%' AND `pemilik` LIKE '%".$owner."%'";
                    };
                } else {
                    $query = "SELECT * FROM data";
                };

                $sql = mysqli_query($con, $query);
                $check = mysqli_num_rows($sql);

                if ($check > 0) {
                    while($data = mysqli_fetch_assoc($sql)) {
                        echo "<tr class=\"h-10 text-sm lg:text-base even:bg-slate-200\">
                            <td>{$data['id']}/RIPTEK</td>
                            <td>{$data['nama_barang']}</td>
                            <td>{$data['jumlah']}</td>
                            <td>{$data['pemilik']}</td>
                            <td>{$data['dibuat_oleh']}</td>
                            <td>{$data['timestamp']}</td>
                            <td><a href=\"edit.php?id={$data['id']}\"><i class=\"fa-solid fa-pen-to-square p-2 rounded-lg border border-transparent hover:border-slate-400\"></i></a></td>
                        </tr>";
                    };
                } else {
                    echo "<p class=\"mb-4 text-sm lg:text-base text-center\">Belum Ada Data Ditambahkan/Ditemukan</p>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>