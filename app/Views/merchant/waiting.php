<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Persetujuan - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .waiting-card {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            text-align: center;
        }

        .icon-pending {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #f1c40f, #f39c12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .icon-pending svg {
            width: 50px;
            height: 50px;
            stroke: white;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background: #fff3cd;
            color: #856404;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .message {
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: left;
        }

        .info-box h3 {
            font-size: 16px;
            color: #687bdb;
            margin-bottom: 10px;
        }

        .info-box p {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 30px;
            background: #687bdb;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .btn-home:hover {
            background: #5568c3;
            transform: translateY(-2px);
        }
    </style>
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
            <p><strong>Nama Usaha:</strong> <?= esc($merchant['merchant_name'] ?? $merchant['business_name']) ?></p>
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