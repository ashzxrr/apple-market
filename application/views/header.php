<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://www.pngwing.com/id/free-png-neayz" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="<?= base_url('assets/css/style_2.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('node_modules/@fortawesome/fontawesome-free/css/all.min.css'); ?>">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1.shining-text {
            background: linear-gradient(90deg, #000, #fff, #000);
            letter-spacing: 5px;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            background-repeat: no-repeat;
            background-size: 80%;
            position: relative;
            animation: shine 5s linear infinite;
            margin-top: 70px; /* Adjust the margin to give space below the navbar */
        }

        @keyframes shine {
            0% {
                background-position-x: -500%;
            }
            100% {
                background-position-x: 500%;
            }
        }

        nav {
            background-color: #555;
            overflow: hidden;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000; /* Set a higher z-index to ensure the navbar is above other elements */
        }

        nav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        section {
            padding: 20px;
        }
.notification-icon {
    position: relative;
    display: inline-block;
}

.badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #e44d26;
    color: #fff;
    border-radius: 50%;
    padding: 3px 5px;
    font-size: 9px;
    font-weight: bold;
}

.notification-dropdown {
    position: absolute;
    top: 40px;
    right: 0;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 10px;
    min-width: 200px;
    z-index: 1;
    display: none;
}

.notification-item {
    margin-bottom: 20px;
}

.notification-title {
    font-weight: bold;
    margin-bottom: 5px;
}

.notification-message {
    color: #333;
    margin-bottom: 5px;
}

.notification-time {
    color: #888;
    font-size: 12px;
}

.notification-icon:hover .notification-dropdown {
    display: block;
}
    </style>
</head>
<body>

<header>
    <h1 class="shining-text">Selamat Bekerja Admin</h1>
</header>

<nav>
    <a href="<?= base_url('admin-home'); ?>"><i class="fas fa-home"></i> Home</a>
    <a href="<?= base_url('admin-produk'); ?>"><i class="fas fa-box"></i> Produk</a>
    <a href="<?= base_url('admin-orders'); ?>"><i class="fas fa-shopping-cart"></i> Orders</a>
    <a href="<?= base_url('admin/pembayaran'); ?>"><i class="fas fa-money-bill-wave"></i> Pembayaran</a>
    <div class="notification-icon">

    <a href="<?= base_url('admin/notifikasi'); ?>">
        <i class="fas fa-bell"></i>
        <span class="badge"><?= count($notifications); ?></span>
        Notifikasi
    </a>
    </div>
    <a style="" href="<?php echo site_url('login/logout')?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    
</nav>

<section>
    <!-- Isi konten halaman admin akan ditampilkan di sini -->
    <div id="content">
        <!-- Isi konten halaman akan dimasukkan di sini -->
    </div>
</section>

</body>
</html>
