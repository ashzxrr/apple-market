<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Produk</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .produk-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: left;
      margin-left: 3%;
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

.flex-rating {
  display: flex;
  
}

.flex-rating p{
  line-height: 10px;
  margin-left: 2px;
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
    <?php foreach ($produk as $index => $item) : ?>
      
      
      <div class="produk-card" id="produk<?= $index ?>" data-id="<?= $item->id_produk ?>">
        <img src="<?= base_url('upload/produk/' . $item->foto); ?>" alt="<?= $item->nama_produk; ?>" style="max-width: 150px; max-height: 150px;">
        <h3><?= $item->nama_produk; ?></h3>
        <p>Rp.  <?= number_format($item->harga, 0, ',', '.'); ?></p>
       
      
        <div class="flex-rating" >

        <?php
              // Query untuk menghitung rata-rata rating
              $this->db->select('AVG(rating) as avg_rating');
              $this->db->from('tb_review');
              $this->db->where('id_produk', $item->id_produk);
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
              $this->db->where('id_produk', $item->id_produk);
              $result = $this->db->get()->row();

            // Tampilkan jumlah terjual
            ?>
        <p> <?= ($result->total_terjual) ? $result->total_terjual : 0; ?>  Terjual</p>
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
      <?php endforeach;?>
     
    });

  </script>
</body>
</html>
 