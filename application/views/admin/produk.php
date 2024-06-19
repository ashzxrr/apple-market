<?php
$this->load->helper('text');
?>
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

    .edit-icon,
.delete-icon {
    font-size: 18px;
    margin-right: 5px;
    cursor: pointer;
}

.edit-icon {
    color: #008000; /* Green color for edit icon */
}

.edit-icon:hover {
    color: #0000ff; /* Blue color for edit icon on hover */
}

.delete-icon {
    color: #000000; /* Black color for delete icon */
}

.delete-icon:hover {
    color: #ff0000; /* Red color for delete icon on hover */
}

.tambah-produk-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #90EE90; 
        color: black; 
        text-decoration: none;
        border-radius: 5px;
    }

    .tambah-produk-link:hover {
        background-color: #45a049; 
    }

</style>

<!-- Konten halaman produk admin -->
<?php if ($this->session->flashdata('success')): ?>
    <div style="color: green;">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
<a href="<?= base_url('admin-tambahpro') ?>" class="tambah-produk-link">Tambah Produk</a>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Kategori</th>
                <th>---</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach ($produk as $key=>$row) { ?>
       
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $row->id_produk; ?></td>
                <td><?php echo $row->nama_produk?></td>
                <td>Rp. <?php echo number_format($row->harga , 0,',','.'); ?></td>
                <td>
                    <span id="deskripsiRingkas_<?php echo $row->id_produk; ?>"><?php echo character_limiter($row->deskripsi, 50); ?></span>
                    <?php if (strlen($row->deskripsi) > 50): ?>
                        <br>
                        <a href="#" id="detailLink_<?php echo $row->id_produk; ?>" onclick="toggleDetail('<?php echo $row->id_produk; ?>', true)">Detail</a>
                        <div id="deskripsiDetail_<?php echo $row->id_produk; ?>" style="display: none;">
                            <?php echo $row->deskripsi; ?>
                            <a href="#" onclick="toggleDetail('<?php echo $row->id_produk; ?>', false)">Close</a>
                        </div>
                    <?php endif; ?>
                </td>
                <td><?php echo $row->stok; ?></td>
                <td>
                    <img src="<?= base_url('upload/produk/' . $row->foto); ?>" alt="Foto Produk" style="max-width: 100px; max-height: 100px;">
                </td>
                <td><?php echo $row->kategori; ?></td>

                <td>
                    <a class="edit-icon" href="<?php echo base_url('admin-edit_pro/'.$row->id_produk);?>">&#9998;</a>
                    <a class="delete-icon" onclick="return confirm('Apakah ingin menghapus data ini?')" href="<?php echo base_url('admin-hapus_pro/'.$row->id_produk);?>">&#128465;</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Tambahkan JavaScript untuk menangani tampilan deskripsi penuh -->
<script>
    function toggleDetail(id, showDetail) {
        var deskripsiRingkas = document.querySelector('#deskripsiRingkas_' + id);
        var detailDiv = document.getElementById('deskripsiDetail_' + id);
        var detailLink = document.getElementById('detailLink_' + id);

        if (showDetail) {
            deskripsiRingkas.style.display = 'none';
            detailDiv.style.display = 'block';
            detailLink.style.display = 'none';
        } else {
            deskripsiRingkas.style.display = 'inline';
            detailDiv.style.display = 'none';
            detailLink.style.display = 'inline';
        }
    }
</script>
