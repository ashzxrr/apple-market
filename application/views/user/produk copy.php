<h2>Katalog Produk</h2>
<?php
    // Tampilkan pesan flashdata jika ada
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="flash-message">' . $message . '</div>';
    }
    ?>

<div>
    <?php foreach ($produk as $item) : ?>
        <div class="produk-item">
            <h3><?= $item->nama_produk; ?></h3>
            <p>Harga: <?= $item->harga; ?></p>
            <p>Stok: <?= $item->stok; ?></p>
            <p><?= $item->deskripsi; ?></p>
            <!-- Form untuk menambah ke keranjang -->
            <form action="<?= base_url('user/tambah_ke_keranjang/'.$item->id_produk) ?>" method="post">
                <label for="jumlah">Jumlah:</label>
                <input type="number" name="jumlah" value="1" min="1" max="<?= $item->stok; ?>">
                <button type="submit">Tambah ke Keranjang</button>
            </form>
             <!-- Tambahkan logika untuk menampilkan pesan bahwa produk sudah ada di keranjang -->
            <?php if ($user_data && $this->user_model->is_produk_in_keranjang($user_data->id_pelanggan, $item->id_produk)) : ?>
                <p>Produk sudah ada di keranjang.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
