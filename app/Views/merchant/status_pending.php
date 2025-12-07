<?= $this->extend('merchant/layout/merchant_template') ?>

<?= $this->section('content') ?>
<div class="container dashboard-container">
    <div class="main-content" style="width: 100%;">
        <h1 class="text-2xl font-bold mb-4">Dashboard Merchant</h1>
        
        <div class="status-card pending">
            <h2 class="text-xl">Pendaftaran Anda Masih Dalam Proses (Pending)</h2>
            <p>Terima kasih telah mendaftar sebagai Merchant. Akun Anda sedang ditinjau oleh Admin.</p>
            <p>Anda akan menerima notifikasi setelah status Anda disetujui. Mohon bersabar.</p>
            <p class="mt-4">Detail Pendaftaran Merchant: <strong><?= esc($merchant['merchant_name']) ?></strong></p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>