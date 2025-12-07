<?= $this->extend('admin/layout/admin_template') ?>

<?= $this->section('content') ?>
<!-- PERBAIKAN: Tambahkan class 'admin' di sini agar gaya spesifik Admin di CSS termuat -->
<div class="container dashboard-container admin">
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="#">Manajemen Pengguna</a></li>
            <li><a href="#">Laporan Penjualan</a></li>
            <li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
        <p>Selamat datang, Admin! Anda dapat mengelola semua permintaan di sini.</p>

        <?php if (session()->getFlashdata('success')): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <h2 class="text-xl font-semibold mt-6 mb-3">Permintaan Merchant Tertunda (Pending)</h2>
        
        <?php if (empty($pending_merchants)): ?>
            <div style="background-color: #f0f8ff; color: #34495e; padding: 15px; border-radius: 5px; text-align: center;">
                Tidak ada permintaan Merchant baru saat ini.
            </div>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Merchant</th>
                        <th>Nama Merchant</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_merchants as $merchant): ?>
                        <tr>
                            <td><?= esc($merchant['id']) ?></td>
                            <td><?= esc($merchant['merchant_name'] ?? 'N/A') ?></td>
                            <td><?= esc($merchant['address']) ?></td>
                            <td><?= esc($merchant['phone']) ?></td>
                            <td><span style="color: #f39c12; font-weight: bold;"><?= esc(ucfirst($merchant['status'])) ?></span></td>
                            <td>
                                <a href="<?= base_url('admin/approve/' . $merchant['id']) ?>" class="btn btn-success" 
                                   onclick="return confirm('Apakah Anda yakin ingin MENYETUJUI merchant ini?')">Setujui</a>
                                <a href="<?= base_url('admin/reject/' . $merchant['id']) ?>" class="btn btn-danger" 
                                   onclick="return confirm('Apakah Anda yakin ingin MENOLAK merchant ini?')">Tolak</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>