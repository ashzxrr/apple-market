<!-- Tampilkan detail pesanan -->
<h2>Detail Pesanan</h2>
<p>Nama Pembeli: <?= $order->nama_pembeli; ?></p>
<p>Alamat Pengiriman: <?= $order->alamat; ?></p>
<p>Kota: <?= $namakota->nama_kota; ?></p>
<p>No Telepon: <?= $order->telepon; ?></p>

<h3>Tabel Produk</h3>
<table>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Harga/pcs</th>
            <th>Jumlah</th>    
            <th>foto Produk</th>
        </tr>
    </thead>

    <?php foreach ($order_details as $detail ): ?>
    <tbody>
        <tr>
            <td><?= $detail->nama_produk; ?></td>
            <td><?= $detail->harga; ?></td>
            <td><?= $detail->jumlah ?></td>
            <td><img src="<?= base_url('upload/produk/' . $detail->foto); ?>" alt="Foto Produk" style="max-width: 100px; max-height: 100px;">
</td>
            
        </tr>
    </tbody>
    <?php endforeach;?>
</table>
<!-- Tampilkan total pembayaran beserta ongkir -->
<h2>Total Pembayaran</h2>
<p>Total Pesanan: Rp. <?= number_format($order->total, 0, ',', '.'); ?></p>
<p>Ongkir: Rp. <?= number_format($ongkir->ongkos_kirim, 0, ',', '.'); ?></p>
<p>Total Pembayaran (Termasuk Ongkir): Rp. <?= number_format($order->total + $ongkir->ongkos_kirim, 0, ',', '.'); ?></p>


<!-- Form pembayaran dengan input file -->
<h2>Metode Pembayaran</h2>
<form action="<?= base_url('user/process_payment/' . $order->id_orders); ?>" method="post" enctype="multipart/form-data">
    <label for="metode">Pilih Metode Pembayaran:</label>
    <select name="metode" id="metode">
        <option value="BRI">BRI</option>
        <option value="GOPAY">GOPAY</option>
        <option value="DANA">DANA</option>
    </select>

    <!-- Tambahkan input file untuk foto -->
    <label for="foto">Unggah Foto:</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Proses Pembayaran</button>
</form>

