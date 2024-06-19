<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      font-family: sans-serif;
    }

    .container {
      max-width: 75%;
      margin: auto;
      height: 80vh;
      margin-top: 5%;
      background: white;

      display: flex; /* Add display flex to the container */
    }

    .left,
    .right {
      width: 50%;
      padding: 30px;
    }

    .flex {
      display: flex;
      justify-content: space-between;
      width: 100%; /* Add width 100% to take full width inside container */
    }

    .flex1 {
      display: flex;
    }

    .main_image img {
      width: 100%; /* Adjusted to take full width inside the container */
      height: auto; /* Allowing the image to scale proportionally */
    }

    .option img {
      width: 75px;
      height: 75px;
      padding: 10px;
    }

    .right {
      padding: 50px 100px 50px 50px;
    }

    h3 {
      color: #F08080;
      margin: 15px 0;
      font-size: 30px;
     }

    
    p,
    small {
      color: #837D7C;
    }

    h4 {
      color: red;
    }

    p {
      margin: 10px 0 10px 0;
      line-height: 25px;
    }
    h5{
      font-size: 30px;
      color: #F08080;
    }

    button[name='buy-button'] {
      width: 100%;
      padding: 10px;
      border: none;
      outline: none;
      background: #C1908B;
      color: white;
      margin-top: 20px; /* Changed percentage to px for consistency */
      border-radius: 30px;
    }

    .payment-slider {
      display: flex;
      overflow: hidden;
      margin-top: 20px;
    }

    .payment-slider label {
      flex: 0 0 auto;
      margin-right: 20px;
      transition: transform 0.5s ease-in-out;
    }

    .payment-slider input[type="radio"] {
      display: none;
    }

    .payment-slider img {
      width: 100px; /* Adjust the width as needed */
      height: auto;
      cursor: pointer;
      border: 2px solid transparent;
      border-radius: 5px;
    }

    .payment-slider img:hover {
      border: 2px solid #C1908B; /* Add your desired border color on hover */
    }
    .detail {
    max-width: 75%;
    margin: auto;
    background: #f5f5f5;
    text-color: black;
    margin-top: 20px; /* Adjust as needed */
    padding: 20px; /* Adjust as needed */
  }

  .detail p{
    color: black;
  }

  .harga {
  width: 100%;
  height: 70px;
  background-color: #f8f8f8; /* Warna latar belakang */
  border: 1px solid #e0e0e0; /* Warna border */
  padding: 10px; /* Padding untuk memberikan ruang di dalam box */
  border-radius: 5px; /* Memberikan sudut melengkung pada border */
  text-align: center; /* Posisi teks di tengah */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan (shadow) */
  margin-top: 10px; /* Jarak antara elemen dengan elemen lainnya */
  
}

.harga h4 {
  color: #333; /* Warna teks */
  font-size: 30px /* Ukuran teks */
}

