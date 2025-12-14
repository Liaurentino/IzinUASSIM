<div class="flex justify-center items-center h-full">
    <div class="card-bg-gray p-8 rounded-2xl shadow-xl w-full max-w-3xl transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-center text-primary-blue mb-6">Formulir Reservasi Service</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                <p><?= session()->getFlashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <?= form_open(base_url('reservation/create'), ['class' => 'space-y-6', 'id' => 'reservationForm']) ?>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-text-dark">Nama <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" 
                           placeholder="Nama Lengkap Anda" 
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"
                           required>
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('name')) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-text-dark">No. Telp <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" 
                           placeholder="Nomor Telepon Aktif" 
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"
                           required>
                    <?php if ($validation->getError('phone')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('phone')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <label for="merchant_id" class="block text-sm font-medium text-text-dark">Pilih Tempat Service <span class="text-red-500">*</span></label>
                
                <select id="merchant_id" name="merchant_id" 
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue bg-white"
                        required onchange="updateMerchantName()">
                    <option value="">-- Pilih Tempat Service --</option>
                    <?php if (!empty($merchants)): ?>
                        <?php foreach ($merchants as $merchant): ?>
                            <option value="<?= esc($merchant['id']) ?>" 
                                    data-name="<?= esc($merchant['business_name']) ?>"
                                    data-address="<?= esc($merchant['address']) ?>"
                                    data-phone="<?= esc($merchant['phone']) ?>"
                                    <?= old('merchant_id') == $merchant['id'] ? 'selected' : '' ?>>
                                📍 <?= esc($merchant['business_name']) ?> - <?= esc($merchant['address']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <?php if ($validation->getError('merchant_id')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('merchant_id')) ?></p>
                <?php endif; ?>

                <!-- Merchant Info Display -->
                <div id="merchantInfo" class="mt-3 p-4 bg-blue-50 rounded-xl hidden">
                    <p class="text-sm font-semibold text-primary-blue mb-2" id="infoTitle"></p>
                    <p class="text-sm text-gray-600 mb-1"><strong>Alamat:</strong> <span id="infoAddress"></span></p>
                    <p class="text-sm text-gray-600"><strong>Telepon:</strong> <span id="infoPhone"></span></p>
                </div>
            </div>

            <!-- Hidden input untuk merchant name -->
            <input type="hidden" id="merchant_name" name="merchant_name" value="<?= old('merchant_name') ?>">

            <div>
                <label for="laptop_model" class="block text-sm font-medium text-text-dark">Model Laptop <span class="text-red-500">*</span></label>
                <input type="text" id="laptop_model" name="laptop_model" value="<?= old('laptop_model') ?>" 
                       placeholder="Contoh: Asus VivoBook Pro 15" 
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"
                       required>
                <?php if ($validation->getError('laptop_model')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('laptop_model')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="complaint" class="block text-sm font-medium text-text-dark">Keluhan <span class="text-red-500">*</span></label>
                <textarea id="complaint" name="complaint" rows="4" 
                          placeholder="Contoh: layar mati, boot loop, keyboard rusak" 
                          class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"
                          required><?= old('complaint') ?></textarea>
                <?php if ($validation->getError('complaint')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('complaint')) ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="reservation_date" class="block text-sm font-medium text-text-dark">Tanggal Reservasi <span class="text-red-500">*</span></label>
                <input type="date" id="reservation_date" name="reservation_date" 
                       value="<?= old('reservation_date') ?>" 
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"
                       min="<?= date('Y-m-d') ?>"
                       required>
                <?php if ($validation->getError('reservation_date')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('reservation_date')) ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-6 flex justify-center">
                <button type="submit" class="bg-secondary-purple text-white py-3 px-12 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Buat Reservasi
                </button>
            </div>

        <?= form_close() ?>
    </div>
</div>

<script>
function updateMerchantName() {
    const select = document.getElementById('merchant_id');
    const selectedOption = select.options[select.selectedIndex];
    const merchantName = selectedOption.getAttribute('data-name');
    const merchantAddress = selectedOption.getAttribute('data-address');
    const merchantPhone = selectedOption.getAttribute('data-phone');
    
    document.getElementById('merchant_name').value = merchantName || '';
    
    if (merchantName) {
        document.getElementById('merchantInfo').classList.remove('hidden');
        document.getElementById('infoTitle').textContent = merchantName;
        document.getElementById('infoAddress').textContent = merchantAddress;
        document.getElementById('infoPhone').textContent = merchantPhone;
    } else {
        document.getElementById('merchantInfo').classList.add('hidden');
    }
}

// Search merchant dengan AJAX
function searchMerchants() {
    const search = document.getElementById('merchantSearch').value;
    
    if (search.length < 2) {
        location.reload();
        return;
    }

    fetch('<?= base_url('reservation/getMerchants') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'search=' + encodeURIComponent(search)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const select = document.getElementById('merchant_id');
            select.innerHTML = '<option value="">-- Pilih Tempat Service --</option>';
            
            data.merchants.forEach(merchant => {
                const option = document.createElement('option');
                option.value = merchant.id;
                option.setAttribute('data-name', merchant.business_name);
                option.setAttribute('data-address', merchant.address);
                option.setAttribute('data-phone', merchant.phone);
                option.textContent = '📍 ' + merchant.business_name + ' - ' + merchant.address;
                select.appendChild(option);
            });
        }
    })
    .catch(error => console.error('Error:', error));
}

function clearSearch() {
    document.getElementById('merchantSearch').value = '';
    location.reload();
}

// Validasi form sebelum submit
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    const merchantId = document.getElementById('merchant_id').value;
    
    if (!merchantId) {
        e.preventDefault();
        alert('Silakan pilih tempat service terlebih dahulu');
        return false;
    }
});
</script>