<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang, Psikolog</title>
    <style>
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

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/psikologBC.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(5px) brightness(0.5);
            z-index: -1;
        }

        .container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
        }

        .logo img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            margin: 20px 0;
        }

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
    <div class="background"></div> 

    <!-- Logo -->
    <div class="container">
        <div class="logo">
            <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com Logo">
        </div>
        <p class="title">Selamat Datang, Psikolog...<br>Ayo mulai Konsultasimu kita hari ini!</p>
        <a href="<?= base_url('dashboardpsikolog') ?>" class="button">Ayo, mulai</a>
    </div>
</body>

</html>