.harga small {
  color: #333; /* Warna teks untuk bagian kecil (Rp) */
}
.color-selector {
      text-align: center;
      display: flex;
    }

    .color-option {
      display: none;
    }

    .color-label {
      display: inline-block;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin: 5px;
      cursor: pointer;
      box-shadow: 0 0 5px rgba(0, 0, 0, 1);
    }

    .color-label:hover {
      border: 2px solid #333;
    }

    .color-option:checked + .color-label {
      border: 2px solid #333;
    }

    #selected-color {
      margin-top: 20px;
      font-weight: bold;
    }

    /* Warna yang diizinkan */
    .color-black { background-color: #000; }
    .color-white { background-color: #fff; }
    .color-silver { background-color: #c0c0c0; }

    /* Add the following styles for the infinite slider effect */
    @keyframes slide {
      0%, 100% {
        transform: translateX(0);
      }
      25% {
        transform: translateX(-100%);
      }
      50% {
        transform: translateX(-200%);
      }
      75% {
        transform: translateX(-300%);
      }
    }

    .payment-slider label {
      animation: slide 12s infinite linear;
    }

    @media only screen and (max-width: 768px) {
      .container {
        max-width: 90%;
        margin: auto;
        height: auto;
        flex-direction: column;
      }

      .left,
      .right {
        width: 100%;
      }
    }

    @media only screen and (max-width: 511px) {
      .container {
        max-width: 100%;
        height: auto;
        padding: 10px;
      }

      .left,
      .right {
        padding: 0;
      }

      .main_image img {
        width: 100%; /* Adjusted to take full width inside the container */
        height: auto; /* Allowing the image to scale proportionally */
      }

      .option {
        display: flex;
        flex-wrap: wrap;
      }
    }
  </style>
</head>

<body>
  <section>

    <div class="container flex">
      <div class="left">
        <div class="main_image">
          <img src="<?= base_url('upload/produk/' . $produk->foto); ?>" class="slide"
            alt="<?= $produk->nama_produk; ?>">
        </div>
      </div>
      <div class="right">
      <?php if($this->session->flashdata('success')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('success'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
      <?php endif; ?>
              <h3><?= $produk->nama_produk; ?></h3>
        
      <div class="harga">
        <h4><small>Rp : </small><?= number_format($produk->harga, 0, ',', '.'); ?></h4>
      </div>
        <p><strong>Kategori :</strong> <?= $produk->kategori;?></p>
      <form action="<?= base_url('user/tambah_ke_keranjang2/'.$produk->id_produk); ?>" method="post">
      <p><Strong>Pilih Warna Produk</Strong></p ><br>
      <div class="color-selector">
    <label>
      
      <input type="radio" name="color" class="color-option color-black" value="Hitam">
      <div class="color-label color-black"></div>
    </label>

    <label>
      <input type="radio" name="color" class="color-option color-white" value="Putih">
      <div class="color-label color-white"></div>
    </label>

    <label>
      <input type="radio" name="color" class="color-option color-silver" value="Silver">
      <div class="color-label color-silver"></div>
    </label>

    <div id="selected-color"></div>
  </div>

        <label for="jumlah">Jumlah:</label>
          <input type="number" name="jumlah" value="1" min="1" max="<?= $produk->stok; ?>">
        <label for="jumlah"> tersisa <?= $produk->stok;?> buah </label>
        <button type="submit" name="buy-button" class="buy-button">
          <i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang
        </button>
        </form>
  
        <h5>Metode Pembayaran </h5>

        <div class="payment-slider">
          <label >
            <input type="radio" name="metode" id="bca" value="bca">
            <img src="https://th.bing.com/th?id=OIP.1uriXJcIOZk4Zn_qYp2gzAHaCW&w=350&h=111&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2"
              alt="bca" class="payment-logo">
          </label>
          <label >
            <input type="radio" name="metode" id="BRI" value="BRI">
            <img src="https://th.bing.com/th/id/OIP.VRlkaEOeQzAAaErr_KFZtQHaEK?pid=ImgDet&w=207&h=116&c=7"
              alt="BRI" class="payment-logo">
          </label>
          <label >
            <input type="radio" name="metode" id="GOPAY" value="GOPAY">
            <img src="https://th.bing.com/th?id=OIP.9p-C_cAxCT8w2ApMgzs4sgHaCx&w=349&h=131&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2"
              alt="GOPAY" class="payment-logo">
          </label>
          <label >
            <input type="radio" name="metode" id="DANA" value="DANA">
            <img src="https://th.bing.com/th?id=OIP.9FxGi-l8ku1m1o7aOV8aTAHaCK&w=350&h=102&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2"
              alt="DANA" class="payment-logo">
          </label>
          <label>
            <input type="radio" name="metode" id="shoppe" value="shoppe">
            <img src="https://th.bing.com/th?id=OIP.P-bDzBd54iQzV2SQF3Mf-gHaD4&w=345&h=181&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2"
              alt="shoppe" class="payment-logo">
          </label>
          <!-- Add other payment method labels and images here -->
        </div>
        
      </div>
      
    </div>
    <div class="detail" >
      <h3> Deskripsi Produk : </h3>
      <p><br> <?= nl2br($produk->deskripsi); ?></p>

    </div>
  </section>
 <??>
  
  <script>
    // Assuming you have a JavaScript function to handle adding to the cart
    function addToCart(productId) {
      window.location.href = "<?= base_url('user/tambah_ke_keranjang2/'); ?>" + productId;
    }
  </script>
</body>

</html>
