<?php if ($this->session->flashdata('error')): ?>
    <div style="color: red;">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>



<style>
    /* Add your CSS styles for a more appealing layout */
    body {
    font-family: Arial, sans-serif;
}

.container {
        display: flex;
        justify-content: space-between; /* Change to 'space-around' or 'space-evenly' as per your preference */
    }


form {
    max-width: 400px;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

label {
    display: block;
    margin-bottom: 8px;
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

.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    width: 250px;
    margin: 15px;

    box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    background-color: #f8f8f8;
}

.card img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 10px;
}

.card h4 {
    color: #333;
    margin-top: 0;
}

.card p {
    color: #666;
    margin: 8px 0;
}

form,
    #previewCard {
        flex: 0 0 48%; /* Adjust the percentage as needed */
    }
</style>

<div class="container">
<form action="<?= base_url('admin-save_product') ?>" method="post" enctype="multipart/form-data" oninput="updatePreview()">
    <label for="nama_produk">Nama Produk:</label>
    <input type="text" name="nama_produk" id="nama_produk" required>

    <label for="harga">Harga:</label>
    <input type="text" name="harga" id="harga" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" required></textarea>

    <label for="stok">Stok:</label>
    <input type="number" name="stok" id="stok" required>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*" id="foto" required>

    <label for="kategori">Kategori:</label>
    <input type="text" name="kategori" id="kategori" required>

    <button type="submit">Tambah Produk</button>
</form>

<!-- Card Preview -->
<div class="card" id="previewCard">
    <h3>Preview</h3>
    <img src="placeholder.jpg" alt="Product Image">
    <h4>Product Name</h4>
    <p>harga: Rp.xx.xx</p>
    <p>Deskripsi:</p>
    <p>Stock: </p>
    <p>Kategori: </p>
    
</div>

<script>
    function updatePreview() {
        // Get values from the form
        var namaProduk = document.getElementById('nama_produk').value;
        var harga = document.getElementById('harga').value;
        var deskripsi = document.getElementById('deskripsi').value;
        var stok = document.getElementById('stok').value;
        var kategori = document.getElementById('kategori').value;

        // Get the selected file
        var fileInput = document.getElementById('foto');
        var file = fileInput.files[0];

        // Update the card preview
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('previewCard').innerHTML = `
                <h3>Preview</h3>
                <img src="${e.target.result}" alt="Product Image">
                <h4>${namaProduk}</h4>
                <p>Price: Rp.${harga}</p>
                <p>Deskripsi: ${deskripsi}</p>
                <p>Stock: ${stok}</p>
                <p>Kategori: ${kategori}</p>
                
            `;
        };
        reader.readAsDataURL(file);
    }
</script>