<style>
 #nav2 {
    height: 45px;
    width: 100%;
    background-color: #E6E6FA;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    color: #6e6e6e;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 45px; /* Adjust the top position based on the height of #nav */
    left: 0;
    z-index: 98; /* Adjust the z-index to be lower than #nav */
}

#nav2 ul {
    list-style-type: none;
    display: flex;
    flex-direction: row;
    padding: 0; /* Remove default padding */
    margin: 0; /* Remove default margin */
}

#nav2 li {
    margin-right: 15px;
    cursor: pointer;
}

#nav2 li a {
    text-decoration: none;
    font-weight: 500;
    font-size: 18px;
    color: #6e6e6e;
}

#nav2 li:hover {
    color: #fff;
    background-color: #ddd;
    
}

@media only screen and (max-width: 768px) {
    #nav2 {
        top: 45px;
        z-index: 97;
    }

    .content {
        margin-top: 45px; 
    }

    .order-card {
        width: 100%; 
    }
}






    .content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 60px;
        z-index: -3;
    }
    .order-card {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%; 
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    .product-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .product-details img {
        max-width: 100px; 
        height: auto;
        margin-right: 10px;
    }

    .product-details,
    .product-total {
        flex: 1;
        flex-direction: column;
        
    }

    .detail-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #3CB371;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin: 10px 0;
    }

    .detail-button:hover {
        background-color: #45a049; 
    }

    .complete-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #FFD700; 
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin: 10px 0;
    }

    .complete-button:hover {
        background-color: #FFC72C; 
    }

    .product-total {
        
    }
    .star-rating {
  display: inline-block;
}

.star-rating input {
  display: none;
}

.star-rating label {
  float: right;
  padding: 5px;
  cursor: pointer;
  font-size: 1.5em;
  color: #ddd;
}

.star-rating label:before {
  content: '\2605'; /* Karakter bintang (Unicode) */
}

.star-rating input:checked ~ label {
  color: #fdd835; /* Warna kuning */
}
.star-rating input.active ~ label {
    color: #fdd835; /* Warna kuning */
  }

 @media (min-width: 768px) {
        .order-card {
            width: 75%; 
        }
        .product-total {
            float: top;
        }
    }
</style>

            


<div class='content'>


<?php
$grouped_orders = []; // Array untuk mengelompokkan pesanan berdasarkan id_pesanan

// Mengelompokkan pesanan berdasarkan id_pesanan
foreach ($user_orders_details as $item) {
    $id_pesanan = $item['id_pesanan'];

    if (!isset($grouped_orders[$id_pesanan])) {
        $grouped_orders[$id_pesanan] = [];
    }

    $grouped_orders[$id_pesanan][] = $item;
}

// Menampilkan pesanan yang telah dikelompokkan
foreach ($grouped_orders as $group) {
    ?>
    <div class="order-card">
        <h4>Status Order: <?= $group[0]['status_order']; ?></h4>
        <!-- Tampilkan ringkasan pesanan -->
        <?php
        $uniqueShippingCost = null;
        $uniqueTotalPayment = null;
        foreach ($group as $product):
            ?>
            <div class="product-summary">
            
                <img src="<?= base_url('upload/produk/' . $product['foto']); ?>" alt="Foto Produk">
                <div class="product-details">
                    <?php if($this->session->flashdata('success')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('success'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
<?php endif; ?>
                    <p><?= $product['nama_produk']; ?></p>
                    <p>Jumlah: <?= $product['jumlah']; ?></p>
                    <?php if ($group[0]['status_order'] == 'Selesai'): ?>
                        <form action="<?= base_url('user/submit_review'); ?>" method="post">
                    <input type="hidden" name="id_produk" value="<?= $product['id_produk']; ?>">
                    <input type="hidden" name="id_pesanan" value="<?= $product['id_pesanan']; ?>">
                    <p>Beri Rating:</p>
                    <div class="star-rating" id="productRating<?= $product['id_produk']; ?>">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $product['id_produk'] ?>_<?= $i ?>">
                            <label for="star<?= $product['id_produk'] ?>_<?= $i ?>"></label>
                        <?php endfor; ?>
                    </div><br>
                    <input type="textarea" name="review"  >
             
                    <button type="submit">Kirim Review</button>
                </form>
                <?php endif; ?>
                </div>
                <!-- Formulir review di bawah foto produk -->
                
                <!-- Akhir formulir review -->
                <div class="product-total">
                    <?php
                    // Menampilkan ongkos kirim hanya sekali
                    if ($uniqueShippingCost === null) {
                        ?>
                        <p>Ongkos Kirim: <?= $product['ongkir']; ?></p>
                        <?php
                        $uniqueShippingCost = $product['ongkir'];
                    }
                    // Menampilkan total pembayaran hanya sekali
                    if ($uniqueTotalPayment === null):
                        if ($product['total_pem'] !== null):
                            ?>
                            <p>Total Pembayaran : Rp. <?= number_format($product['total_pem'], 0, ',', '.'); ?></p>
                            <?php
                        else:
                            ?>
                            <p>Total Pembayaran : Tidak ada data total.</p>
                            <?php
                        endif;
                        // Menampilkan tautan ke halaman detail pesanan hanya sekali
                        ?>
                        <a href="<?= base_url('user/detail_pesanan/' . $product['id_pesanan']); ?>" class="detail-button">Detail Pesanan</a>
                        <?php
                        // Tampilkan tombol Selesaikan Pesanan jika status order adalah Barang Dikirim
                        if ($group[0]['status_order'] == 'Barang Dikirim'):
                            ?>
                            <a href="<?= base_url('user/pesanan_selesai/'.$product['id_pesanan']); ?>" class="complete-button">Selesaikan Pesanan</a>
                        <?php endif; ?>
                        <?php
                        $uniqueTotalPayment = $product['total_pem'];
                    endif;
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Akhir ringkasan pesanan -->
    </div>

<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   $(document).ready(function() {
    $(".star-rating input").change(function() {
      var selectedRating = $(this).val();

      // Mendapatkan indeks produk dari ID grup rating
      var productId = $(this).closest('.star-rating').attr('id').replace('productRating', '');
      
      // Menonaktifkan input yang tidak terpilih di produk yang bersangkutan
      $(`.star-rating#productRating${productId} input`).prop("disabled", true);

      // Mengaktifkan input hingga yang dipilih
      for (var i = 1; i <= selectedRating; i++) {
        $(`#star${productId}_${i}`).prop("disabled", false);
      }
    });
  });
</script>

</div>
