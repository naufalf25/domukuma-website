<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Domukuma Website UKM RIPTEK</title>
    <link rel="shortcut icon" href="./src/image/logoukm.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="./src/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body class="font-primary">
    <header class="p-4 flex flex-wrap justify-between items-center lg:px-6">
        <div class="mb-4 lg:mb-0">
            <a href="index.php" class="uppercase font-bold text-3xl tracking-widest lg:text-4xl">Domukuma</a>
            <div class="flex font-semibold text-sm">
                <p>Powered by</p>
                <img src="./src/image/logoukm.png" alt="logo" width="30rem">
            </div>
        </div>
        <nav>
            <a href="https://wa.me/6282134787081" target="_blank" class="px-4 py-2 font-semibold text-lg rounded-lg hover:bg-ukm hover:text-white">Hubungi Admin</a>
        </nav>
    </header>

    <section class="w-full mt-10 p-4 lg:px-6 text-center">
        <h2 class="font-semibold text-xl">Harap Login untuk mengakses fitur di <span class="font-bold tracking-wide">DOMUKUMA</span></h2>
    </section>

    <section class="w-full mt-4 p-4 lg:px-6">
        <table class="w-72 mx-auto">
            <form action="./event.php" method="POST">
                <tr>
                    <td class="form-flex">
                        <label for="username">Masukkan Username</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username..." required />
                    </td>
                </tr>
                <tr>
                    <td class="mt-4 form-flex">
                        <label for="password">Masukkan Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password..." required />
                        <div>
                            <input type="checkbox" name="showpassword" id="showPassword">
                            <label for="showpassword">Show Password</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="submit-button" type="submit" value="LOGIN">
                    </td>
                </tr>
            </form>
        </table>
    </section>

    <section class="w-full mt-10 p-4 lg:px-6">
        <p class="font-semibold text-red-600 text-center">
            <!-- Anda Harus Login Terlebih Dahulu! -->
            <?php
                if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == "gagal") {
                        echo "Maaf, Username dan Password Salah!";
                    } else if ($_GET['alert'] == "belum_login") {
                        echo "Anda Harus Login Terlebih Dahulu!";
                    } else if ($_GET['alert'] == "logout") {
                        echo "Anda Telah Logout!";
                    };
                };
            ?>
        </p>
    </section>
</body>
<script src="./src/script/main.js"></script>
</html>