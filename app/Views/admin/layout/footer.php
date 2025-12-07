<!-- ========================================== -->
<!-- app/Views/admin/layout/footer.php -->
<!-- ========================================== -->
    </div>
</div>
</body>
</html>


<!-- ========================================== -->
<!-- app/Views/admin/dashboard.php -->
<!-- ========================================== -->

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="stat-number"><?= $totalUsers ?></div>
    </div>

    <div class="stat-card">
        <h3>Total Merchants</h3>
        <div class="stat-number"><?= $totalMerchants ?></div>
    </div>

    <div class="stat-card pending">
        <h3>Pending Verification</h3>
        <div class="stat-number"><?= $pendingMerchants ?></div>
    </div>

    <div class="stat-card">
        <h3>Total Products</h3>
        <div class="stat-number"><?= $totalProducts ?></div>
    </div>

    <div class="stat-card">
        <h3>Total Reservations</h3>
        <div class="stat-number"><?= $totalReservations ?></div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h3>📊 Quick Overview</h3>
    </div>
    <div style="padding: 30px; text-align: center;">
        <p style="color: #666; margin-bottom: 20px;">Selamat datang di Admin Dashboard Servify!</p>
        <a href="<?= base_url('admin/merchants') ?>" class="btn btn-primary">
            Lihat Merchant Pending (<?= $pendingMerchants ?>)
        </a>
    </div>
</div>


<!-- ========================================== -->
<!-- app/Views/admin/merchants.php -->
<!-- ========================================== -->

<div class="table-container">
    <div class="table-header">
        <h3>🏢 Verifikasi Merchant - Total: <?= count($merchants) ?></h3>
    </div>

    <?php if (!empty($merchants)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Bisnis</th>
                    <th>Owner</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tipe Bisnis</th>
                    <th>No. Izin</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($merchants as $merchant): ?>
                    <tr>
                        <td>#<?= $merchant['id'] ?></td>
                        <td><strong><?= esc($merchant['business_name']) ?></strong></td>
                        <td><?= esc($merchant['user_name']) ?></td>
                        <td><?= esc($merchant['email']) ?></td>
                        <td><?= esc($merchant['phone']) ?></td>
                        <td><?= esc($merchant['business_type']) ?></td>
                        <td><?= esc($merchant['license_number']) ?></td>
                        <td>
                            <?php
                            $badgeClass = [
                                'Pending' => 'badge-pending',
                                'Verified' => 'badge-verified',
                                'Rejected' => 'badge-rejected'
                            ][$merchant['status']];
                            ?>
                            <span class="badge <?= $badgeClass ?>">
                                <?= esc($merchant['status']) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($merchant['created_at'])) ?></td>
                        <td>
                            <?php if ($merchant['status'] === 'Pending'): ?>
                                <form method="POST" action="<?= base_url('admin/updateMerchantStatus/' . $merchant['id']) ?>" style="display: inline;">
                                    <input type="hidden" name="status" value="Verified">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Verifikasi merchant ini?')">
                                        ✓ Verify
                                    </button>
                                </form>
                                <form method="POST" action="<?= base_url('admin/updateMerchantStatus/' . $merchant['id']) ?>" style="display: inline;">
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak merchant ini?')">
                                        ✗ Reject
                                    </button>
                                </form>
                            <?php else: ?>
                                <span style="color: #999; font-size: 12px;">
                                    <?= $merchant['status'] === 'Verified' ? '✓ Sudah Verified' : '✗ Ditolak' ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1"/>
            </svg>
            <p>Belum ada merchant terdaftar</p>
        </div>
    <?php endif; ?>
</div>


<!-- ========================================== -->
<!-- app/Views/admin/users.php -->
<!-- ========================================== -->

<div class="table-container">
    <div class="table-header">
        <h3>👥 Kelola Users - Total: <?= count($users) ?></h3>
    </div>

    <?php if (!empty($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>#<?= $user['id'] ?></td>
                        <td><strong><?= esc($user['name']) ?></strong></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['phone']) ?></td>
                        <td><?= date('d M Y H:i', strtotime($user['created_at'])) ?></td>
                        <td>
                            <form method="POST" action="<?= base_url('admin/deleteUser/' . $user['id']) ?>" style="display: inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p>Belum ada user terdaftar</p>
        </div>
    <?php endif; ?>
</div>


<!-- ========================================== -->
<!-- app/Views/admin/products.php -->
<!-- ========================================== -->

<div class="table-container">
    <div class="table-header">
        <h3>📦 Kelola Produk - Total: <?= count($products) ?></h3>
    </div>

    <?php if (!empty($products)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Merchant</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Terjual</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>
                        <td>
                            <img src="<?= esc($product['image_url']) ?>" 
                                 alt="<?= esc($product['name']) ?>" 
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        </td>
                        <td><strong><?= esc($product['name']) ?></strong></td>
                        <td><?= esc($product['business_name']) ?></td>
                        <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= $product['sold_count'] ?></td>
                        <td>⭐ <?= $product['rating'] ?></td>
                        <td>
                            <form method="POST" action="<?= base_url('admin/deleteProduct/' . $product['id']) ?>" style="display: inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p>Belum ada produk</p>
        </div>
    <?php endif; ?>
</div>


<!-- ========================================== -->
<!-- app/Views/admin/reservations.php -->
<!-- ========================================== -->

<div class="table-container">
    <div class="table-header">
        <h3>📅 Kelola Reservasi - Total: <?= count($reservations) ?></h3>
    </div>

    <?php if (!empty($reservations)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Model Laptop</th>
                    <th>Keluhan</th>
                    <th>Tanggal Reservasi</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td>#<?= $reservation['id'] ?></td>
                        <td><strong><?= esc($reservation['name']) ?></strong></td>
                        <td><?= esc($reservation['phone']) ?></td>
                        <td><?= esc($reservation['laptop_model']) ?></td>
                        <td style="max-width: 200px;">
                            <?= esc(substr($reservation['complaint'], 0, 50)) ?>...
                        </td>
                        <td><?= date('d M Y', strtotime($reservation['reservation_date'])) ?></td>
                        <td>
                            <?php
                            $statusColors = [
                                'Pending' => 'badge-pending',
                                'Confirmed' => 'badge-verified',
                                'Completed' => 'badge-verified',
                                'Cancelled' => 'badge-rejected'
                            ];
                            $badgeClass = $statusColors[$reservation['status']] ?? 'badge-pending';
                            ?>
                            <span class="badge <?= $badgeClass ?>">
                                <?= esc($reservation['status']) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y H:i', strtotime($reservation['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p>Belum ada reservasi</p>
        </div>
    <?php endif; ?>
</div>