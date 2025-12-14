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
                <h3 class="text-xl font-bold text-[#687bdb] mb-4 border-b pb-2">Daftar Service Center</h3>
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
// Data Lokasi
const serviceLocations = [
    {
        name: "Servis Jaya Abadi",
        address: "Jl. Sudirman No. 123, Jakarta Pusat",
        phone: "021-1234567",
        lat: -6.2088,
        lng: 106.8456,
        hours: "09:00 - 18:00"
    },
    {
        name: "Servis Anggara 20",
        address: "Jl. TB Simatupang No. 45, Jakarta Selatan",
        phone: "021-7654321",
        lat: -6.2897,
        lng: 106.8239,
        hours: "09:00 - 20:00"
    },
    {
        name: "TeknisiABC",
        address: "Jl. Asia Afrika No. 78, Bandung",
        phone: "022-8765432",
        lat: -6.9175,
        lng: 107.6191,
        hours: "08:00 - 17:00"
    },
    {
        name: "Komputer Jaya Abadi",
        address: "Jl. Raya Darmo No. 100, Surabaya",
        phone: "031-5556789",
        lat: -7.2575,
        lng: 112.7521,
        hours: "09:00 - 18:00"
    },
    {
        name: "Medan Ahli Komputer",
        address: "Jl. Gatot Subroto No. 88, Medan",
        phone: "061-4445678",
        lat: 3.5952,
        lng: 98.6722,
        hours: "09:00 - 17:00"
    }
];

let map;
let markers = [];

function initMap() {
    // Inisialisasi Peta 
    map = L.map('map', {
        zoomControl: false 
    }).setView([-6.2088, 106.8456], 11);

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
    const customIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `<div style="background-color: #687bdb; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; color: white;"><i class="fas fa-tools" style="font-size: 14px;"></i></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
    });

    serviceLocations.forEach((loc, index) => {
        const marker = L.marker([loc.lat, loc.lng], { icon: customIcon })
            .addTo(map)
            .bindPopup(createPopupContent(loc));
        
        markers.push(marker);
    });
}

function createPopupContent(loc) {
    return `
        <div style="font-family: 'Poppins', sans-serif;">
            <div style="background: #687bdb; color: white; padding: 12px; font-weight: bold; font-size: 14px;">
                ${loc.name}
            </div>
            <div style="padding: 15px;">
                <p style="margin: 0 0 8px 0; color: #555; font-size: 13px;"><i class="fas fa-map-marker-alt" style="width: 20px; color: #687bdb;"></i> ${loc.address}</p>
                <p style="margin: 0 0 8px 0; color: #555; font-size: 13px;"><i class="fas fa-phone" style="width: 20px; color: #687bdb;"></i> ${loc.phone}</p>
                <p style="margin: 0 0 12px 0; color: #555; font-size: 13px;"><i class="fas fa-clock" style="width: 20px; color: #687bdb;"></i> ${loc.hours}</p>
                <a href="https://www.google.com/maps/dir/?api=1&destination=${loc.lat},${loc.lng}" 
                   target="_blank" 
                   style="display: block; background: #687bdb; color: white; text-align: center; padding: 8px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                   Buka di Google Maps
                </a>
            </div>
        </div>
    `;
}

function populateLocationList() {
    const listContainer = document.getElementById('locationList');
    
    serviceLocations.forEach((loc, index) => {
        const card = document.createElement('div');
        card.className = 'bg-gray-50 rounded-xl p-4 hover:bg-[#eff4ff] hover:shadow-md transition duration-200 cursor-pointer border border-transparent hover:border-[#687bdb]';
        card.onclick = () => focusLocation(index);
        
        card.innerHTML = `
            <div class="flex justify-between items-start">
                <h4 class="font-bold text-gray-800 text-sm">${loc.name}</h4>
                <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Buka</span>
            </div>
            <p class="text-xs text-gray-500 mt-2 line-clamp-2">${loc.address}</p>
            <div class="flex items-center mt-3 gap-3">
                <a href="tel:${loc.phone}" class="text-xs text-[#687bdb] hover:underline flex items-center">
                    <i class="fas fa-phone mr-1"></i> Hubungi
                </a>
                <span class="text-gray-300">|</span>
                <button onclick="focusLocation(${index})" class="text-xs text-[#687bdb] hover:underline flex items-center">
                    <i class="fas fa-map mr-1"></i> Lihat
                </button>
            </div>
        `;
        
        listContainer.appendChild(card);
    });
}

function focusLocation(index) {
    const loc = serviceLocations[index];
    map.flyTo([loc.lat, loc.lng], 15, {
        duration: 1.5
    });
    markers[index].openPopup();
}

document.addEventListener('DOMContentLoaded', initMap);
</script>