<?php $this->load->view('user/side_bar');?>

<div class="content" >
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
                <br>
                <br>
                <h3>Informasi Pengiriman</h3>
                <p>Ekspedisi : <?= $row->ekspedisi; ?></p>
                <p>Layanan : <?= $row->layanan;  ?></p>
    <!-- Tampilkan nomor resi dengan ID unik -->
    <p>Nomor Resi: <span id="resi"><?= $row->resi; ?></span>
        <!-- Tombol Salin Resi -->
        <button onclick="copyResi()" class="copy-button"><i class="far fa-copy"></i></button>
    </p>
    <p>Status pengiriman bisa di cek di ekspedisi terkait</p>

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
                            <th>Warna</th>
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
                                <td><?= $detail->warna; ?></td>
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
                    <?php else : ?>
                        <p>Foto Bukti belum diupload</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        
    }

    .card {
        box-sizing: border-box;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-details {
        width: 100%;
    }

    .product-and-payment {
        flex: 1;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .product-details,
    .payment-details {
        width: 100%;
        box-sizing: border-box;
        
    }

    .payment-details {
        margin-right: 1%;
    }

    .product-table {
        width: 90%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .product-table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
        color: black;
    }

    .product-image {
        max-width: 70px;
        max-height: 70px;
    }

    .payment-image {
        max-width: 100%;
        height: auto;
        max-height: 150px; /* Adjust as needed */
    }

    @media screen and (min-width: 768px) {
        .product-details,
        .payment-details {
            width: 48%;
        }
    }
</style>



<script>
function copyResi() {
    // Pilih teks yang akan disalin
    var resiText = document.getElementById("resi");

    // Buat elemen textarea sementara
    var tempTextArea = document.createElement("textarea");
    tempTextArea.value = resiText.textContent;

    // Sisipkan elemen textarea ke dalam dokumen
    document.body.appendChild(tempTextArea);

    // Pilih dan salin teks
    tempTextArea.select();
    document.execCommand("copy");

    // Hapus elemen textarea sementara
    document.body.removeChild(tempTextArea);

    // Tampilkan pemberitahuan atau perubahan tampilan yang sesuai
    alert("Nomor Resi telah disalin: " + resiText.textContent);
}
</script>
