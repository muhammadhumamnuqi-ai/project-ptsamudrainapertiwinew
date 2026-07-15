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
