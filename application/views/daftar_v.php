<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Pelanggan</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: grid;
        grid-gap: 15px;
    }

    label {
        font-weight: bold;
    }

    .input-group {
        display: flex;
        justify-content: space-between;
    }

    .input-group input {
        width: calc(50% - 5px);
        padding: 10px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    a {
        width: 100%;
        background-color: #ccc;
        color: #000;
        cursor: pointer;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    button {
        width: 100%;
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    /* Style untuk input foto */
    .foto-input-container {
        display: flex;
        align-items: center;
        margin-top: 5px;
    }

    .foto-input {
        flex: 1;
        margin-top: 0;
    }

    </style>
</head>

<body>
    <div class="container">
        <h2>Form Pendaftaran Pelanggan</h2>
        <form action="<?= base_url('daftarklik') ?>" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" required></textarea>
            </div>

            <div class="input-group">
                <label for="telepon">Telepon:</label>
                <input type="tel" name="telepon" required>
            </div>

            <!-- Baris baru untuk memisahkan input foto -->
            <div class="foto-input-container">
                <label for="foto">Foto:</label>
                <input class="foto-input" type="file" name="foto" accept="image/*" required>
            </div>

            <input type="hidden" name="level" value="user">

            <div class="input-group" >
            <a href="<?= base_url('login'); ?>">Kembali</a>
            <button type="submit">Daftar</button>
            </div>
        </form>
    </div>
</body>
</html>
