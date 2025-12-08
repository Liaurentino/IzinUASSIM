<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Servify</a>

        <?php if (session()->get('isLoggedIn') && session()->get('role') === 'merchant') : ?>
            <a class="btn btn-sm btn-outline-primary ms-2 fw-bold" href="<?= base_url('merchant/dashboard') ?>">
                <i class="fas fa-store"></i> Merchant Dashboard
            </a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                </li>

                <li class="nav-item">
                    <?php if (session()->get('role') === 'merchant') : ?>
                        <a class="nav-link fw-bold text-primary" href="<?= base_url('merchant/dashboard') ?>">
                            Kelola Toko
                        </a>
                    <?php elseif (session()->get('merchant_status') === 'pending') : ?>
                        <a class="nav-link" href="<?= base_url('merchant/waiting') ?>">Status Pengajuan</a>
                    <?php else : ?>
                        <a class="nav-link" href="<?= base_url('merchant/register') ?>">Jadi Mitra</a>
                    <?php endif; ?>
                </li>

                <?php if (session()->get('isLoggedIn')) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Hai, <?= esc(session()->get('user_name')) ?> 
                            <?php if(session()->get('role') === 'merchant'): ?>
                                <span class="badge bg-success">Merchant</span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (session()->get('role') === 'admin') : ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">Admin Panel</a></li>
                            <?php endif; ?>
                            
                            <?php if (session()->get('role') === 'merchant') : ?>
                                <li><a class="dropdown-item" href="<?= base_url('merchant/dashboard') ?>">Dashboard Toko</a></li>
                            <?php endif; ?>

                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-3" href="<?= base_url('login') ?>">Login</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>