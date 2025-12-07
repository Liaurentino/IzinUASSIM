<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
// Impor filter buatan Anda
use App\Filters\MerchantAuthFilter; 
use App\Filters\AdminAuthFilter; // Asumsi Anda membuat filter AdminAuthFilter

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'merchantAuth'  => MerchantAuthFilter::class, // Filter Merchant Anda
        'adminAuth'     => AdminAuthFilter::class,   // Filter Admin baru
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * pattern of URL segments.
     */
    public array $modules = [];

    /**
     * List of filter aliases that should run on any specific
     * route, or any incoming request to a controller method.
     * The asterisk (*) allows an entire controller to be filtered,
     * typically inner controllers within the concept of a module.
     */
    public array $filters = [
        // Filter untuk Dashboard Merchant (hanya untuk role 'merchant' dan status 'approved')
        'merchantAuth' => [
            'before' => [
                'merchantdashboard',
                'merchantdashboard/*',
                'merchant/products',
                'merchant/reservation',
                'merchant/statistic',
                // Tambahkan rute merchant lainnya di sini
            ],
        ],
        // Filter untuk Dashboard Admin (hanya untuk role 'admin')
        'adminAuth' => [
            'before' => [
                'admin',
                'admin/*',
            ],
        ],
    ];
}