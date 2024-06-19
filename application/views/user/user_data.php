<style>

    .card {
        width: 60%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        padding: 20px;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column; /* Change flex direction to column for smaller screens */
        align-items: center; /* Center align on smaller screens */
    }

    .user-info {
        flex: 1;
        padding-right: 20px;
        width: 100%; /* Make user-info take up 100% width */
        max-width: 600px; /* Set a maximum width for better readability on larger screens */
        box-sizing: border-box; /* Include padding and border in the total width */
    }

    .user-info table {
        width: 100%; /* Make the table take up 100% width of its container */
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

    @media screen and (min-width: 768px) {
        .card {
            flex-direction: row;
            align-items: flex-start;
        }

        .user-info {
            width: 70%;
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

    
</div>