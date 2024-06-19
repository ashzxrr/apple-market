<style>
    .status-container {
  display: flex;
  align-items: center;
}

.status {
  font-weight: bold;
  margin-right: 8px;
}

.status:not(:last-child):after {
  content: ">";
  margin-left: 8px;
  color: #333; /* Ganti dengan warna yang diinginkan */
}
</style>
<div class="status-container">
  <a href="user/stat/wait" class="status">Menunggu Pembayaran</a>
  <a href="" class="status">Dikemas</a>
  <a href="" class="status">Dikirim</a>  
  <a href="" class="status">Selesai</a>
</div>
<!-- Tampilkan daftar pesanan -->
<?php 
// Mengambil data pengguna dari sesi
$user_data = $this->session->userdata('user_data');
// Mengambil data pesanan dari sesi
$user_orders_det = $this->session->userdata('user_orders_det');
?>
<h2>Daftar Pesanan</h2>

<table>
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Nama Pembeli</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Nama Produk</th>
            <th>Status Order</th>
            <th>Jumlah</th>
            <th>Ongkos Kirim</th>
            <th>Total</th>
            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <th>Total</th>
    <tbody>
        <?php foreach ($user_orders_details as $order): ?>
            <tr>
                <td><?= $order['id_orders']; ?></td>
                <td><?= $order['tgl_order']; ?></td>
                <td><?= $order['nama_pembeli']; ?></td>
                <td><?= $order['alamat']; ?></td>
                <td><?= $order['telepon']; ?></td>
                <td><?= $order['nama_produk']; ?></td>
                <td><?= $order['status_order'];?></td>
                <td><?= $order['jumlah']; ?></td>
                <td><?= $order['ongkos_kirim']; ?></td>

                <td><?= $order['total']; ?></td>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php foreach ($user_orders_details as $item): ?>
<h2>Detail Order</h2>
<p>Id Pesanan : <?= $item['id_orders']; ?></p>
<p>Nama Pembeli: <?= $item['nama_pembeli']; ?></p>
<p>Status Order : <?= $item['status_order']; ?></p>
<p>Tanggal Order : <?= $item['tgl_order']; ?></p>


<h2>Detail Produk</h2>
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
<?php endforeach;?>