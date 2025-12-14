<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Reservasi - Servify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="container">

    <a href="<?= base_url('merchant/reservations') ?>" class="back-link">← Kembali</a>

    <h1 class="page-title">Detail Reservasi</h1>

    <div class="recent-section">

        <div class="section-header">
            <h2 class="section-title">Informasi Pelanggan</h2>
        </div>

        <table>
            <tr>
                <th>Nama</th>
                <td><?= esc($reservation['customer_name'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= esc($reservation['customer_email'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td><?= esc($reservation['customer_phone'] ?? '-') ?></td>
            </tr>
        </table>

    </div>

    <br>

    <div class="recent-section">

        <div class="section-header">
            <h2 class="section-title">Detail Layanan</h2>
        </div>

        <table>
            <tr>
                <th>Layanan</th>
                <td><?= esc($reservation['service_name'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= esc($reservation['reservation_date'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Jam</th>
                <td><?= esc($reservation['reservation_time'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if (($reservation['status'] ?? '') === 'pending'): ?>
                        <span class="status-badge">Menunggu</span>
                    <?php elseif (($reservation['status'] ?? '') === 'approved'): ?>
                        <span class="status-badge" style="background:#dcfce7;color:#16a34a;">Disetujui</span>
                    <?php else: ?>
                        <span class="status-badge" style="background:#fee2e2;color:#dc2626;">Ditolak</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td><?= esc($reservation['notes'] ?? '-') ?></td>
            </tr>
        </table>

    </div>

</div>

</body>
</html>
