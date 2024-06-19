<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f5f5f5;
        }

        .card {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .user-info {
            flex: 1;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .user-info table {
            width: 100%;
        }

        .user-info th, .user-info td {
            padding: 10px;
            text-align: left;
            border: none;
            background-color: transparent;
        }

        .user-info th {
            font-weight: bold;
        }

        .user-photo {
            margin-top: 20px;
            overflow: hidden;
            border-radius: 50%;
            width: 200px;
            height: 200px;
        }

        .user-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        form[data-type="chgpp"] {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin: 5px 0 2px;
            color: #555;
        }

        input[type='file'] {
            width: 100%;
            margin-left: auto;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
        }

        #preview-photo {
            width: 100%;
            margin-top: 20px;
            border-radius: 50%;
            overflow: hidden;
            height: 200px;
        }

        #preview-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        input[type="submit"] {
            background-color: lavender;
            color: black;
            cursor: pointer;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: darkgray;
        }

        @media screen and (min-width: 768px) {
            .card {
                width: 60%;
                flex-direction: row;
                align-items: flex-start;
            }

            .user-info {
                width: 70%;
                padding-right: 20px;
            }

            .user-photo {
                margin-top: 0;
                margin-left: auto;
            }

            form[data-type="chgpp"] {
                max-width: 300px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h4>foto profil lama</h4><br>
    <div class="user-photo">
        <img src="<?= base_url('upload/'. $user['foto']); ?>" alt="User Photo">
    </div>

    <form data-type="chgpp" action="<?= base_url('user/upload_photo');?>" method="post" enctype="multipart/form-data">
        <h2>Ganti Foto</h2>
        <label for="photo">Pilih Foto Baru:</label>
        <input type="file" name="photo" accept="image/*" required>
        


        <h5>foto profil baru</h5>
        <div id="preview-photo"></div>
       

        <input type="submit" value="Upload Foto">
    </form>
</div>

<script>
    document.querySelector('input[type="file"]').addEventListener('change', function() {
        const preview = document.getElementById('preview-photo');
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '50%';
                preview.innerHTML = '';
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>

