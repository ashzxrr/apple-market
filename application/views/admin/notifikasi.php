<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <style>

        .container {
            max-width: 800px;
            width: 100%;
            margin: 3% auto;
        }

        h1 {
            text-align: center;
        }

        .notification-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-content {
            flex: 1;
        }

        .notification-content strong {
            display: block;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .notification-content p {
            margin: 0;
        }

        .notification-content small {
            color: #888;
            font-size: 12px;
            margin-top: 8px;
            display: block;
        }

        .detail {
            text-align: right;
        }

        .detail p {
            margin: 0;
        }

        .detail a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $notification): ?>
            <div class="notification-card">
                <div class="notification-content">
                    <strong><?= $notification->title; ?></strong>
                    <p><?= $notification->message; ?></p>
                    <small><?= $notification->created_at; ?></small>
                </div>
                <div class="detail">
                    <p>Id Pesanan : <?= $notification->id_pesanan;?></p>
                    <a href="<?= base_url('admin/detail_order/'.$notification->id_pesanan) ?>">Detail Pesanan</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada notifikasi saat ini.</p>
    <?php endif; ?>
</div>

</body>
</html>
