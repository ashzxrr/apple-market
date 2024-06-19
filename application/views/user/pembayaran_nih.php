<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.order-details {
    margin-bottom: 20px;
}

h2, h3 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: #FFE4E1;
}

th, td {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: left;
   
}

th{
    background-color: #FFE4B5;
    color: #000;
}

.payment-form {
    margin-bottom: 20px;
}

.payment-logo {
    max-width: 100px;
    height: auto;
    margin-right: 10px;
}

.payment-instructions {
    display: none;
}

label {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

input[type="file"] {
    margin-bottom: 10px;
}

button {
    background-color: #008080; /* Modern teal color */
    color: #fff;
    padding: 12px 24px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #006666; /* Darker teal on hover */
}



@media screen and (max-width: 600px) {
    table {
        display: block;
        overflow-x: auto;
    }

    th, td {
        white-space: nowrap;
    }

    .payment-instructions img {
        max-width: 100%;
        height: auto;
    }

    .payment-instructions ol {
        padding-left: 20px;
    }

}




    
</style>

<div class="container">
    <div class="order-details">
        <!-- Tampilkan detail pesanan -->
        <h2>Detail Pesanan</h2>
        <p>Nama Pembeli: <?= $order->nama_pembeli; ?></p>
        <p>Alamat Pengiriman: <?= $order->alamat; ?></p>
        <p>No Telepon: <?= $order->telepon; ?></p>
        <p>Ekspedisi: <?= $pengiriman->ekspedisi; ?></p>
        <p>Layanan: <?= $pengiriman->layanan; ?></p>
        <p>Estimasi: <?= $pengiriman->estimasi; ?> Hari</p>
       
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga/pcs</th>
                    <th>Jumlah</th>
                    <th>Warna</th>
                    <th>foto Produk</th>
                </tr>
            </thead>

            <?php foreach ($order_details as $detail): ?>
                <tbody>
                    <tr>
                        <td><?= $detail->nama_produk; ?></td>
                        <td><?= $detail->harga; ?></td>
                        <td><?= $detail->jumlah ?></td>
                        <td><?= $detail->warna ?></td>
                        <td><img src="<?= base_url('upload/produk/' . $detail->foto); ?>"
                                alt="Foto Produk"
                                style="max-width: 100px; max-height: 100px;"></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
        <!-- Tampilkan total pembayaran beserta ongkir -->
        <h2>Total Pembayaran</h2>
        <p>Total Pesanan: Rp. <?= number_format($order->total, 0, ',', '.'); ?></p>
        <p>Ongkir: Rp. <?= number_format($pengiriman->ongkir, 0, ',', '.'); ?></p>
        <p>Total Pembayaran (Termasuk Ongkir): Rp. <?= number_format($order->total + $pengiriman->ongkir, 0, ',', '.'); ?></p>
    </div>

    <div class="payment-form">
        <h2>Metode Pembayaran</h2>
        <form action="<?= base_url('user/process_payment_nih/' . $order->id_pesanan); ?>" method="post"
            enctype="multipart/form-data">
        <div>
            <label>
                <input type="radio" name="metode" value="bca">
                <img src="https://th.bing.com/th?id=OIP.1uriXJcIOZk4Zn_qYp2gzAHaCW&w=350&h=111&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="bca" class="payment-logo">
            </label>
            <label>
                <input type="radio" name="metode" value="BRI">
                <img src="https://th.bing.com/th/id/OIP.VRlkaEOeQzAAaErr_KFZtQHaEK?pid=ImgDet&w=207&h=116&c=7" alt="BRI" class="payment-logo">
            </label>
            <label>
                <input type="radio" name="metode" value="GOPAY">
                <img src="https://th.bing.com/th?id=OIP.9p-C_cAxCT8w2ApMgzs4sgHaCx&w=349&h=131&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="GOPAY" class="payment-logo">
            </label>
            <label>
                <input type="radio" name="metode" value="DANA">
                <img src="https://th.bing.com/th?id=OIP.9FxGi-l8ku1m1o7aOV8aTAHaCK&w=350&h=102&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="DANA" class="payment-logo">
            </label>
            <label>
                <input type="radio" name="metode" value="shoppe">
                <img src="https://th.bing.com/th?id=OIP.P-bDzBd54iQzV2SQF3Mf-gHaD4&w=345&h=181&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="shoppe" class="payment-logo">
            </label>
        </div>
    </div>
    <div class="payment-instructions" id="bca-instructions">
    <p>Langkah-langkah pembayaran menggunakan BCA:</p>
   
    <ol>
        <li>Buka aplikasi BCA mobile</li>
        <li>Pilih ‘m-Transfer’</li>
        <li>Pilih ‘Transfer Antar Bank’</li>
        <li>Masukkan informasi rekening tujuan, nominal transfer, layanan transfer, dan berita</li>
        <li>Pastikan kembali informasi transfer sudah benar</li>
        <li>Konfirmasi dengan memasukkan PIN</li>
        <li>jangan lupa upload bukti pembayaran </li>
    </ol>

    <img src="<?= base_url('upload/qr/qr.jpg')?>"  style="max-width: 300px; max-height: 300px;" alt="QRIS BCA">
    <ol>
        <li>atau scan qris ini </li>
        <li>masukan total harga belanja anda</li>
     </ol>
    
     <button type="button" class="closeBtn">OK</button>

</div>

<div class="payment-instructions" id="bri-instructions">
    <p>Langkah-langkah pembayaran menggunakan BRI:</p>
   
    <ol>
        <li>Buka aplikasi BRImo di smartphone Anda.</li>
        <li>Login dengan memasukkan Username dan Password atau dengan fingerprint.</li>
        <li>Pilih menu "Transfer".</li>
        <li>Klik "Tambah Penerima".</li>
        <li>Pilih "Bank BRI".</li>
        <li>Masukkan nomor rekening BRI.</li>
        <li>Pilih "Lanjutkan".</li>
        <li>Masukkan nominal transfer BRI.</li>
        <li>Pilih "Transfer".</li>
        <li>Periksa kembali transaksi transfer BRI Anda dari nama penerima dan jumlah uang yang dikirim.</li>
        <li>Jika sudah benar, pilih "Transfer".</li>
        <li>Terakhir, masukkan PIN BRImo.</li>
        <li>jangan lupa upload bukti pembayaran</li>
    </ol>

    <img src="<?= base_url('upload/qr/qr.jpg')?>"  style="max-width: 300px; max-height: 300px;" alt="QRIS BRI">
    <ol>
      <li>atau scan qris ini </li>
        <li>masukan total harga belanja anda</li>
     </ol>

     <button type="button" class="closeBtn">OK</button>
    
    
</div>

<div class="payment-instructions" id="gopay-instructions">
<img src="qris.jpg" alt="QRIS GOPAY">
    <p>Langkah-langkah pembayaran menggunakan GOPAY:</p>

    <ol>
        <li>Buka aplikasi Gojek dan klik "Scan".</li>
        <li>Lakukan scan QRIS pada kode QRIS yang ada di dekat kasir atau di struk QRIS yang diberikan oleh petugas kasir.</li>
        <li>Pastikan jumlah pembayaran sudah sesuai.</li>
        <li>Pilih "Bayar" untuk menyelesaikan pembayaran.</li>
        <li>jangan lupa upload bukti Pembayaran</li>
    </ol>

    <button type="button" class="closeBtn">OK</button>
    
</div>

<div class="payment-instructions" id="dana-instructions">
<img src="<?= base_url('upload/qr/qr.jpg')?>"  style="max-width: 300px; max-height: 300px;g" alt="QRIS DANA">
    <p>Langkah-langkah pembayaran menggunakan DANA:</p>

    <ol>
        <li>Buka aplikasi DANA dan pilih menu "Bayar" atau "Pay" di halaman pertama yang tampil pada smartphone.</li>
        <li>Setelah itu akan muncul menu QRIS, lalu arahkan kamera ke kode QRIS yang ada di meja kasir merchant.</li>
        <li>Secara otomatis layar smartphone akan memunculkan nama dan ID Toko yang terdeteksi ketika dipindai tadi.</li>
        <li>Masukkan nominal pembayaran yang disampaikan oleh kasir, pastikan nominalnya tepat agar tidak terjadi eror.</li>
        <li>Tekan "Pilih Metode Pembayaran," lalu pilih saldo DANA untuk transaksi yang lebih praktis.</li>
        <li>Terakhir, pilih "Bayar." Tidak lama akan muncul notifikasi bahwa pembayaran berhasil dilakukan. Untuk memastikannya, kita bisa menekan pilihan "Lihat Transaksi."</li>
        <li>jangan lupa upload bukti pembayaran</li>
    </ol>

    <button type="button" class="closeBtn">OK</button>
    

    
</div>

<div class="payment-instructions" id="shoppe-instructions">
<img src="<?= base_url('upload/qr/qr.jpg')?>"  style="max-width: 300px; max-height: 300px;" alt="QRIS Shoppe">
    <p>Langkah-langkah pembayaran menggunakan Shopee:</p>

    <ol>
        <li>Buka Shopee, Lalu Tap Icon “Scan” atau “Bayar”. Langkah pertama yang bisa kamu lakukan ketika Bayar QRIS Pakai ShopeePay adalah membuka halaman aplikasi Shopee.</li>
        <li>Scan QRIS Apa Saja yang Ada di Kasir Merchant Favoritmu. Metode pembayaran QRIS bisa digunakan untuk membeli produk apa pun, mulai dari makanan, minuman, pakaian, hingga kebutuhan rumah tangga.</li>
        <li>Pemberitahuan Pembayaran Telah Berhasil.</li>
        <li>jangan lupa upload bukti pembayaran</li>
    </ol>

    <button type="button" class="closeBtn">OK</button>
    
</div>




<label for="foto">Unggah bukti pembayaran:</label>
<input type="file" name="foto" id="foto" accept="image/*" required>
<div id="image-preview"></div>

<button type="submit">
    <span class="checkout-icon">&#8594;</span> lanjut ke pembayaran
</button>




<script>
        // Tampilkan instruksi pembayaran saat metode pembayaran dipilih
        document.querySelectorAll('input[name="metode"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.payment-instructions').forEach(function (instructions) {
                    instructions.style.display = 'none';
                });

                var selectedMethod = document.querySelector('input[name="metode"]:checked').value;
                document.getElementById(selectedMethod.toLowerCase() + '-instructions').style.display = 'block';
            });
        });

        // Display image preview
        document.getElementById('foto').addEventListener('change', function (event) {
            var preview = document.getElementById('image-preview');
            while (preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });

        // Close payment instructions when "OK" button is pressed
        document.querySelectorAll('.closeBtn').forEach(function (button) {
            button.addEventListener('click', function () {
                document.querySelectorAll('.payment-instructions').forEach(function (instructions) {
                    instructions.style.display = 'none';
                });
            });
        });
    </script>
</div>