
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #checkout-form {
        max-width: 600px;
        margin: 0 auto;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #FFE4E1;
        border-radius: 10px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #FFE4B5;
        color: #0000;
    }

    img {
        max-width: 50px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    select {
        background-color: #fff;
        color: #555;
    }

    button[name = "cc"] {
        background-color: #008080;
        color: #fff;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        display: inline-block;
        transition: background-color 0.3s;
        font-size: 14px;
    }

    button[name = "cc"]:hover {
        background-color: #006666;
    }

    #result_ongkir {
        margin-top: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .checkout-icon {
        margin-right: 8px;
    }

    @media (max-width: 600px) {
        input[type="text"],
        select,
        button {
            width: calc(100% - 20px);
            margin-right: 10px;
            margin-left: 10px;
        }
    }
</style>

</head>
<body>
    <div class="container">
    <form action="<?= base_url('user/complete_order'); ?>" method="post" id="checkout-form">

        <h2>Produk yang Akan Di-Checkout</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Warna</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selected_products as $item): ?>
                    <tr>
                        <td>
                            <strong><?= $item['nama_produk'] ; ?></strong>
                        </td>
                        <td>Rp. <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><img src="<?= base_url('upload/produk/' . $item['foto']); ?>" alt="<?= $item['nama_produk']; ?>" style="max-width: 50px;"></td>
                        <td><?= $item['warna']; ?></td>
                        
                        <td><?= $item['jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

            <!-- Tambahkan formulir checkout di sini sesuai kebutuhan -->
    <label>Nama Pembeli: <input type="text" name="nama_pembeli"></label><br>
    <label>Provinsi: 
        <select name="provinsi" id="provinsi">
            <option value="">Pilih Provinsi</option>
            <!-- Options akan diisi secara dinamis melalui AJAX -->
        </select>
    </label><br>

    <label>Kota/Kabupaten: 
        <select name="kota" id="kota">
            <option value="">Pilih Kota/Kabupaten</option>
            <!-- Options akan diisi secara dinamis melalui AJAX -->
        </select>
    </label><br>
<!-- Tambahkan input tersembunyi untuk city_id -->
<input type="hidden" name="city_id" id="city_id">

    <label>Alamat: <input type="text" name="alamat"></label><br>
    <label>Telepon: <input type="text" name="telepon"></label><br>
    <label>Email: <input type="text" name="email"></label><br>
   
    <label>Kode Pos: <input type="text" name="kode_pos"></label><br>

    <!-- Dropdown untuk memilih ekspedisi -->
    <label>Ekspedisi: 
        <select name="ekspedisi" id="ekspedisi">
            <option>Pilih Ekspedisi</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <!-- Tambahkan opsi untuk ekspedisi lain jika diperlukan -->
        </select>
    </label><br>

    <!-- Output hasil cek ongkir -->
    <div id="result_ongkir"></div>

    <!-- Form untuk menyimpan hasil cek ongkir -->
    <input type="hidden" name="ongkir" id="ongkir">
<button name="cc" type="submit">
    <span class="checkout-icon">&#8594;</span> Checkout
</button>



</form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
 $(document).ready(function(){
        $.ajax({
            url: "<?= base_url('user/get_provinces'); ?>",
            type: "GET",
            success: function(data){
                $("#provinsi").html(data);
            }
        });
// Event listener untuk dropdown kota/kabupaten
$('#kota').change(function(){
    var kota_id = $(this).val();

    // Atur nilai city_id ke input tersembunyi
    $('#city_id').val(kota_id);

    // Reset nilai ongkir dan berat kiriman ketika pilihan kota/kabupaten berubah
    $('#ongkir').val('');
    $('#berat_kiriman').val('');
});

        // Event listener untuk dropdown provinsi
        $('#provinsi').change(function(){
            var provinsi_id = $(this).val();

            // AJAX request untuk mengisi dropdown kota/kabupaten
            $.ajax({
                url: '<?= base_url("user/get_cities") ?>',
                type: 'post',
                data: { province_id: provinsi_id },
                success: function(response){
                    $('#kota').html(response);
                }
            });
        });

        // Event listener untuk dropdown kota/kabupaten
       

        // Event listener untuk dropdown ekspedisi
        $('#ekspedisi').change(function(){
            var kota_id = $('#kota').val();
            var berat_kiriman = 1000;
            var ekspedisi = $(this).val();

            // AJAX request untuk cek ongkir
            $.ajax({
                url: '<?= base_url("user/cek_ongkir") ?>',
                type: 'post',
                data: { city_id: kota_id, weight: berat_kiriman, courier: ekspedisi },
                success: function(response){
                    // Tampilkan hasil cek ongkir
                    $('#result_ongkir').html(response);

                    // Ambil dan simpan ongkir ke dalam input tersembunyi
                    var ongkir = $('#result_ongkir').find('input[name="ongkir"]').val();
                    $('#ongkir').val(ongkir);
                }
            });
        });
        
        // Trigger event untuk dropdown ekspedisi (menggunakan 'change' secara otomatis)
        $('#ekspedisi').trigger('change');
    });
    </script>
</body>
</html>
