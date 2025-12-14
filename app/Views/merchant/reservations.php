<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="<?= base_url('css/merchant.css') ?>">
</head>
<body>
    <div class="container">
        <a href="<?= base_url('merchant/dashboard') ?>" class="back-link">
            ← Kembali ke Dashboard
        </a>

        <h1 class="page-title">Kelola Reservasi Service</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="table-card">
            <?php if (!empty($reservations)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Telepon</th>
                            <th>Model Laptop</th>
                            <th>Keluhan</th>
                            <th>Tanggal</th>
                            <th>Tempat Service</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $index => $reservation): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><strong><?= esc($reservation['name']) ?></strong></td>
                                <td><?= esc($reservation['phone']) ?></td>
                                <td><?= esc($reservation['laptop_model']) ?></td>
                                <td><?= esc(substr($reservation['complaint'], 0, 30)) ?>...</td>
                                <td><?= date('d M Y', strtotime($reservation['reservation_date'])) ?></td>
                                <td><?= esc($reservation['service_location'] ?? 'Belum ditentukan') ?></td>
                                <td>
                                    <?php 
                                    $statusClass = 'pending';
                                    if ($reservation['status'] == 'Confirmed') $statusClass = 'confirmed';
                                    if ($reservation['status'] == 'Completed') $statusClass = 'completed';
                                    ?>
                                    <span class="badge badge-<?= $statusClass ?>">
                                        <?= esc($reservation['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-action" onclick="openModal(<?= $reservation['id'] ?>, '<?= esc($reservation['status']) ?>')">
                                        Update Status
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <svg width="80" height="80" fill="none" stroke="#ddd" viewBox="0 0 24 24" style="margin: 0 auto 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p>Belum ada reservasi</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Update Status -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-header">Update Status Reservasi</h2>
            <form id="statusForm" method="POST" action="">
                <div class="form-group">
                    <label for="status">Status Baru</label>
                    <select id="status" name="status" class="form-control">
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-action" style="flex: 1;">Update</button>
                    <button type="button" class="btn btn-close" style="flex: 1;" onclick="closeModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, currentStatus) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');
            const statusSelect = document.getElementById('status');
            
            form.action = '<?= base_url('merchant/reservations/updateStatus/') ?>' + id;
            statusSelect.value = currentStatus;
            
            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('statusModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('statusModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>