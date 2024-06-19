 <style>

    .produk-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: left;
      margin-left: 10%;
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

    .star-container {
      display: flex;
    }

    .star-container i {
      font-size: 1.2rem;
      margin-right: 2px;
      color: #fdd835; /* Warna kuning untuk bintang terisi */
    }
    .star-container i.filled {
  color: #fdd835; /* Warna kuning untuk bintang  terisi */
}
.star-container i.half-filled {
  position: relative;
  display: inline-block;
  overflow: hidden;
}

.star-container i.half-filled:after {
  content: '\2605'; /* Karakter Unicode untuk bintang penuh */
  position: absolute;
  left: 0;
  top: 0;
  width: 50%;
  overflow: hidden;
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

  </style>
</head>
<body>

  <h2 class="shining-text">katalog produk</h2>

  <?php
  // Tampilkan pesan flashdata jika ada
  $message = $this->session->flashdata('message');
  if ($message) {
    echo '<div class="flash-message">' . $message . '</div>';
  }
  ?>

  <div class="produk-container">
    <?php foreach ($produkall as $index => $item) : ?>
      <div class="produk-card" id="produk<?= $index ?>" data-id="<?= $item->id_produk ?>">
        <img src="<?= base_url('upload/produk/' . $item->foto); ?>" alt="<?= $item->nama_produk; ?>" style="max-width: 150px; max-height: 150px;">
        <h3><?= $item->nama_produk; ?></h3>
        <p>Harga: <?= $item->harga; ?></p>
        <p>Stok: <?= $item->stok; ?></p>

        <form action="<?= base_url('user/tambah_ke_keranjang/'.$item->id_produk) ?>" method="post">
          <label for="jumlah">Jumlah:</label>
          <input type="number" name="jumlah" value="1" min="1" max="<?= $item->stok; ?>">
          <button type="submit" class="buy-button">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </form>

        <!-- Tambahkan logika untuk menampilkan pesan bahwa produk sudah ada di keranjang -->
        <?php if ($user_data && $this->user_model->is_produk_in_keranjang($user_data->id_pelanggan, $item->id_produk)) : ?>
          <p>Produk sudah ada di keranjang.</p>
        <?php endif; ?>

        <!-- Description for the product -->
        <div id="description<?= $index ?>" style="display: none;">
          <p>Description: <?= $item->deskripsi; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

 

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php foreach ($produk as $index => $item) : ?>
        var card<?= $index ?> = document.getElementById('produk<?= $index ?>');
        var description<?= $index ?> = document.getElementById('description<?= $index ?>');

        setTimeout(function () {
          card<?= $index ?>.style.opacity = 1;
          card<?= $index ?>.style.transform = 'translateY(0)';
        }, <?= $index * 500 ?>);
             // Tambahkan event listener click pada setiap kartu produk
      card<?= $index ?>.addEventListener('click', function () {
        var productId = this.getAttribute('data-id');
        window.location.href = '<?= base_url('produk/detail_produk/') ?>' + productId;
      });

        // Fetch and display review ratings for each product
        fetch(`<?= base_url('user/get_review_ratings/' . $item->id_produk) ?>`)
          .then(response => response.json())
          .then(data => {
            var ratingContainer<?= $index ?> = document.createElement('div');
            ratingContainer<?= $index ?>.classList.add('rating-container');

            if (data.average_rating) {
              // Tampilkan bintang untuk nilai rating
              var starContainer<?= $index ?> = generateStars(data.average_rating);
              ratingContainer<?= $index ?>.appendChild(starContainer<?= $index ?>);

              var totalRatings<?= $index ?> = document.createElement('p');
              totalRatings<?= $index ?>.textContent = `Ulasan: ${data.total_ratings}`;
              ratingContainer<?= $index ?>.appendChild(totalRatings<?= $index ?>);
            } else {
              var noRatings<?= $index ?> = document.createElement('p');
              noRatings<?= $index ?>.textContent = 'No Ratings Yet.';
              ratingContainer<?= $index ?>.appendChild(noRatings<?= $index ?>);
            }

            card<?= $index ?>.appendChild(ratingContainer<?= $index ?>);
          })
          .catch(error => console.error('Error fetching review ratings:', error));
      <?php endforeach; ?>
    });

    // Fungsi untuk menghasilkan bintang
function generateStars(rating) {
  const starContainer = document.createElement('div');
  starContainer.classList.add('star-container');

  const fullStars = Math.floor(rating); // Bintang penuh berdasarkan nilai bulat rating
  const halfStar = rating % 1 !== 0; // Cek apakah ada setengah bintang

  for (let i = 1; i <= 5; i++) {
    const star = document.createElement('i');
    star.classList.add('fas', 'fa-star');

    // Tandai bintang sebagai terisi
    if (i <= fullStars) {
      star.classList.add('filled');
    } else if (halfStar && i === fullStars + 1) {
      // Jika ada setengah bintang, tandai setengah dari bintang terakhir
      star.classList.add('half-filled');
    }

    starContainer.appendChild(star);
  }

  return starContainer;
}
  </script>
 