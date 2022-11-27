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
<body class="font-primary">
    <header class="p-4 flex flex-wrap justify-between items-center lg:px-6">
        <div class="mb-4 md:mb-0">
            <h1 class="uppercase font-bold text-3xl tracking-widest lg:text-4xl">Domukuma</h1>
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
                    <a class="px-4 py-2 font-semibold text-end text-sm md:text-base lg:text-lg rounded-lg hover:bg-red-600 hover:text-white" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="w-full p-4 lg:px-6">
        <h2>Selamat Datang <b><?php echo $_SESSION['nama']; ?></b></h2>
        <p>Untuk mengedit barang, silahkan perbaiki melalui <b>form berikut</b>.</p>
    </section>

    <section>
        <div id="idItem" class="hidden"><?php echo $id ?></div>
        <table class="mt-10 mx-auto w-72 lg:w-96">
            <form action="update.php?id=<?php echo $id ?>" method="POST">
                <tr>
                    <td class="form-flex">
                        <label for="namabarang">Masukkan Nama Barang</label>
                        <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Contoh: Meja, Perkakas, ..." value="<?php echo $data['nama_barang'] ?>" required />
                    </td>
                </tr>
                <tr>
                    <td class="mt-4 form-flex">
                        <label for="owner">Kepemilikan</label>
                        <input type="text" class="form-control disabled:bg-slate-100 cursor-not-allowed disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" name="owner" id="owner" placeholder="Contoh: UKM Riptek, PTI, ..." value="<?php echo $data['pemilik'] ?>" required disabled />
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
    </section>
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
                window.location.href = `delete.php?id=${idItem.innerHTML}`;
            };
        });
    });
</script>
</html>