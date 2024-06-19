<?php $this->load->view('header'); ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;
    } 

    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    input,
    textarea {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Card preview styles */
    .card {
        display: flex;
        justify-content: space-between;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin-top: 20px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        background-color: #f8f8f8;
    }

    .card img {
        max-width: 45%;
        height: auto;
        border-radius: 4px;
        margin-right: 10px;
    }

    .card-content {
        width: 50%;
    }

    .card h4 {
        color: #333;
        margin-top: 0;
    }

    .card p {
        color: #666;
        margin: 8px 0;
    }
</style>

<!-- Form untuk mengedit produk -->
<h2>Edit Produk</h2>
<form action="<?= base_url('admin-update_product'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">

    <label for="nama_produk">Nama Produk:</label>
    <input type="text" name="nama_produk" value="<?= $produk->nama_produk; ?>" required>

    <label for="harga">Harga:</label>
    <input type="number" name="harga" value="<?= $produk->harga; ?>" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" required><?= $produk->deskripsi; ?></textarea>

    <label for="stok">Stok:</label>
    <input type="number" name="stok" value="<?= $produk->stok; ?>" required>

    <label for="kategori">Kategori:</label>
    <input type="text" name="kategori" value="<?= $produk->kategori; ?>" required>

    <label for="foto">Foto:</label>
    <input type="file" name="foto">

    <button type="submit">Update Produk</button>
</form>

<!-- Card Preview Before Edit -->
<div class="card" id="previewBefore">
    <img src="<?= base_url('upload/produk/'. $produk->foto); ?>" alt="Product Image Before Edit">
    <div class="card-content">
        <h4><?= $produk->nama_produk; ?></h4>
        <p>Harga: <?= $produk->harga; ?></p>
        <p>Deskripsi: <?= $produk->deskripsi; ?></p>
        <p>Stok: <?= $produk->stok; ?></p>
        <p>Kategori: <?= $produk->kategori; ?></p>
    </div>
</div>

<!-- Card Preview After Edit -->
<div class="card hidden" id="previewAfter">
    <img src="<?= base_url('path/to/your/image.jpg'); ?>" alt="Product Image After Edit">
    <div class="card-content">
        <h4>Preview Product Name</h4>
        <p>Harga: Rp.xx.xx</p>
        <p>Deskripsi:</p>
        <p>Stok: </p>
        <p>Kategori: </p>
    </div>
</div>

<script>
    function updatePreviewBefore() {
    // Get values from the form before editing
    var namaProduk = "<?= $produk->nama_produk; ?>";
    var harga = "<?= $produk->harga; ?>";
    var deskripsi = "<?= $produk->deskripsi; ?>";
    var stok = "<?= $produk->stok; ?>";
    var kategori = "<?= $produk->kategori; ?>";

    // Set the image path for before-edit preview
    var imagePathBefore = "<?= base_url('path/to/your/image_before_edit.jpg'); ?>";

    // Update the card preview before editing
    document.getElementById('previewBefore').innerHTML = `
        <img src="${imagePathBefore}" alt="Product Image Before Edit">
        <div class="card-content">
            <h4>${namaProduk}</h4>
            <p>Harga: ${harga}</p>
            <p>Deskripsi: ${deskripsi}</p>
            <p>Stok: ${stok}</p>
            <p>Kategori: ${kategori}</p>
        </div>
    `;

    // Show the before-edit card and hide the after-edit card
    document.getElementById('previewBefore').classList.remove('hidden');
    document.getElementById('previewAfter').classList.add('hidden');
}

function updatePreviewAfter() {
        // Get values from the form after editing
        var namaProduk = document.getElementById('nama_produk').value;
        var harga = document.getElementById('harga').value;
        var deskripsi = document.getElementById('deskripsi').value;
        var stok = document.getElementById('stok').value;
        var kategori = document.getElementById('kategori').value;

        // Set the image path for after-edit preview
        var imagePathAfter = "<?= base_url('path/to/your/image_after_edit.jpg'); ?>";

        // Update the card preview after editing
        document.getElementById('previewAfter').innerHTML = `
            <img src="${imagePathAfter}" alt="Product Image After Edit">
            <div class="card-content">
                <h4>${namaProduk}</h4>
                <p>Harga: Rp.${harga}</p>
                <p>Deskripsi:</p>
                <p id="deskripsiAfter"></p>
                <p>Stok: ${stok}</p>
                <p>Kategori: ${kategori}</p>
            </div>
        `;

        // Set the innerText for the description in the after-edit preview
        document.getElementById('deskripsiAfter').innerText = deskripsi;

        // Show the after-edit card and hide the before-edit card
        document.getElementById('previewAfter').classList.remove('hidden');
        document.getElementById('previewBefore').classList.add('hidden');
    }
</script>