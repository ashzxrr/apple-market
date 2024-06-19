<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Market</title>
    <link rel="website icon"href="<?= base_url('upload/ic/apple_logo_icon_147318.ico')?>"/>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href=<?= base_url('assets/css/style_9.css')?>>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('node_modules/@fortawesome/fontawesome-free/css/all.min.css'); ?>">

</head>
<style>
    body{
        font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
    }
    .cart-container {
    max-width: 100%;
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
        background-color: rgb(71, 70, 70);
        color:#fff;
        font-style: ;
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
.message {
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 3px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4); /* Efek shadow */
}

.message.success {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.message.error {
  color: #a94442;
  background-color: #f2dede; 
  border-color: #ebccd1;
}

.message.info {
  color: #31708f;
  background-color: #d9edf7;
  border-color: #bce8f1;
}

.message.warning {
  color: #8a6d3b;
  background-color: #fcf8e3;
  border-color: #faebcc;
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
    /* CSS untuk mempercantik checkbox */
    .container-check {  
      display: block;  
      position: relative;  
      margin-bottom: 5px;  
      cursor: pointer;  
      font-size: 25px;  
    }  

    /* Sembunyikan default checkbox */  
    .container-check input {  
      visibility: hidden;  
      cursor: pointer;  
    }  

    /* Create a custom checkbox */  
    .mark {  
      position: absolute;  
      top: 0;  
      left: 0;  
      height: 25px;  
      width: 25px;  
      background-color: lightskyblue;  
    }  

    .container.container-check:hover input ~ .mark {  
      background-color: gray;  
    }  

    .container-check input:checked ~ .mark {  
      background-color: blue;  
    }  

    /* Buat tanda /indikator (sembunyikan ketika tidak dicentang) */  
    .mark:after {  
      content: "";  
      position: absolute;  
      display: none;  
    }  

    /* Tampilkan tanda Ketika dicentang */  
    .container-check input:checked ~ .mark:after {  
      display: block;  
    }  

    /* Style tanda /indikator */  
    .container-check .mark:after {  
      left: 9px;  
      top: 5px;  
      width: 5px;  
      height: 10px;  
      border: solid white;  
      border-width: 0 3px 3px 0;  
      transform: rotate(45deg);  
    } 

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 80%;
        margin: 0 auto;
        font-size: 20px; /* Adjust the font size as needed */
    }

.close-button {
    background-color: #dc3545; /* Set button color to red */
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    margin-top: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.close-button:hover {
    background-color: #c82333; /* Adjust hover color for red */
}

</style>
<body>
    <div id="nav">
        <div id="menu-icon">&#9776;</div>
        <ul>
            <li><a href="<?= base_url('produk/home'); ?>"><i class="ri-apple-fill"></i> Store</a></li>
            <li><a id="tentangKamiLink" style="cursor: pointer;"><i class="ri-information-fill"></i> Tentang Kami</a></li>
            <li><a id="supportLink" style="cursor: pointer;"><i class="ri-hand-heart-fill"></i> Support</a></li>
        </ul>
        
        <form data-type ="form-search" method="get" action="<?php echo base_url('produk/cari'); ?>">
            <input type="textyaa" name="keyword" placeholder="Cari produk..." required>
            <button name="search" type="submit"><i class="ri-search-line"></i></button>
        </form>

      <div id="userIcon">
        <a href="<?= base_url('user-keranjang'); ?>"><i class="ri-shopping-bag-line"></i></a>
      </div>
        <div id="userIcon">
            <a href="<?= base_url('login');?>"> 
            <i class="ri-user-fill"></i>
            </a>
        </div>
    </div>

    <!-- Modal for "Tentang Kami" -->
    <div id="tentangKamiModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('tentangKamiModal')">&times;</span>
        
        <h4>Tentang Kami</h4>

        <ol>
            <li>di buat untuk tugas uas pak purnomo</li>
            <li>ahmad shohazar dan muhammad ikhlal faukhi</li>
            <li>semoga dapat nilai A</li>
        </ol>
       
        <button class="button close-button" onclick="closeModal('tentangKamiModal')">Tutup</button>
    </div>
</div>

<!-- Modal for "Support" -->
<div id="supportModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('supportModal')">&times;</span>
        
        <h4>Support</h4>
        <p>mohon doa nya </p>
        <!-- Close button -->
        <button class="button close-button" onclick="closeModal('supportModal')">Tutup</button>
    </div>
</div>

   
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var menuIcon = document.getElementById('menu-icon');
    var nav = document.getElementById('nav');

    menuIcon.addEventListener('click', function () {
        nav.classList.toggle('show');
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            nav.classList.remove('show');
        }
    });
});

// Function to open modal
function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = 'flex';
        }

        // Function to close modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = 'none';
        }

        // Add event listeners to open modals
        document.getElementById('tentangKamiLink').addEventListener('click', function () {
            openModal('tentangKamiModal');
        });

        document.getElementById('supportLink').addEventListener('click', function () {
            openModal('supportModal');
        });

    </script>
</body>
</html>