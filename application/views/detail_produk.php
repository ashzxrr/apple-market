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
      height: 100vh;
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

.review-item {
    margin-left: 10px;
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

}

.review-text {
    font-size: 16px;
}

.review-author {
    font-style: italic;
    color: #666;
}

.harga {
  width: 100%;
  height: auto;
  background-color: #f8f8f8; /* Warna latar belakang */
  border: 1px solid #e0e0e0; /* Warna border */
  padding: 10px; /* Padding untuk memberikan ruang di dalam box */
  border-radius: 5px; /* Memberikan sudut melengkung pada border */
  text-align: center; /* Posisi teks di tengah */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan (shadow) */
  margin-top: 10px; /* Jarak antara elemen dengan elemen lainnya */
  
  }
  .icon{
    display: flex;
  }
  .icon-st{
  display: flex;
  width: auto;
  height: 37px;
  background : white ;
  border-radius: 10px ; 
  margin-left: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan (shadow) */

  
}
.icon-st i{
  padding: 3px;
}
.icon-st span {
  color: gray;
  line-height: 15px;
  margin-left: 2px;
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
.flex-rating {
  display: flex;
  
}

.flex-rating p{
  line-height: 8px;
  margin-left: 2px;
}

.flex-rat {
  display: flex;
  
}

.flex-rat p{
  line-height: 6px;
  margin-left: 2px;
}

.container-rekomendasi {
    max-width: 75%;
    margin: auto;
    background: #fff;
    text-color: black;
    margin-top: 5px; /* Adjust as needed */
    padding: 10px; /* Adjust as needed */
}


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
    .produk-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: left;
      margin-left: 1%;
      margin-bottom: 20%;
    
    }

    .produk-card {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 15px;
      width: 180px;
      margin: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      opacity: 0; /* Initially set opacity to 0 */
      transform: translateY(20px); /* Move cards down initially */
      transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .produk-card img {
      width: 100px;
      height: 100px; /* Set a fixed height for the product images */
      object-fit: cover; /* Ensure the image covers the specified height without stretching */
    }

    .produk-card h3 {
      margin: 10px 0;
      font-size: 1rem;
      color: #333;
    }

    .produk-card p {
      margin: 5px 0;
      color: #666;
    }

    .buy-button {
      width: 3em;
      height: 2em;
      background-color: #007bff; /* Changed background color */
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      outline: none;
      box-shadow: 0 0 1em rgba(0, 0, 0, .2);
      animation: pulse 1.5s infinite;
    }
    .buy-button:hover {
      background-color: #00C9A7;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
      100% {
        transform: scale(1);
      }
    }

    .flash-message {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .flip-container {
      perspective: 1000px;
    }

    .flip-card {
      transform-style: preserve-3d;
      transition: transform 0.5s;
    }

    .flip-card.flip {
      transform: rotateY(180deg);
    }

    .flip-card .front,
    .flip-card .back {
      backface-visibility: hidden;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    .flip-card .back {
      transform: rotateY(180deg);
    }


h2 {
  background: linear-gradient(90deg, #000,  #E6E6FA, #000);
  letter-spacing: 5px;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  background-repeat: no-repeat;
  background-size: 80%;
  position: relative;
  animation: shine 5s linear infinite;
  font-size: 50px;
  margin-top: 70px;
  z-index: -1;

}

@keyframes shine {
  0% {
    background-position-x: -500%;
  }
  100% {
    background-position-x: 500%;
  }
}

.detail {
  max-width: 75%;
  margin: auto;
  background: #f5f5f5;
  text-color: black;
  margin-top: 20px;
  padding: 20px;
  position: relative;
  z-index: 1;
}

#descriptionContainer.truncated {
  max-height: 80px;
  overflow: hidden;
  transition: max-height 0.5s ease-in-out;
}

#productDescription a {
  display: inline-block;
  margin-top: 10px;
  color: grey;
  cursor: pointer;
  float: right;
  clear: both;
}

.review-item {
  position: relative;
  z-index: 0;
}

.read-more-link {
  color: grey;
  cursor: pointer;
  text-decoration: none; 
}

.read-more-link:hover {
  color: #555; 
}
button[name="kembali"] {
  margin-bottom: 5px;
    border-radius: 10px;
    padding: 10px;
    background-color: #E6E6FA;
    border: 1px solid #ccc;
    color: #6e6e6e;
    cursor: pointer;
    opacity: 2;
    transition: background-color 0.3s ease; /* Menambahkan efek transisi pada perubahan warna latar belakang */
}

button[name="kembali"]:hover {
    background-color: #b3b3cc; /* Warna latar belakang pada hover */
}  

  </style>
</head>

<body>
  <section>

    <div class="container flex">
      <div class="left">
        <button name="kembali" onclick="goBack()"><i class="fas fa-arrow-left"></i> Kembali</button>
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
      <div class="flex-rat" >

        <?php
              // Query untuk menghitung rata-rata rating
              $this->db->select('AVG(rating) as avg_rating, COUNT(id_review) as total_reviews');
              $this->db->from('tb_review');
              $this->db->where('id_produk', $produk->id_produk);
              $result = $this->db->get()->row();

              // Tampilkan nilai rata-rata rating dalam bentuk bintang dengan warna gold
              if ($result->avg_rating !== null) {
                  $avg_rating = round($result->avg_rating);
                  ?>
              <p style="color: gold; text-decoration: underline;"> <strong><?= number_format($avg_rating, 1); ?></strong></p>
                <p>|</p>
              <?php
            
              for ($i = 1; $i <= 5; $i++) {
                  echo ($i <= $avg_rating) ? '<span style="color: gold;">★</span>' : '☆';
              }
              ?>
              <p>|</p>
              <p style="color: black; text-decoration: underline;"><strong><?= $result->total_reviews; ?></strong> </p>
              <p>Ulasan</p>
          <?php } else { ?>
              <p>none</p>
          <?php } ?>
          
          <?php
                // Query untuk menghitung jumlah terjual
                $this->db->select('SUM(jumlah) as total_terjual');
                $this->db->from('orders_detail');
                $this->db->where('id_produk', $produk->id_produk);
                $result = $this->db->get()->row();

              // Tampilkan jumlah terjual
              ?>
              <P>|</P>
          <p style="color: black; text-decoration: underline;"><strong><?= ($result->total_terjual) ? $result->total_terjual : 0; ?></strong> </p>
          <p>Terjual</p>
          </div>
        
      <div class="harga">
      

  

        <div class="icon" >
          <div class="icon-st" >
          <?php if ($produk->stok > 0) : ?>
              <i class="fas fa-check-circle" style="color: green;"></i>
              <span>Stok Tersedia</span>
          <?php else : ?>
              <i class="fas fa-times-circle" style="color: red;"></i>
              <span>Stok Habis</span>
          <?php endif; ?>
          </div>

          <div class="icon-st" >

          <i class="fas fa-shipping-fast" style="color: blue;"></i>
          <span>Pengiriman Cepat</span>
          </div>
        </div>
        <h4><small>Rp. </small><?= number_format($produk->harga, 0, ',', '.'); ?></h4>
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

   
    <div class="detail">
  <h3>Deskripsi Produk :</h3>
  <div id="descriptionContainer" class="truncated">
    <p id="descriptionContent"><?= nl2br($produk->deskripsi); ?></p>
  </div>
  <a href="javascript:void(0);" onclick="toggleDescription()" class="read-more-link">Baca Selengkapnya</a>
</div>



<div class="detail">
  <h3>Review Produk:</h3>

  <?php
  $visibleReviews = min(3, count($reviews));//atur aja mau berapa review dulu yang tampil disini
  for ($i = 0; $i < $visibleReviews; $i++) {
    $review = $reviews[$i];
  ?>
    <div class="review-item">
      <p class="review-author">Oleh: <?= $review['nama_pembeli']; ?></p>
      <?php
      $avg_rating = $review['rating'];
      for ($j = 1; $j <= 5; $j++) {
        echo ($j <= $avg_rating) ? '<span style="color: gold;">★</span>' : '☆';
      }
      ?>
      <p class="review-text"> Ulasan: <?= $review['review']; ?></p>
    </div>
  <?php } ?>

  <?php if (count($reviews) > $visibleReviews) : ?>
    <button id="showAllReviewsBtn" onclick="showAllReviews()">Lihat Semua Ulasan</button>
    <div id="hiddenReviews" style="display: none;">
      <?php for ($i = $visibleReviews; $i < count($reviews); $i++) {
        $review = $reviews[$i];
      ?>
        <div class="review-item">
          <p class="review-author">Oleh: <?= $review['nama_pembeli']; ?></p>
          <?php
          $avg_rating = $review['rating'];
          for ($j = 1; $j <= 5; $j++) {
            echo ($j <= $avg_rating) ? '<span style="color: gold;">★</span>' : '☆';
          }
          ?>
          <p class="review-text"> Ulasan: <?= $review['review']; ?></p>
        </div>
      <?php } ?>
      <button id="hideAllReviewsBtn" onclick="hideAllReviews()">Kembali</button>
    </div>
  <?php endif; ?>

</div>

    <h2 class="shining-text">Rekomendasi produk</h2>
<div class="container-rekomendasi" >


<div class="produk-container">
  
  <!--  -->
  
  <?php foreach ($rekomendasi as $index => $item) : ?>
    <?php
            // Check if the product belongs to the specified category ('iphone' in this case)
            if ($item['kategori'] == $produk->kategori) {
        ?>

    <div class="produk-card" id="produk<?= $index ?>" data-id="<?= $item['id_produk']; ?>">
      <img src="<?= base_url('upload/produk/' . $item['foto']); ?>" alt="<?= $item['nama_produk']; ?>" style="max-width: 150px; max-height: 150px;">
      <h3><?= $item['nama_produk']; ?></h3>
      <p>Rp.  <?= number_format($item['harga'], 0, ',', '.'); ?></p>
      <div class="flex-rating" >

        <?php
              // Query untuk menghitung rata-rata rating
              $this->db->select('AVG(rating) as avg_rating');
              $this->db->from('tb_review');
              $this->db->where('id_produk', $item['id_produk']);
              $result = $this->db->get()->row();

              // Tampilkan nilai rata-rata rating dalam bentuk bintang dengan warna gold
              if ($result->avg_rating !== null) {
                  $avg_rating = round($result->avg_rating);
                  ?>

                      <?php
                      for ($i = 1; $i <= 5; $i++) {
                          echo ($i <= $avg_rating) ? '<span style="color: gold;">★</span>' : '☆';
                      }
                      ?>
              <?php } else { ?>
                  <p>none</p>
              <?php } ?>
              <?php
              // Query untuk menghitung jumlah terjual
              $this->db->select('SUM(jumlah) as total_terjual');
              $this->db->from('orders_detail');
              $this->db->where('id_produk', $item['id_produk']);
              $result = $this->db->get()->row();

            // Tampilkan jumlah terjual
            ?>
        <p> <?= ($result->total_terjual) ? $result->total_terjual : 0; ?>  Terjual</p>
        </div>


      
    </div>
    <?php } ?>

  <?php endforeach; ?>

</div>
</div>

  </section>

  
  <script>
document.addEventListener('DOMContentLoaded', function () {
      <?php foreach ($rekomendasi as $index => $item) : ?>
        <?php
            // Check if the product belongs to the specified category ('iphone' in this case)
            if ($item['kategori'] == $produk->kategori) {
        ?>
        var card<?= $index ?> = document.getElementById('produk<?= $index ?>');
        var description<?= $index ?> = document.getElementById('description<?= $index ?>');

        setTimeout(function () {
          card<?= $index ?>.style.opacity = 1;
          card<?= $index ?>.style.transform = 'translateY(0)';
        }, <?= $index * 100 ?>);
             // Tambahkan event listener click pada setiap kartu produk
      card<?= $index ?>.addEventListener('click', function () {
        var productId = this.getAttribute('data-id');
        window.location.href = '<?= base_url('produk/detail_produk/') ?>' + productId;
      });
      <?php } ?>
      <?php endforeach; ?>
    });

    
    function toggleDescription() {
  var descriptionContainer = document.getElementById("descriptionContainer");

  if (descriptionContainer.classList.contains("truncated")) {
    descriptionContainer.classList.remove("truncated");
    descriptionContainer.style.maxHeight = "none"; 
  } else {
    descriptionContainer.classList.add("truncated");
    descriptionContainer.style.maxHeight = "80px"; 
  }
}

  

function addBackButton() {
  var backButton = document.createElement("a");
  backButton.href = "javascript:void(0);";
  backButton.textContent = "Kembali";
  backButton.onclick = function () {
    toggleDescription();
  };

  var descriptionContainer = document.getElementById("descriptionContainer");
  descriptionContainer.appendChild(backButton);
}

function removeBackButton() {
  var backButton = document.querySelector("#descriptionContainer a");
  if (backButton) {
    backButton.remove();
  }
}

document.addEventListener('DOMContentLoaded', function () {
  var descriptionContainer = document.getElementById("descriptionContainer");

  if (descriptionContainer.scrollHeight > descriptionContainer.clientHeight) {
    descriptionContainer.classList.add("truncated");
    var readMoreLink = document.querySelector("#productDescription a");
    readMoreLink.style.display = "inline";
  }
});




  function showAllReviews() {
    document.getElementById("hiddenReviews").style.display = "block";
    document.getElementById("showAllReviewsBtn").style.display = "none";
    document.getElementById("hideAllReviewsBtn").style.display = "inline";
  }

  function hideAllReviews() {
    document.getElementById("hiddenReviews").style.display = "none";
    document.getElementById("showAllReviewsBtn").style.display = "inline";
    document.getElementById("hideAllReviewsBtn").style.display = "none";
  }

  function goBack() {
        window.history.back();
    }

    

  </script>
</body>

</html>