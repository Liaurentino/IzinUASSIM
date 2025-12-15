<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-text-dark">Manajemen Reservasi Service</h1>
        <div class="flex gap-2">
            <a href="?status=all" class="px-4 py-2 bg-primary-blue text-white rounded-lg <?= $currentFilter === 'all' ? 'ring-2 ring-offset-2' : '' ?>">Semua</a>
            <a href="?status=Pending" class="px-4 py-2 bg-yellow-500 text-white rounded-lg <?= $currentFilter === 'Pending' ? 'ring-2 ring-offset-2' : '' ?>">Pending</a>
            <a href="?status=Processing" class="px-4 py-2 bg-blue-500 text-white rounded-lg <?= $currentFilter === 'Processing' ? 'ring-2 ring-offset-2' : '' ?>">Dikerjakan</a>
            <a href="?status=Completed" class="px-4 py-2 bg-green-500 text-white rounded-lg <?= $currentFilter === 'Completed' ? 'ring-2 ring-offset-2' : '' ?>">Selesai</a>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
            <p class="text-gray-600 text-sm">Menunggu Dikerjakan</p>
            <p class="text-3xl font-bold text-yellow-600 mt-2"><?= $stats['pending'] ?></p>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <p class="text-gray-600 text-sm">Sedang Dikerjakan</p>
            <p class="text-3xl font-bold text-blue-600 mt-2"><?= $stats['processing'] ?></p>
        </div>
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg">
            <p class="text-gray-600 text-sm">Selesai</p>
            <p class="text-3xl font-bold text-green-600 mt-2"><?= $stats['completed'] ?></p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <?php if (!empty($reservations)): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-primary-blue to-secondary-purple text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Telepon</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Model Laptop</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Reservasi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($reservations as $index => $reservation): ?>
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">#<?= esc($reservation['id']) ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900"><?= esc($reservation['name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($reservation['phone']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= esc($reservation['phone']) ?></td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($reservation['laptop_model']) ?></div>
                                    <div class="text-xs text-gray-500"><?= esc(substr($reservation['complaint'], 0, 40)) ?>...</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <?= date('d M Y', strtotime($reservation['reservation_date'])) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php 
                                    $statusColors = [
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Processing' => 'bg-blue-100 text-blue-800',
                                        'Completed' => 'bg-green-100 text-green-800',
                                        'Cancelled' => 'bg-red-100 text-red-800'
                                    ];
                                    $colorClass = $statusColors[$reservation['status']] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $colorClass ?>">
                                        <?= esc($reservation['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2 flex">
                                    <button onclick="openUpdateModal(<?= $reservation['id'] ?>, '<?= esc($reservation['status']) ?>')" 
                                            class="bg-primary-blue text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition duration-200 text-xs font-semibold">
                                        Update
                                    </button>
                                    <button onclick="openDetailModal(<?= $reservation['id'] ?>)" 
                                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-200 text-xs font-semibold">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-xl text-gray-500">Belum ada reservasi</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- UPDATE STATUS MODAL -->
<div id="updateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
        <div class="bg-gradient-to-r from-primary-blue to-secondary-purple text-white p-6">
            <h3 class="text-2xl font-bold">Update Status Reservasi</h3>
        </div>
        
        <form id="updateStatusForm" method="POST" class="p-6 space-y-4">
            <input type="hidden" id="updateReservationId" name="id">
            
            <div>
                <label for="updateStatus" class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                <select id="updateStatus" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <option value="Pending">Pending (Menunggu)</option>
                    <option value="Processing">Processing (Sedang Dikerjakan)</option>
                    <option value="Completed">Completed (Selesai)</option>
                    <option value="Cancelled">Cancelled (Dibatalkan)</option>
                </select>
            </div>

            <div>
                <label for="updateNotes" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea id="updateNotes" name="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent" placeholder="Contoh: Menunggu spare part"></textarea>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-blue to-secondary-purple text-white py-3 rounded-xl font-semibold hover:shadow-lg transition duration-200">
                    Update
                </button>
                <button type="button" onclick="closeUpdateModal()" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition duration-200">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openUpdateModal(id, currentStatus) {
    document.getElementById('updateReservationId').value = id;
    document.getElementById('updateStatus').value = currentStatus;
    document.getElementById('updateModal').classList.remove('hidden');
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.add('hidden');
}

function openDetailModal(id) {
    window.location.href = '<?= base_url('merchant/dashboard/reservations/detail/') ?>' + id;
}


document.getElementById('updateStatusForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const reservationId = document.getElementById('updateReservationId').value;
    const status = document.getElementById('updateStatus').value;
    const notes = document.getElementById('updateNotes').value;
    
    try {
        const response = await fetch('<?= base_url('merchant/dashboard/reservations/updateStatus/') ?>' + reservationId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'status=' + encodeURIComponent(status) + '&notes=' + encodeURIComponent(notes)
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Status berhasil diupdate');
            location.reload();
        } else {
            alert('Gagal mengupdate status: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
    }
});

document.getElementById('updateModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeUpdateModal();
    }
});
</script>