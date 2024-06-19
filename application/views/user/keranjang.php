<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
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
    margin-top: 70px;
}

@keyframes shine {
    0% {
        background-position-x: -500%;
    }
    100% {
        background-position-x: 500%;
    }
}

.button {
    display: block;
    width: 10%;
    padding: 15px;
    background-color: #008080;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border: none;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
   
}



.table-container {
    margin-top: 20px;
    overflow: auto; 
}

.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
}


@media (max-width: 600px) {
    .cart-container {
        border-radius: 0;
        box-shadow: none;
        margin-top: 80px;
        z-index: 1;
    }

    .cart-header, .table th, .table td {
        padding: 20px;
    }

    .cart-header h2 {
        font-size: 18px;
    }

    .table th, .table td {
        font-size: 14px;
    }

    .delete-button, .button {
        font-size: 14px;
    }

    .button {
        width: 50%; /* Make the button full width */
        padding: 20px; /* Increase the padding for a larger size */
    }
}



</style>
<!-- Tampilkan daftar produk dalam keranjang -->

<header>
    <h1 class="shining-text">keranjang belanja</h1>
</header>
    <form action="<?= base_url('user/checkout_selected_items'); ?>" method="post" id="checkout-form">
        <table class="table">
            <thead>
                <tr>
                    <th>pilih produk</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Warna</th>
                    <th>Jumlah</th>
                    <th>hapus produk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $item): ?>
                    <tr>
                        <!-- Tampilkan detail produk -->
                        <td style="text-align: center;">
                            <label class="container-check">
                                <input type="checkbox" name="selected_products[]" value="<?= $item->id_produk; ?>">
                                <span class="mark"></span>
                            </label>
                        </td>
                        <td>
                            <strong><?= $item->nama_produk; ?></strong> </br>
                            <img src="<?= base_url('upload/produk/' . $item->foto); ?>" alt="<?= $item->nama_produk; ?>" style="max-width: 50px; text-align:center;">
                        </td>
                        <td>Rp. <?= number_format($item->harga, 0, ',', '.'); ?></td>
                        <td><?= $item->warna; ?></td>
                        <td><?= $item->jumlah; ?></td>
                        <!-- Tampilkan tombol checkout atau hapus -->
                        <td>
                            <a class="delete-button" href="<?= base_url('user/hapus_item/' . $item->id_produk); ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="button" type="submit"><i class="fas fa-shopping-cart"></i> Checkout</button>
    </form>
</div>

