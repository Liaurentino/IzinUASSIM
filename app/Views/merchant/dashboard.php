<?= $this->extend('merchant/layout/merchant_template') ?>

<?= $this->section('content') ?>
<div class="container dashboard-container">
    <div class="sidebar">
        <h2>Menu Merchant</h2>
        <ul>
            <li><a href="<?= base_url('merchant/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('merchant/products') ?>">Kelola Produk</a></li>
            <li><a href="<?= base_url('merchant/reservation') ?>">Kelola Reservasi</a></li>
            <li><a href="<?= base_url('merchant/statistic') ?>">Statistik & Laporan</a></li>
            <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1 class="text-2xl font-bold mb-4">Dashboard Merchant (Disetujui)</h1>
        
        <div class="status-card approved">
            <h2 class="text-xl">Status Akun Anda: Disetujui (Approved)</h2>
            <p>Selamat! Toko Anda sudah aktif di *marketplace*.</p>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-3">Ringkasan Aktivitas</h2>
        <!-- Contoh tampilan ringkasan data -->
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); flex: 1;">
                <p class="text-lg font-bold">Total Produk</p>
                <p class="text-2xl text-blue-600">12</p>
            </div>
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); flex: 1;">
                <p class="text-lg font-bold">Reservasi Baru</p>
                <p class="text-2xl text-green-600">5</p>
            </div>
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); flex: 1;">
                <p class="text-lg font-bold">Total Pendapatan (Bulan Ini)</p>
                <p class="text-2xl text-gray-700">Rp 5.500.000</p>
            </div>
        </div>
        
        <h2 class="text-xl font-semibold mt-6 mb-3">Reservasi Terbaru</h2>
        <!-- Ganti dengan data reservasi aktual -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Reservasi</th>
                    <th>Nama Pelanggan</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>R1001</td>
                    <td>Budi Santoso</td>
                    <td>2025-12-15 14:00</td>
                    <td><a href="#" class="btn btn-success" style="padding: 5px 10px;">Lihat Detail</a></td>
                </tr>
                <tr>
                    <td>R1002</td>
                    <td>Siti Aisyah</td>
                    <td>2025-12-16 10:30</td>
                    <td><a href="#" class="btn btn-success" style="padding: 5px 10px;">Lihat Detail</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>