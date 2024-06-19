
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://www.pngwing.com/id/free-png-neayz" type="image/png">
    <link rel="stylesheet" href="<?= base_url('node_modules/@fortawesome/fontawesome-free/css/all.min.css'); ?>">
    
    <title>Halaman Admin</title>
    
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>


<!-- Form untuk mengedit produk -->

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
$(document).ready(function () {
    // Function to update the preview card before editing
    function updatePreviewBefore() {
        var namaProduk = "<?= $produk->nama_produk; ?>";
    var harga = "<?= $produk->harga; ?>";
    var deskripsi = "<?= $produk->deskripsi; ?>";
    var stok = "<?= $produk->stok; ?>";
    var kategori = "<?= $produk->kategori; ?>";
    var imagePathBefore = "<?= base_url('upload/produk/'. $produk->foto); ?>";

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
        
    }

    // Function to update the preview card after editing
    function updatePreviewAfter() {
        var namaProduk = $('input[name="nama_produk"]').val();
        var harga = $('input[name="harga"]').val();
        var deskripsi = $('textarea[name="deskripsi"]').val();
        var stok = $('input[name="stok"]').val();
        var kategori = $('input[name="kategori"]').val();

        // Check if a file is selected
        var inputFoto = $('input[name="foto"]')[0].files[0];
        if (inputFoto) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagePathAfter = e.target.result;
                updateCardAfter(namaProduk, harga, deskripsi, stok, kategori, imagePathAfter);
            };
            reader.readAsDataURL(inputFoto);
        } else {
            // If no file is selected, use a default image path or leave it blank
            var imagePathAfter = ""; // You can set a default image path here
            updateCardAfter(namaProduk, harga, deskripsi, stok, kategori, imagePathAfter);
        }
    }

    function updateCardAfter(namaProduk, harga, deskripsi, stok, kategori, imagePathAfter) {
        // Update the card preview after editing
        $('#previewAfter').html(`
            <img src="${imagePathAfter}" alt="Product Image After Edit">
            <div class="card-content">
                <h4>${namaProduk}</h4>
                <p>Harga: Rp.${harga}</p>
                <p>Deskripsi:</p>
                <p id="deskripsiAfter">${deskripsi}</p>
                <p>Stok: ${stok}</p>
                <p>Kategori: ${kategori}</p>
            </div>
        `);

        // Show the after-edit card and hide the before-edit card
        $('#previewAfter').removeClass('hidden');
        $('#previewBefore').addClass('hidden');
    }

    // Attach event listeners to the form elements
    $('input[name="nama_produk"], input[name="harga"], textarea[name="deskripsi"], input[name="stok"], input[name="kategori"], input[name="foto"]').on('input', updatePreviewAfter);

    // Call the updatePreviewBefore function initially
    updatePreviewBefore();
});
</script>

</body>
</html>