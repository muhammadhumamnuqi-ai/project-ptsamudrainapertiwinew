<?php

if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $base = getenv('APP_STORAGE_TMP') ?: '/tmp';

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
        $storageRoot = getenv('FILESYSTEM_PUBLIC_ROOT') ?: "$base/storage/app/public";
        $realRoot = realpath($storageRoot);

        if ($realRoot) {
            $filePath = realpath($realRoot . '/' . $relativePath);

            if ($filePath && str_starts_with($filePath, $realRoot . DIRECTORY_SEPARATOR) && is_file($filePath)) {
                $mimeTypes = [
                    'pdf' => 'application/pdf',
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ];
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $mime = $mimeTypes[$ext] ?? 'application/octet-stream';

                header('Content-Type: ' . $mime);
                header('Content-Length: ' . filesize($filePath));
                header('Cache-Control: public, max-age=3600');
                readfile($filePath);
                exit;
            }
        }
    }
}

require __DIR__ . '/../public/index.php';
