<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .back-link {
            color: #687bdb;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 32px;
            color: #687bdb;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .table-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 18px 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-completed {
            background: #d4edda;
            color: #155724;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-action {
            background: #687bdb;
            color: white;
        }

        .btn-action:hover {
            background: #5568c3;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
        }

        .modal-header {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-close {
            background: #e0e0e0;
            color: #666;
        }
    </style>
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