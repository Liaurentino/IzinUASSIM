<!-- Find Us Page dengan OpenStreetMap -->
<div class="max-w-7xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-text-dark mb-4">Temukan Lokasi Kami</h1>
        <p class="text-gray-600">Cari service center Servify terdekat dari lokasi Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Map Container -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div id="map" class="w-full h-[600px]"></div>
            </div>
        </div>

        <!-- Location List -->
        <div class="space-y-4">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-text-dark mb-4">Service Centers</h3>
                <div id="locationList" class="space-y-3">
                    <!-- Locations will be dynamically added here -->
                </div>
            </div>

           

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// Service Center Locations
const serviceLocations = [
    {
        name: "Servify Jakarta Pusat",
        address: "Jl. Sudirman No. 123, Jakarta Pusat",
        phone: "021-1234567",
        lat: -6.2088,
        lng: 106.8456,
        hours: "09:00 - 18:00"
    },
    {
        name: "Servify Jakarta Selatan",
        address: "Jl. TB Simatupang No. 45, Jakarta Selatan",
        phone: "021-7654321",
        lat: -6.2897,
        lng: 106.8239,
        hours: "09:00 - 18:00"
    },
    {
        name: "Servify Bandung",
        address: "Jl. Asia Afrika No. 78, Bandung",
        phone: "022-8765432",
        lat: -6.9175,
        lng: 107.6191,
        hours: "09:00 - 18:00"
    },
    {
        name: "Servify Surabaya",
        address: "Jl. Raya Darmo No. 100, Surabaya",
        phone: "031-5556789",
        lat: -7.2575,
        lng: 112.7521,
        hours: "09:00 - 18:00"
    },
    {
        name: "Servify Medan",
        address: "Jl. Gatot Subroto No. 88, Medan",
        phone: "061-4445678",
        lat: 3.5952,
        lng: 98.6722,
        hours: "09:00 - 18:00"
    }
];

let map;
let markers = [];
let userMarker;

// Initialize Map
function initMap() {
    // Default center (Jakarta)
    map = L.map('map').setView([-6.2088, 106.8456], 12);

    // OpenStreetMap tiles (FREE!)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Add service center markers
    addServiceMarkers();
    
    // Populate location list
    populateLocationList();
}

// Add markers for all service centers
function addServiceMarkers() {
    const icon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    serviceLocations.forEach(location => {
        const marker = L.marker([location.lat, location.lng], { icon: icon })
            .addTo(map)
            .bindPopup(`
                <div class="p-2">
                    <h4 class="font-bold text-primary-blue">${location.name}</h4>
                    <p class="text-sm text-gray-600 mt-1">${location.address}</p>
                    <p class="text-sm text-gray-600">📞 ${location.phone}</p>
                    <p class="text-sm text-gray-600">🕒 ${location.hours}</p>
                    <a href="https://www.openstreetmap.org/directions?from=&to=${location.lat},${location.lng}" 
                       target="_blank" 
                       class="inline-block mt-2 text-xs bg-primary-blue text-white px-3 py-1 rounded">
                        Dapatkan Arah
                    </a>
                </div>
            `);
        
        markers.push(marker);
    });
}

// Populate location list sidebar
function populateLocationList() {
    const listContainer = document.getElementById('locationList');
    
    serviceLocations.forEach((location, index) => {
        const card = document.createElement('div');
        card.className = 'bg-gray-50 rounded-xl p-4 hover:shadow-md transition duration-200 cursor-pointer';
        card.onclick = () => focusLocation(index);
        
        card.innerHTML = `
            <h4 class="font-bold text-text-dark">${location.name}</h4>
            <p class="text-sm text-gray-600 mt-1">${location.address}</p>
            <p class="text-xs text-gray-500 mt-1">📞 ${location.phone}</p>
            <p class="text-xs text-gray-500">🕒 ${location.hours}</p>
        `;
        
        listContainer.appendChild(card);
    });
}


// Find nearest service center
function findNearestLocation(userLat, userLng) {
    let nearestDistance = Infinity;
    let nearestIndex = 0;
    
    serviceLocations.forEach((location, index) => {
        const distance = calculateDistance(userLat, userLng, location.lat, location.lng);
        if (distance < nearestDistance) {
            nearestDistance = distance;
            nearestIndex = index;
        }
    });
    
    const nearest = serviceLocations[nearestIndex];
    alert(`Service center terdekat:\n${nearest.name}\n${nearest.address}\nJarak: ${nearestDistance.toFixed(2)} km`);
    
    // Highlight nearest location
    focusLocation(nearestIndex);
}

// Calculate distance using Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Earth radius in km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon/2) * Math.sin(dLon/2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', initMap);
</script>

<style>
/* Leaflet popup custom styling */
.leaflet-popup-content-wrapper {
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.leaflet-popup-content {
    margin: 8px;
}
</style>