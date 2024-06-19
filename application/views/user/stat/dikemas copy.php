
<h2>Daftar Barang Sedang Dikemas</h2>
<?php foreach ($user_orders_details as $item): ?>
        <?php if ($item['status_order'] == 'Barang Sedang Dikemas'): ?>
<p>Id Pesanan : <?= $item['id_orders']; ?></p>
<p>Nama Pembeli: <?= $item['nama_pembeli']; ?></p>
<p>Status Order : <?= $item['status_order']; ?></p>
<p>Tanggal Order : <?= $item['tgl_order']; ?></p>

<h3>Detail Produk</h3>
<table>
    <tr>
        <th>Foto</th>
        <th>Nama Produk</th>
        <th>Jumlah</th>

    </tr>
    <tr>
        <td> 
        <img src="<?= base_url('upload/produk/' . $item['foto']); ?>" alt="Foto Produk" style="max-width: 100px; max-height: 100px;">
        </td>
        <td><?= $item['nama_produk'];  ?></td>
        <td><?= $item['jumlah'];  ?></td>
        
    </tr>
</table>
<p>Ongkos Kirim : <?= $item['ongkos_kirim'];  ?></p>
<p>Total Pembayaran : <?= $item['total']; ?></p>
<?php endif; ?>
<?php endforeach; ?>