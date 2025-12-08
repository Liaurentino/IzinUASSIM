<!-- Menu Navigasi USER BIASA-->
<div class="space-x-8 hidden md:flex text-text-dark font-medium">
    <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
    <a href="<?= base_url('marketplace') ?>" class="nav-link">Marketplace</a>
    <a href="<?= base_url('reservation') ?>" class="nav-link">Reservation</a>
    <a href="<?= base_url('chatbot') ?>" class="nav-link">Chatbot</a>
    <a href="<?= base_url('findus') ?>" class="nav-link">Find Us</a>
    
    <?php if ($session->get('isLoggedIn')): ?>
        <?php if ($session->get('role') === 'merchant' && strtolower($session->get('merchant_status')) === 'approved'): ?>
            <!-- JIKA SUDAH MERCHANT -> REDIRECT KE DASHBOARD -->
            <a href="<?= base_url('merchant/dashboard') ?>" class="nav-link text-secondary-purple font-bold">
                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
            </a>
        <?php elseif (strtolower($session->get('merchant_status')) === 'pending'): ?>
            <a href="<?= base_url('merchant/waiting') ?>" class="nav-link text-yellow-600 font-bold">
                <i class="fas fa-clock mr-1"></i> Status Pengajuan
            </a>
        <?php else: ?>
            <!-- USER BIASA -> KE REGISTRASI MERCHANT -->
            <a href="<?= base_url('merchant/register') ?>" class="nav-link">Jadi Mitra</a>
        <?php endif; ?>
    <?php else: ?>
        <!-- GUEST -> KE INFO MERCHANT -->
        <a href="<?= base_url('merchant') ?>" class="nav-link">Merchant</a>
    <?php endif; ?>
    
    <!-- Auth Links -->
    <?php if ($session->get('isLoggedIn')): ?>
        <a href="<?= base_url('logout') ?>" class="text-red-500 font-semibold hover:text-red-700">
            Logout (<?= esc($session->get('user_name')) ?>)
        </a>
    <?php else: ?>
        <a href="<?= base_url('login') ?>" class="nav-link text-primary-blue font-semibold">Login</a>
    <?php endif; ?>
</div>