<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Persetujuan - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/merchant.css') ?>">
</head>
<body>
    <div class="waiting-card">
        <div class="icon-pending">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <span class="status-badge">⏳ Menunggu Persetujuan</span>

        <h1>Pendaftaran Sedang Diproses</h1>

        <p class="message">
            Terima kasih telah mendaftar sebagai Merchant di Servify!<br>
            Akun Anda sedang dalam proses verifikasi oleh tim admin kami.
        </p>

        <div class="info-box">
            <h3>Detail Pendaftaran</h3>
            <p><strong>Nama Usaha:</strong> <?= esc($merchants['merchant_name']) ?></p>
            <p><strong>Status:</strong> Menunggu Verifikasi</p>
        </div>

        <p style="font-size: 14px; color: #999; margin: 20px 0;">
            Proses verifikasi biasanya memakan waktu 1-3 hari kerja.<br>
            Anda akan menerima notifikasi melalui email setelah akun Anda disetujui.
        </p>

        <a href="<?= base_url('/') ?>" class="btn-home">Kembali ke Beranda</a>
        
        <p style="margin-top: 20px;">
            <a href="<?= base_url('logout') ?>" style="color: #e74c3c; text-decoration: none; font-size: 14px;">Logout</a>
        </p>
    </div>
</body>
</html>