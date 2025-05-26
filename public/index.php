<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    // Force HTTPS si nécessaire
    if ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '' === 'https') {
        $_SERVER['HTTPS'] = 'on';
    }

    // Configure les proxies de confiance (nginx-proxy)
    Request::setTrustedProxies(
        [$_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'],
        Request::HEADER_X_FORWARDED_ALL
    );

    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
