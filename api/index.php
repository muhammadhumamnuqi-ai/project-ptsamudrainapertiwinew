<?php

define('LARAVEL_START', microtime(true));

$isVercel = isset($_ENV['VERCEL']) || getenv('VERCEL');

if ($isVercel) {
    $base = '/tmp';
    $dirs = [
        "$base/storage/app/public",
        "$base/framework/views",
        "$base/framework/cache/data",
        "$base/framework/sessions",
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $staticMappings = [
        '/build/' => '/public/build/',
        '/images/' => '/public/images/',
    ];

    foreach ($staticMappings as $prefix => $dir) {
        if (str_starts_with($uri, $prefix)) {
            $relativePath = substr($uri, strlen($prefix) - 1);
            $filePath = realpath(__DIR__ . '/..' . $dir . $relativePath);
            $realDir = realpath(__DIR__ . '/..' . $dir);
            if ($filePath && $realDir && str_starts_with($filePath, $realDir) && is_file($filePath)) {
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $mimeTypes = [
                    'css' => 'text/css',
                    'js' => 'application/javascript',
                    'json' => 'application/json',
                    'png' => 'image/png',
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'gif' => 'image/gif',
                    'svg' => 'image/svg+xml',
                    'ico' => 'image/x-icon',
                    'woff' => 'font/woff',
                    'woff2' => 'font/woff2',
                    'txt' => 'text/plain',
                    'pdf' => 'application/pdf',
                ];
                header('Content-Type: ' . ($mimeTypes[$ext] ?? 'application/octet-stream'));
                header('Content-Length: ' . filesize($filePath));
                header('Cache-Control: public, max-age=31536000, immutable');
                readfile($filePath);
                exit;
            }
        }
    }

    $staticRootFiles = ['/favicon.ico' => '/public/favicon.ico', '/robots.txt' => '/public/robots.txt'];
    if (isset($staticRootFiles[$uri])) {
        $filePath = realpath(__DIR__ . '/..' . $staticRootFiles[$uri]);
        if ($filePath && is_file($filePath)) {
            header('Content-Type: mime_content_type($filePath)');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        }
    }

    if (str_starts_with($uri, '/storage/')) {
        $relativePath = substr($uri, strlen('/storage/'));
        $storageRoot = '/tmp/storage/app/public';
        if (is_dir($storageRoot)) {
            $filePath = realpath($storageRoot . '/' . $relativePath);
            if ($filePath && str_starts_with($filePath, realpath($storageRoot) . DIRECTORY_SEPARATOR) && is_file($filePath)) {
                $mimeTypes = ['pdf' => 'application/pdf', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png'];
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                header('Content-Type: ' . ($mimeTypes[$ext] ?? 'application/octet-stream'));
                header('Content-Length: ' . filesize($filePath));
                header('Cache-Control: public, max-age=3600');
                readfile($filePath);
                exit;
            }
        }
    }

    chdir(__DIR__ . '/..');
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString();
}
