<!-- Merchant Reservations Management -->
<div class="bg-white rounded-2xl shadow-lg p-6">
    <h3 class="text-2xl font-bold text-text-dark mb-6">Daftar Reservasi Service</h3>

    <?php if (!empty($reservations)): ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Telepon</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Model Laptop</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keluhan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($reservations as $reservation): ?>
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-4 text-sm text-gray-700">#<?= esc($reservation['id']) ?></td>
                            <td class="px-4 py-4">
                                <p class="font-medium text-gray-900"><?= esc($reservation['name']) ?></p>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700"><?= esc($reservation['phone']) ?></td>
                            <td class="px-4 py-4 text-sm text-gray-700"><?= esc($reservation['laptop_model']) ?></td>
                            <td class="px-4 py-4">
                                <p class="text-sm text-gray-700 max-w-xs truncate"><?= esc($reservation['complaint']) ?></p>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700">
                                <?= date('d M Y', strtotime($reservation['reservation_date'])) ?>
                            </td>
                            <td class="px-4 py-4">
                                <?php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Confirmed' => 'bg-blue-100 text-blue-800',
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Cancelled' => 'bg-red-100 text-red-800'
                                ];
                                $colorClass = $statusColors[$reservation['status']] ?? 'bg-gray-100 text-gray-800';
                                ?>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $colorClass ?>">
                                    <?= esc($reservation['status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openStatusModal(<?= $reservation['id'] ?>, '<?= esc($reservation['status']) ?>')" 
                                            class="bg-primary-blue text-white px-3 py-1 rounded-lg text-sm hover:bg-opacity-90 transition duration-200">
                                        Update
                                    </button>
                                    <button onclick="showDetails(<?= $reservation['id'] ?>)" 
                                            class="bg-gray-200 text-gray-700 px-3 py-1 rounded-lg text-sm hover:bg-gray-300 transition duration-200">
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-4 text-xl text-gray-500">Belum ada reservasi</p>
        </div>
    <?php endif; ?>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-text-dark mb-6">Update Status Reservasi</h3>
        
        <form id="statusForm" method="POST" action="">
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Baru</label>
                <select id="status" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            
            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-blue to-secondary-purple text-white py-3 rounded-xl font-semibold hover:shadow-lg transition duration-300">
                    Update
                </button>
                <button type="button" onclick="closeStatusModal()" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition duration-200">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openStatusModal(id, currentStatus) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    const statusSelect = document.getElementById('status');
    
    form.action = '<?= base_url('merchant/dashboard/reservations/updateStatus/') ?>' + id;
    statusSelect.value = currentStatus;
    
    modal.classList.remove('hidden');
}

function closeStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.classList.add('hidden');
}

function showDetails(id) {
    // Implementasi detail view jika diperlukan
    alert('Detail reservasi #' + id);
}

// Close modal when clicking outside
document.getElementById('statusModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>