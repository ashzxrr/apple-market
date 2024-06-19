
<?php
// Mengambil data pengguna dari sesi
$user_data = $this->session->userdata('user_data');
// Mengambil data pesanan dari sesi
$user_orders = $this->session->userdata('user_orders');
?>

<style>
    .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            width: 500px;
            margin: 20px;
            display: inline-block;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-container {
            padding: 2px 16px;
        }
</style>
<div class="card">
    <img src="gambar_profil.jpg" alt="Profil Admin">
    <div class="card-container">
        <h2>Nama <?php echo $user_data->nama_lengkap; ?> </h2>
        <p>Jabatan: <?= $user_data->level; ?></p>
        <p>ID Admin: <?= $user_data->id_admin; ?></p>
    </div>
</div>




