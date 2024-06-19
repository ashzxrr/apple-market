<!-- File: views/rajaongkir_view.php -->

<?php $this->load->view('header_user'); ?>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<form action="<?= base_url('user/complete_order'); ?>" method="post" id="checkout-form">
    <!-- Tambahkan formulir checkout di sini sesuai kebutuhan -->
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

    <label>Kecamatan: 
        <select name="kecamatan" id="kecamatan">
            <option value="">Pilih Kecamatan</option>
            <!-- Options akan diisi secara dinamis melalui AJAX -->
        </select>
    </label><br>

    <label>Desa/Kelurahan: 
        <select name="desa" id="desa">
            <option value="">Pilih Desa/Kelurahan</option>
            <!-- Options akan diisi secara dinamis melalui AJAX -->
        </select>
    </label><br>

    <!-- Tampilkan informasi produk yang ingin di-checkout -->
    <h2>Produk yang Akan Di-Checkout</h2>
    <!-- ... (table produk) -->

    <button type="submit">Checkout</button>
</form>

<script>
    $(document).ready(function(){
        $.ajax({
        url: "<?= base_url('user/get_provinces'); ?>",
        type: "GET",
        success: function(data){
            $("#provinsi").html(data);
        }
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
                    $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                    $('#desa').html('<option value="">Pilih Desa/Kelurahan</option>');
                }
            });
        });

        // Event listener untuk dropdown kota/kabupaten
        $('#kota').change(function(){
            var kota_id = $(this).val();

            // AJAX request untuk mengisi dropdown kecamatan
            $.ajax({
                url: '<?= base_url("user/get_districts") ?>',
                type: 'post',
                data: { city_id: kota_id },
                success: function(response){
                    $('#kecamatan').html(response);
                    $('#desa').html('<option value="">Pilih Desa/Kelurahan</option>');
                }
            });
        });

        // Event listener untuk dropdown kecamatan
        $('#kecamatan').change(function(){
            var kecamatan_id = $(this).val();

            // AJAX request untuk mengisi dropdown desa/kelurahan
            $.ajax({
                url: '<?= base_url("user/get_villages") ?>',
                type: 'post',
                data: { district_id: kecamatan_id },
                success: function(response){
                    $('#desa').html(response);
                }
            });
        });
    });
</script>
