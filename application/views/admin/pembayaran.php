<style>
    .container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: rgb(71, 70, 70);
        color: #E6E6FA;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e5e5e5;
    }

    /* Mengubah warna latar belakang untuk status 'Menunggu Konfirmasi' menjadi merah */
    tr[data-status="Menunggu Konfirmasi"] {
        background-color: red;
    }

    /* Mengubah warna latar belakang untuk status 'Terkonfirmasi' menjadi hijau */
    tr[data-status="Terkonfirmasi"] {
        background-color: green;
    }

</style>

<!-- Konten halaman produk admin -->
<?php if ($this->session->flashdata('success')): ?>
    <div style="color: green;">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<a href="<?= base_url('admin/cetak_laporan'); ?>" target="_blank">Cetak Laporan</a>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pesanan</th>
                <th>ID Pelanggan</th>
                <th>Nama Pembeli</th>
                <th>Status</th>
                <th>Tanggal Bayar</th>
                <th>Total</th>
                <th>Bukti Pembayaran</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $displayedOrders = []; // Array untuk menyimpan id_pesanan yang sudah ditampilkan
            foreach ($orders as $key => $row) {
                // Memeriksa apakah id_pesanan sudah ditampilkan atau belum
                if (!in_array($row->id_pesanan, $displayedOrders)) {
                    ?>
                <tr data-status="<?= $row->status; ?>">
                    <td><?= $key + 1; ?></td>
                    <td><?= $row->id_pesanan; ?></td>
                    <td><?= $row->id_pelanggan; ?></td>
                    <td><?= $row->nama_pembeli; ?></td>
                    <td><?= $row->status; ?></td>
                    <td><?= $row->tgl_pesan; ?></td>
                    <td>Rp. <?= number_format($row->total_pem, 0, ',', '.'); ?></td>
                    <td>
                        <?php if ($row->foto_bukti) : ?>
                            <img src="<?= base_url('upload/buktitf/' . $row->foto_bukti); ?>" style="max-width: 100px; max-height: 100px;" alt="Bukti Pembayaran">
                        <?php else : ?>
                            Tidak ada bukti
                        <?php endif; ?>
                    </td> 
                    <td>
                        <?php if ($row->status == 'Menunggu Konfirmasi'): ?>
                             <a class="edit" href="<?php echo base_url('admin-kemas_pro/'.$row->id_pesanan  );?>">Konfirmasi</a>
                        <?php endif; ?>
                        <a class="detail" href="<?= base_url('admin/detail_order/' . $row->id_pesanan   ); ?>">Detail</a>
                    </td>
                    
                </tr>
                <?php
                    // Menambahkan id_pesanan ke dalam array displayedOrders
                    $displayedOrders[] = $row->id_pesanan;
                }
            }
            ?>
        </tbody>
    </table>
</div>
