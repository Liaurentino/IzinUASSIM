<?= $this->extend('merchant/layout/merchant_template') ?>

<?= $this->section('content') ?>
<div class="container dashboard-container">
    <div class="main-content" style="width: 100%;">
        <h1 class="text-2xl font-bold mb-4">Dashboard Merchant</h1>
        
        <div class="status-card rejected">
            <h2 class="text-xl">Pendaftaran Merchant Anda Ditolak (Rejected)</h2>
            <p>Mohon maaf, pendaftaran Merchant untuk <strong><?= esc($merchant['merchant_name']) ?></strong> tidak disetujui oleh Admin.</p>
            <p>Harap periksa kembali informasi pendaftaran Anda atau hubungi Administrator untuk informasi lebih lanjut.</p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="<?= base_url('merchant/register') ?>" class="btn btn-success">Daftar Ulang</a>
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>