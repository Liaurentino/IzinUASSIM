<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-[#687bdb] mb-4">Temukan Lokasi Kami</h1>
        <p class="text-gray-600">Cari service center Servify terdekat dari lokasi Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden relative z-0">
                <div id="map" class="w-full h-[600px] z-0"></div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-2xl shadow-lg p-6 max-h-[600px] overflow-y-auto custom-scrollbar">
                <h3 class="text-xl font-bold text-[#687bdb] mb-4 border-b pb-2">Partner Service Center</h3>
                
                <div class="mb-4">
                    <input type="text" id="merchantSearch" placeholder="Cari nama tempat..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           onkeyup="filterMerchants()">
                </div>
                
                <div id="locationList" class="space-y-3">
                </div>
            </div>
            
        </div>

    </div>
</div>

<link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// Data dari database (dikirim dari controller)
let allMerchants = <?= isset($merchants) ? json_encode($merchants) : '[]' ?>;

// Konversi merchant data ke format yang dibutuhkan untuk peta
const serviceLocations = allMerchants.map(merchant => ({
    id: merchant.id,
    name: merchant.business_name || merchant.merchant_name,
    address: merchant.address,
    phone: merchant.phone,
    email: merchant.email,
    business_type: merchant.business_type,
    lat: merchant.latitude ? parseFloat(merchant.latitude) : -6.2088,
    lng: merchant.longitude ? parseFloat(merchant.longitude) : 106.8456,
    hours: "09:00 - 18:00" // Default, bisa di-extend di database nanti
}));

let map;
let markers = {};
let filteredLocations = [...serviceLocations];

function initMap() {
    // Inisialisasi Peta - dengan default center
    const centerLat = serviceLocations.length > 0 ? serviceLocations[0].lat : -6.2088;
    const centerLng = serviceLocations.length > 0 ? serviceLocations[0].lng : 106.8456;
    
    map = L.map('map', {
        zoomControl: false 
    }).setView([centerLat, centerLng], 11);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    addServiceMarkers();
    populateLocationList();
}

function addServiceMarkers() {
    // Hapus marker lama
    Object.values(markers).forEach(marker => map.removeLayer(marker));
    markers = {};

    const customIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `<div style="background-color: #687bdb; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; color: white;"><i class="fas fa-tools" style="font-size: 14px;"></i></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
    });

    filteredLocations.forEach((loc) => {
        const marker = L.marker([loc.lat, loc.lng], { icon: customIcon })
            .addTo(map)
            .bindPopup(createPopupContent(loc));
        
        markers[loc.id] = marker;
    });

    // Adjust map bounds
    if (filteredLocations.length > 0) {
        const group = new L.featureGroup(Object.values(markers));
        map.fitBounds(group.getBounds().pad(0.1));
    }
}

function createPopupContent(loc) {
    return `
        <div style="font-family: 'Poppins', sans-serif; min-width: 250px;">
            <div style="background: linear-gradient(135deg, #687bdb, #5568c3); color: white; padding: 12px; font-weight: bold; font-size: 14px; border-radius: 4px 4px 0 0;">
                ${escapeHtml(loc.name)}
            </div>
            <div style="padding: 15px;">
                <p style="margin: 0 0 8px 0; color: #555; font-size: 13px;"><i class="fas fa-map-marker-alt" style="width: 20px; color: #687bdb;"></i> ${escapeHtml(loc.address)}</p>
                <p style="margin: 0 0 8px 0; color: #555; font-size: 13px;"><i class="fas fa-phone" style="width: 20px; color: #687bdb;"></i> ${escapeHtml(loc.phone)}</p>
                ${loc.email ? `<p style="margin: 0 0 8px 0; color: #555; font-size: 13px;"><i class="fas fa-envelope" style="width: 20px; color: #687bdb;"></i> ${escapeHtml(loc.email)}</p>` : ''}
                <p style="margin: 0 0 12px 0; color: #555; font-size: 13px;"><i class="fas fa-cogs" style="width: 20px; color: #687bdb;"></i> ${escapeHtml(loc.business_type || 'Servis Laptop')}</p>
                <a href="https://www.google.com/maps/dir/?api=1&destination=${loc.lat},${loc.lng}" 
                   target="_blank" 
                   style="display: block; background: linear-gradient(135deg, #687bdb, #5568c3); color: white; text-align: center; padding: 8px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                   📍 Buka di Google Maps
                </a>
            </div>
        </div>
    `;
}

function populateLocationList() {
    const listContainer = document.getElementById('locationList');
    
    if (filteredLocations.length === 0) {
        listContainer.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada lokasi yang ditemukan</p>';
        return;
    }
    
    listContainer.innerHTML = '';
    
    filteredLocations.forEach((loc, index) => {
        const card = document.createElement('div');
        card.className = 'bg-gray-50 rounded-xl p-4 hover:bg-[#eff4ff] hover:shadow-md transition duration-200 cursor-pointer border border-transparent hover:border-[#687bdb]';
        card.onclick = () => focusLocation(loc.id);
        
        card.innerHTML = `
            <div class="flex justify-between items-start mb-2">
                <h4 class="font-bold text-gray-800 text-sm flex-1">${escapeHtml(loc.name)}</h4>
                <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full whitespace-nowrap ml-2">Buka</span>
            </div>
            <p class="text-xs text-gray-500 mb-3 line-clamp-2">${escapeHtml(loc.address)}</p>
            <div class="text-xs text-gray-600 mb-3">
                <p><strong>Tipe:</strong> ${escapeHtml(loc.business_type || 'Servis Laptop')}</p>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <a href="tel:${escapeHtml(loc.phone)}" class="text-xs text-[#687bdb] hover:underline flex items-center">
                    <i class="fas fa-phone mr-1"></i> Hubungi
                </a>
                <span class="text-gray-300">|</span>
                <button onclick="event.stopPropagation(); focusLocation(${loc.id})" class="text-xs text-[#687bdb] hover:underline flex items-center">
                    <i class="fas fa-map mr-1"></i> Lihat
                </button>
                <span class="text-gray-300">|</span>
                <a href="${base_url}reservation" class="text-xs text-green-600 hover:underline flex items-center">
                    <i class="fas fa-calendar mr-1"></i> Reservasi
                </a>
            </div>
        `;
        
        listContainer.appendChild(card);
    });
}

function focusLocation(merchantId) {
    const loc = filteredLocations.find(l => l.id === merchantId);
    if (!loc) return;
    
    map.flyTo([loc.lat, loc.lng], 15, {
        duration: 1.5
    });
    
    if (markers[merchantId]) {
        markers[merchantId].openPopup();
    }
}

function filterMerchants() {
    const searchTerm = document.getElementById('merchantSearch').value.toLowerCase();
    
    if (searchTerm.length === 0) {
        filteredLocations = [...serviceLocations];
    } else {
        filteredLocations = serviceLocations.filter(loc => 
            loc.name.toLowerCase().includes(searchTerm) ||
            loc.address.toLowerCase().includes(searchTerm) ||
            loc.phone.includes(searchTerm)
        );
    }
    
    addServiceMarkers();
    populateLocationList();
}

// Helper function to escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Initialize map when document is ready
document.addEventListener('DOMContentLoaded', initMap);
</script>