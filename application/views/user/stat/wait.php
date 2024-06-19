<style>
  
 #nav2 {
    height: 45px;
    width: 100%;
    background-color: #E6E6FA;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    color: #6e6e6e;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 45px; /* Adjust the top position based on the height of #nav */
    left: 0;
    z-index: 98; /* Adjust the z-index to be lower than #nav */
}

#nav2 ul {
    list-style-type: none;
    display: flex;
    flex-direction: row;
    padding: 0; /* Remove default padding */
    margin: 0; /* Remove default margin */
}

#nav2 li {
    margin-right: 15px;
    cursor: pointer;
}

#nav2 li a {
    text-decoration: none;
    font-weight: 500;
    font-size: 18px;
    color: #6e6e6e;
}

#nav2 li:hover {
    color: #fff;
    background-color: #ddd;
    
}

@media only screen and (max-width: 768px) {
    #nav2 {
        top: 45px;
        z-index: 97;
    }

    .content {
        margin-top: 45px; 
    }

    .order-card {
        width: 100%; 
    }
}

    .content {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 50px; /* Adjust the margin-top as needed */
        z-index: -3;
    }

    .order-card {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%; /* Adjust the width as needed */
        box-sizing: border-box;
    }

    .product-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .product-details img {
        max-width: 100px; /* Adjust the max-width as needed */
        height: auto;
        margin-right: 10px;
    }

    .product-details,
    .product-total {
        flex: 1;
        padding: 0 10px;
    }

    .detail-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #3CB371;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .detail-button:hover {
        background-color: #45a049;
    }

    @media (min-width: 768px) {
        .order-card {
            width: 48%;
        }
    }
</style>




<div class='content'>
    <?php
    $grouped_orders = [];
    foreach ($user_orders_details as $item) {
        $id_pesanan = $item['id_pesanan'];

        if (!isset($grouped_orders[$id_pesanan])) {
            $grouped_orders[$id_pesanan] = [];
        }

        $grouped_orders[$id_pesanan][] = $item;
    }

    foreach ($grouped_orders as $group) {
        if ($group[0]['status_order'] == 'Menunggu Pembayaran'): ?>
            <div class="order-card">
                <h4>Status Order: <?= $group[0]['status_order']; ?></h4>
                <?php
                $uniqueShippingCost = null;
                $uniqueTotalPayment = null;
                foreach ($group as $product):
                ?>
                    <div class="product-summary">
                        <img src="<?= base_url('upload/produk/' . $product['foto']); ?>" alt="Foto Produk">
                        <div class="product-details">
                            <p><?= $product['nama_produk']; ?></p>
                            <p>Jumlah: <?= $product['jumlah']; ?></p>
                            <p><?= $product['id_pesanan']; ?></p>
                        </div>
                        <div class="product-total">
                            <?php
                            if ($uniqueShippingCost === null) {
                            ?>
                                <p>Ongkos Kirim: <?= $product['ongkir']; ?></p>
                            <?php
                                $uniqueShippingCost = $product['ongkir'];
                            }

                            if ($uniqueTotalPayment === null):
                                if ($product['total_pem'] !== null):
                            ?>
                                    <p>Total Pembayaran : Rp. <?= number_format($product['total_pem'], 0, ',', '.'); ?></p>
                            <?php
                                else:
                            ?>
                                    <p>Total Pembayaran : Tidak ada data total.</p>
                            <?php
                                endif;
                            ?>
                                <a href="<?= base_url('user/detail_pesanan/' . $product['id_pesanan']); ?>" class="detail-button">Detail Pesanan</a>
                            <?php
                                $uniqueTotalPayment = $product['total_pem'];
                            endif;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    <?php endif; ?>
    <?php } ?>
</div>


    