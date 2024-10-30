<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang, Psikolog</title>
    <style>
        /* Mengatur gaya latar belakang */
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            color: white;
        }

        /* Gaya latar belakang dengan blur dan saturasi hitam */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/welcomeimage.png');
            /* Ganti dengan path gambar yang Anda inginkan */
            background-size: cover;
            background-position: center;
            filter: blur(5px) brightness(0.5);
            /* Efek blur dan kegelapan */
            z-index: -1;
        }

        /* Kontainer utama untuk teks dan tombol */
        .container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            /* Lapisan transparan di belakang teks */
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
        }

        /* Logo */
        .logo img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        /* Judul dan deskripsi */
        .title {
            font-size: 24px;
            margin: 20px 0;
        }

        /* Tombol */
        .button {
            display: inline-block;
            background-color: white;
            color: black;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
        }

        .button:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="background"></div> <!-- Latar belakang blur -->

    <!-- Logo -->
    <div class="container">
        <div class="logo">
            <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com Logo">
        </div>
        <p class="title">Selamat Datang, Psikolog...<br>Ayo mulai Konsultasimu kita hari ini!</p>
        <a href="#" class="button">Ayo, mulai</a>
    </div>
</body>

</html>