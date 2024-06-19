<?php
$this->load->helper('text');
$this->load->view('header');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pelanggan </title>
    <style>
        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: rgb(71, 70, 70);
            color: #E6E6FA;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
</head>
<body>

<?php if ($this->session->flashdata('success')): ?>
    <div style="color: green;">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="container">
    <h1>Data Pelanggan</h1>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
           
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        foreach ($pel as $key => $row) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->id_pelanggan; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->alamat; ?></td>
                
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
