</div>
</main>

<!-- Footer -->
<footer class="w-full bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-500">
                &copy; <?= date('Y') ?> Servify Merchant Dashboard. All rights reserved.
            </p>
            <div class="flex items-center space-x-4 text-sm text-gray-500">
                <a href="<?= base_url('/') ?>" class="hover:text-primary-blue">Kembali ke Beranda</a>
                <span>•</span>
                <a href="#" class="hover:text-primary-blue">Bantuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Mobile Menu Toggle
    document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
        alert('Mobile menu - implement sesuai kebutuhan');
    });
</script>

</body>
</html>