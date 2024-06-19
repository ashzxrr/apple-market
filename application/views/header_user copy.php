<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('node_modules/@fortawesome/fontawesome-free/css/all.min.css'); ?>">
  
    <title>Halaman user</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        nav {
            background-color: #555;
            overflow: hidden;
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
         /* Container Style */
.cart-container {
    max-width: 800px;
    margin: 0 5%;
    margin-top: 5%;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Header Style */
.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #314e7d;
    padding: 10px;
    color: #fff;
}

/* Tabel Style */
.table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: #fff;
}

.status-container {
        display: flex;
        align-items: center;
        background-color: #f4f4f4;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .status {
        font-weight: bold;
        margin-right: 8px;
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease-in-out;
    }

    .status:hover,
    .status.active {
        color: #007bff;
    }

    .status:not(:last-child):after {
        content: ">";
        margin-left: 8px;
        color: #333;
    }
/* Tombol Style */
.button, .delete-button, .info-button {
    display: inline-block;
    padding: 8px 16px;
    text-decoration: none;
    color: #fff;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
    cursor: pointer;
}

.button {
    background-color: #007bff;
}

.button:hover {
    background-color: #0056b3;
}

.delete-button {
    background-color: #dc3545;
}

.delete-button:hover {
    background-color: #c82333;
}

.info-button {
    background-color: #73fa6b;
}

.info-button:hover {
    background-color: #6be364;
}
/* Gaya Notifikasi Flash Data */
.flash-message {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid;
    border-radius: 4px;
    text-align: center;
}

.success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.error {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

/* Tombol Tutup */
.close-flash-message {
    cursor: pointer;
    color: inherit;
    float: right;
    font-size: 20px;
    font-weight: bold;
}

/* Gaya Keranjang Kosong */
.empty-cart {
    text-align: center;
    padding: 20px;
}

.empty-cart i {
    color: #bbb;
}
.order-card {
        border: 1px solid #ddd;
        border-radius: 8px;
    margin: 0 2%;

        padding: 5px;
        margin-bottom: 1px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 1000px;
    }

    .product-summary {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .product-summary img {
        margin-right: 10px;
        max-width: 100px;
        max-height: 100px;
        border-radius: 8px;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-total {
        margin-left: auto;
    }
    </style>
</head>
<body>
 
<header>
    <h1>Halaman user</h1>
</header>

<nav>
    <a href="<?= base_url('user-home'); ?>">Home</a>
    <a href="<?= base_url('user-produk'); ?>  ">Produk</a>
    <a href="<?= base_url('user-keranjang'); ?>">Keranjang</a>
    <a href="<?= base_url('user/pesanan_full'); ?>">Pesanan</a>
    <a href="<?php echo site_url('login/logout')?>">Logout</a>

</nav>

<section>
    <!-- Isi konten halaman admin akan ditampilkan di sini -->
    <div id="content">
        <!-- Isi konten halaman akan dimasukkan di sini -->
    </div>
</section>

</body>
</html>
