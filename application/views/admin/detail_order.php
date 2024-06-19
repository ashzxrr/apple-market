<div class="container">
    <div class="card order-details">
        <!-- Tampilkan detail order -->
        <h2>Detail Order</h2>
        <?php if (!empty($order)) : ?>
            <?php $row = $order[0]; ?>
            <p>ID Order: <?= $row->id_pesanan; ?></p>
            <p>ID Pelanggan: <?= $row->id_pelanggan; ?></p>

            <p>Nama Pembeli: <?= $row->nama_pembeli; ?></p>
            <p>Status Order: <?= $row->status_order; ?></p>
            <p>Tanggal Order: <?= $row->tgl_order; ?></p>
            <p>Total: Rp. <?= number_format($row->total, 0, ',', '.'); ?></p>
            <p>Ongkos Kirim: Rp. <?= number_format($row->ongkir, 0, ',', '.'); ?></p>
        <?php else : ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="card product-and-payment">
        <!-- Tampilkan detail produk yang di-order -->
        <div class="product-details">
            <h2>Detail Produk</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order as $detail) : ?>
                        <tr>
                            <td>
                               <strong> <?= $detail->nama_produk; ?></strong><br><br>
                                <img src="<?= base_url('upload/produk/' . $detail->foto); ?>" alt="<?= $detail->nama_produk; ?>" class="product-image">
                            </td>
                            <td><?= $detail->jumlah; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Tampilkan detail pembayaran -->
        <div class="payment-details">
            <h2>Detail Pembayaran</h2>
            <?php if (!empty($order)) : ?>
                <?php if ($row->foto_bukti) : ?>
                    <p>Total Pembayaran: Rp. <?= number_format($row->total + $row->ongkir, 0, ',', '.'); ?></p>
                    <p>Foto Bukti: <br><br><img src="<?= base_url('upload/buktitf/' . $row->foto_bukti); ?>" alt="Bukti Pembayaran" class="payment-image"></p>
                    <?php if ($row->status_order != 'Barang Sedang Dikemas' && $row->status_order != 'Barang Dikirim') : ?>
                        <form action="<?= base_url('admin/konfirmasi_pembayaran/' . $row->id_pesanan); ?>" method="post">
                        <input type="hidden" name="id_pelanggan" value="<?= $row->id_pelanggan; ?>" >    
                        <button type="submit">Konfirmasi Pembayaran</button>
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <p>Foto Bukti belum diupload</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
   .container {
    display: flex;
    justify-content: space-between;
    margin: 20px;
}

.card {
    border: 2px solid #FF0000;
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    box-shadow: 0 6px 12px rgba(52, 152, 219, 0.2);
    background-color: #fff;
}

.order-details {
    width: 40%;
}

.product-and-payment {
    flex: 1;
    display: flex;
    justify-content: space-between;
}

.product-details,
.payment-details {
    width: 48%;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.product-table, th, td {
    border: 1px solid #FF0000;
}

th, td {
    padding: 15px;
    text-align: left;
}

th {
    background-color:#FF4500;
    color: #fff;
}

.product-image,
.payment-image {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

button {
    background-color: #2ecc71;
    color: white;
    padding: 12px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #27ae60;
}



</style>