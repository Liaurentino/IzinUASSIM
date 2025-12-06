<!-- Halaman Find Us (Pencarian Lokasi/Map) -->
<div class="flex justify-center items-center h-full">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-w-4xl transition duration-300 min-h-[60vh] flex flex-col space-y-6">
        <h2 class="text-3xl font-bold text-primary-blue text-center mb-4">Temukan Lokasi Service Kami</h2>
        
        <div class="w-full h-80 bg-gray-300 rounded-xl overflow-hidden shadow-lg border border-gray-400">
            <!-- Placeholder Map. Untuk implementasi nyata, ganti dengan iframe Google Maps atau integrasi API Map lainnya. -->
            <img src="https://placehold.co/800x320/845EFD/ffffff?text=Peta+Lokasi+Mitra+Servify" alt="Peta Lokasi" class="w-full h-full object-cover">
        </div>
        
        <p class="text-center text-gray-700">Saat ini, Anda dapat menemukan Mitra Servify di kota-kota besar Indonesia. Silakan gunakan fitur pencarian di bawah ini untuk mencari mitra terdekat Anda.</p>
        
        <!-- Search and Filter Bar -->
        <div class="flex items-center space-x-4">
            <div class="flex-grow flex items-center bg-white border border-gray-300 rounded-xl shadow-inner overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <input type="text" placeholder="Cari berdasarkan kota atau nama mitra..." class="w-full px-4 py-3 focus:outline-none text-text-dark">
            </div>
            <button class="bg-primary-blue text-white p-3 rounded-xl shadow-lg hover:bg-opacity-90 transition duration-300">
                Cari
            </button>
        </div>
        
        <!-- Daftar Mitra Terdekat (Contoh) -->
        <div class="space-y-3 pt-4">
            <h3 class="text-xl font-bold text-secondary-purple">Mitra Terdekat (Contoh Data)</h3>
            <ul class="bg-white p-4 rounded-xl shadow-md border border-gray-200 divide-y divide-gray-100">
                <li class="py-2">Servify Center Jakarta - Jl. Jend. Sudirman No. 10</li>
                <li class="py-2">Mitra Repair Surabaya - Ruko Grand City Blok B-5</li>
                <li class="py-2">Laptop Fix Bandung - Jl. Asia Afrika No. 45</li>
            </ul>
        </div>
    </div>
</div>