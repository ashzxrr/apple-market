<!-- application/views/user/checkout_item.php -->
<div>
    <h2>Ringkasan Pesanan</h2>
    <!-- Tampilkan ringkasan pesanan untuk item yang dipilih -->
    <div class="produk-item">
        <h3><?= $item->nama_produk; ?></h3>
        
        <p>Harga: Rp. <?= number_format($item->harga, 0, ',', '.'); ?></p>
        <p>Jumlah: <?= $item->jumlah; ?></p>
    </div>
    <!-- Tampilkan total pembayaran dengan format mata uang Rupiah -->
    <p>Total Pembayaran: Rp. <?= number_format($item->harga * $item->jumlah, 0, ',', '.'); ?></p>
    <!-- Tambahkan formulir checkout dan tombol pembayaran -->
    <form action="<?= base_url('user/proses_checkout_item/' . $item->id_produk) ?>" method="post">
        <!-- Informasi pembayaran -->
        <label for="nama_pembeli">Nama Pembeli:</label>
        <input type="text" name="nama_pembeli" required>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea>

        <label for="telepon">Telepon:</label>
        <input type="text" name="telepon" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <!-- Pilih Kota -->
        <label for="id_kota">Kota:</label>
        <select name="id_kota" required>
            <!-- Isi opsi kota dari data tb_kota -->
            <?php foreach ($kota_list as $kota) : ?>
                <option value="<?= $kota->id_kota; ?>"><?= $kota->nama_kota; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="kode_pos">Kode Pos:</label>
        <input type="text" name="kode_pos" required>

        <!-- Tombol untuk checkout -->
        <button type="submit">Melakukan Pembayaran</button>
    </form>
</div>
