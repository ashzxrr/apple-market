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

    
    .status-Selesai td {
        background-color: green;
        color: white;
    }

    .status-MenungguPembayaran td {
        background-color: yellow;
        color: black;
    }

    .status-BarangSedangDikemas td {
        background-color: red;
        color: white;
    }

    .status-BarangDikirim td {
        background-color: blueviolet;
        color: white;
    }
</style>

<!-- Konten halaman produk admin -->
<?php if ($this->session->flashdata('success')): ?>
    <div style="color: green;">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<h2>Admin Orders</h2>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pesanan</th>
                <th>ID Pelanggan</th>
                <th>Nama Pembeli</th>
                <th>Status</th>
                <th>Tanggal Order</th>
                <th>Total</th>
                <th>Ongkos Kirim</th>
                <th>Bukti Pembayaran</th>
                <th>No. Resi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $displayedOrders = []; // Array untuk menyimpan id_pesanan yang sudah ditampilkan
            foreach ($orders as $key => $row) {
                // Memeriksa apakah id_pesanan sudah ditampilkan atau belum
                if (!in_array($row->id_pesanan, $displayedOrders)) {
                    ?>
                    <tr class="status-<?php echo str_replace(' ', '', $row->status_order); ?>">
                        <td><?= $key + 1; ?></td>
                        <td><?= $row->id_pesanan; ?></td>
                        <td><?= $row->id_pelanggan; ?></td>
                        <td><?= $row->nama_pembeli; ?></td>
                        <td><?= $row->status_order; ?></td>
                        <td><?= date('l, j F Y', strtotime($row->tgl_order)); ?> </td>
                        <td>Rp. <?= number_format($row->total, 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($row->ongkir, 0, ',', '.'); ?></td>
                        <td>
                            <?php $bukti = $this->admin_model->get_pembayaran_by_id($row->id_pesanan); ?>
                            <?php if ($bukti) : ?>
                                <img src="<?= base_url('upload/buktitf/' . $bukti->foto_bukti); ?>" alt="Bukti Pembayaran" style="max-width: 100px; max-height: 100px;">
                            <?php else : ?>
                                Tidak ada bukti
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $row->resi;  ?>
                        </td>
                        <td>
                            <?php if ($row->status_order == 'Barang Sedang Dikemas'): ?>
                                <a class="edit" href="<?php echo base_url('admin/kirim_pro/' . $row->id_pesanan . '/' . $row->id_pelanggan);?>">Kirim Pesanan</a>
                            <?php endif; ?>
                            <a class="detail" href="<?= base_url('admin/detail_order/' . $row->id_pesanan); ?>">Detail</a>
                        </td>
                    </tr>
                    <?php
                    // Menambahkan id_pesanan ke dalam array displayedOrders
                    $displayedOrders[] = $row->id_pesanan;
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        let lastCheckedTime = '<?= $lastCheckedTime; ?>'; // Simpan waktu terakhir kali cek

        function getRealtimeOrders() {
            $.ajax({
                url: '<?= base_url('admin/get_realtime_orders'); ?>/' + lastCheckedTime,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update orders on success
                    updateOrders(data);
                },
                complete: function() {
                    // Schedule the next request when the current one is complete
                    setTimeout(getRealtimeOrders, 5000); // Set interval in milliseconds (5 seconds in this example)
                }
            });
        }

        function updateOrders(orders) {
            // Check if there are new orders
            const newOrders = orders.filter(order => !displayedOrders.includes(order.id_pesanan));

            if (newOrders.length > 0) {
                // Display notification for each new order
                newOrders.forEach(order => {
                    Swal.fire({
                        title: 'Pesanan Baru!',
                        text: `Ada pesanan baru dengan ID ${order.id_pesanan}`,
                        icon: 'success',
                        confirmButtonText: 'Lihat Pesanan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to the order detail page
                            window.location.href = `<?= base_url('admin/detail_order/'); ?>${order.id_pesanan}`;
                        }
                    });
                });

                // Update displayedOrders array
                displayedOrders = displayedOrders.concat(newOrders.map(order => order.id_pesanan));
            }

            // Update lastCheckedTime with the latest order time
            if (orders.length > 0) {
                lastCheckedTime = orders.reduce((maxTime, order) => Math.max(maxTime, order.tgl_order), lastCheckedTime);
            }
        }

        // Start the polling process
        getRealtimeOrders();
    });
</script>