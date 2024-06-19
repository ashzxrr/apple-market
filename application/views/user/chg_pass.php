<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        .card {
            width: 80%; /* Adjusted width for better responsiveness */
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        }

        form[data-type="chgpass"] {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h3 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 5px 0 2px;
            color: #555;
        }

        input[data-type="input1"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
        }

        input[type="submit"] {
            background-color: lavender;
            color: black;
            cursor: pointer;
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

            form[data-type="chgpass"] {
                max-width: 300px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="user-photo">
        <img src="<?= base_url('upload/'. $user['foto']); ?>" alt="User Photo">
    </div>

    <div class="user-info">
    <?php if($this->session->flashdata('success')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('success'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('error'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
<?php endif; ?>
<?php if($this->session->flashdata('warning')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('warning'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
<?php endif; ?>
        <table>
            <tbody>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td>:</td>
                    <td><?= $user['nama'] ?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>:</td>

                    <td><?= $user['email'] ?></td>
                </tr>
                <tr>
                    <td><strong>Username</strong></td>
                    <td>:</td>
                    <td><?= $user['username'] ?></td>
                </tr>
                <tr>
                <td><strong>Password</strong></td>
    <td>:</td>
    <td><?= str_repeat('*', strlen($user['password'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>:</td>
                    <td><?= $user['alamat'] ?></td>
                </tr>
                <tr>
                    <td><strong>Telepon</strong></td>
                    <td>:</td>
                    <td><?= $user['telepon'] ?></td>
                </tr>
            </tbody>
        </table>
        
    
    </div>

    <form data-type="chgpass" action="<?= base_url('user/chg_pass_act')?>" method="post">
        <h3>Ganti Password</h3>
        <label for="current_password">Password Lama:</label>
        <input id="input1" type="text" data-type="input1" name="current_password" required>

        <label for="new_password">Password Baru:</label>
        <input type="text" data-type="input1" name="new_password" required>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="text" data-type="input1" name="confirm_password" required>

        <input type="submit" value="Change Password">
    </form>
</div>

</body>
</html>
