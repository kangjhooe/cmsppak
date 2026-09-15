<?php
/**
 * Siapkan paket deploy untuk shared hosting (document root = public_html).
 * Output: folder deploy-public-html/ — upload SELURUH isinya ke public_html.
 *
 * Usage: php tools/prepare-public-html-deploy.php
 */

declare(strict_types=1);

$root = dirname(__DIR__);
$dest = $root . DIRECTORY_SEPARATOR . 'deploy-public-html';

echo "=== Prepare public_html deploy package ===\n";
echo "Source: {$root}\n";
echo "Dest:   {$dest}\n\n";

if (! is_file($root . '/public/build/manifest.json')) {
    fwrite(STDERR, "ERROR: public/build belum ada. Jalankan: npm run build\n");
    exit(1);
}

if (! is_dir($root . '/vendor')) {
    fwrite(STDERR, "ERROR: vendor/ belum ada. Jalankan: composer install --no-dev\n");
    exit(1);
}

// Reset destination
if (is_dir($dest)) {
    echo "Menghapus paket lama...\n";
    removeDirectory($dest);
}
mkdir($dest, 0755, true);

$excludeDirs = [
    '.cursor',
    '.git',
    '.playwright-mcp',
    'deploy-public-html',
    'node_modules',
    'tests',
    'tools',
    'public', // isi dipindah ke root paket
];

$excludeFiles = [
    '.env',
    '.env.backup',
    '.env.production',
    '.phpunit.result.cache',
    'phpunit.xml',
    'auth.json',
    'env-local-mysql.txt',
    'package.json',
    'package-lock.json',
    'vite.config.js',
    'postcss.config.js',
    'tailwind.config.js',
    '.htaccess-security',
    'deploy-public-html.zip',
];

$excludePrefixes = [
    'Homestead',
    'DEPLOYMENT',
    'CHECKLIST-DEPLOYMENT',
    'FILE-YANG-TIDAK',
    'FIX-',
    'PANDUAN-',
    'QUICK-DEPLOY',
    'SETUP-MYSQL',
    'MIGRATION-',
    'INSTALL',
    'README',
    'setup-cms',
    'start-cms',
    'deploy-to-hosting',
    'pre-deployment',
    'prepare-deployment',
    'fix-hosting',
    'fix_logo',
    'fix_alamat',
    'clear_alamat',
    'check_profile',
    'favicon-preview',
];

echo "1. Menyalin file aplikasi (tanpa public/, node_modules, .git)...\n";
copyTree($root, $dest, $excludeDirs, $excludeFiles, $excludePrefixes, $root);

echo "2. Menyalin isi public/ ke root paket...\n";
copyPublicAssets($root . '/public', $dest);

echo "3. Menulis index.php (path flatten)...\n";
$index = file_get_contents($root . '/public/index.php');
$index = str_replace("__DIR__.'/../", "__DIR__.'/", $index);
file_put_contents($dest . '/index.php', $index);

echo "4. Menulis .htaccess (rewrite + keamanan)...\n";
file_put_contents($dest . '/.htaccess', buildHtaccess());

echo "5. Menyiapkan .env template...\n";
$envSrc = is_file($root . '/env-hosting-template.txt')
    ? $root . '/env-hosting-template.txt'
    : $root . '/.env.example';
copy($envSrc, $dest . '/.env.example');
copy($envSrc, $dest . '/env-hosting-template.txt');

echo "6. Membersihkan storage runtime di paket...\n";
cleanStorageRuntime($dest . '/storage');

echo "7. Menulis BACA-SAYA-UPLOAD.txt...\n";
file_put_contents($dest . '/BACA-SAYA-UPLOAD.txt', buildReadme());

echo "\n=== SELESAI ===\n";
echo "Upload SEMUA isi folder deploy-public-html/ ke public_html hosting.\n";
echo "Jangan upload folder deploy-public-html itu sendiri — upload isinya.\n";
echo "Ikuti BACA-SAYA-UPLOAD.txt setelah upload.\n";

function copyTree(
    string $src,
    string $dst,
    array $excludeDirs,
    array $excludeFiles,
    array $excludePrefixes,
    string $root
): void {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $path = $item->getPathname();
        $rel = substr($path, strlen($root) + 1);
        $relUnix = str_replace('\\', '/', $rel);
        $parts = explode('/', $relUnix);
        $top = $parts[0] ?? '';

        if (in_array($top, $excludeDirs, true)) {
            continue;
        }
        if (in_array(basename($relUnix), $excludeFiles, true) && count($parts) === 1) {
            continue;
        }
        foreach ($excludePrefixes as $prefix) {
            if (str_starts_with(basename($relUnix), $prefix)) {
                continue 2;
            }
        }
        // Skip logs and local sqlite
        if (preg_match('#^storage/logs/.+\.log$#', $relUnix)) {
            continue;
        }
        if (preg_match('#^database/.+\.sqlite$#', $relUnix)) {
            continue;
        }

        $target = $dst . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relUnix);

        if ($item->isDir()) {
            if (! is_dir($target)) {
                mkdir($target, 0755, true);
            }
            continue;
        }

        // Skip junctions/symlinks that would conflict (e.g. weird links)
        if ($item->isLink()) {
            continue;
        }

        $dir = dirname($target);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        copy($path, $target);
    }
}

function copyPublicAssets(string $publicDir, string $dest): void {
    $skip = ['.', '..', 'index.php', 'storage', 'hot'];
    foreach (scandir($publicDir) as $name) {
        if (in_array($name, $skip, true)) {
            continue;
        }
        $from = $publicDir . DIRECTORY_SEPARATOR . $name;
        $to = $dest . DIRECTORY_SEPARATOR . $name;
        if (is_dir($from) && ! is_link($from)) {
            copyDirectory($from, $to);
        } elseif (is_file($from)) {
            copy($from, $to);
        }
    }
}

function copyDirectory(string $src, string $dst): void {
    if (! is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($iterator as $item) {
        $target = $dst . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            if (! is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            $dir = dirname($target);
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            copy($item->getPathname(), $target);
        }
    }
}

function cleanStorageRuntime(string $storage): void {
    $keepDirs = [
        'app/public',
        'app/private',
        'framework/cache/data',
        'framework/sessions',
        'framework/views',
        'framework/testing',
        'logs',
    ];
    foreach ($keepDirs as $rel) {
        $path = $storage . '/' . $rel;
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
        ensureGitkeep($path);
    }

    // Empty compiled views / cache files but keep folders
    foreach (['framework/views', 'framework/cache/data', 'framework/sessions', 'logs'] as $rel) {
        $path = $storage . '/' . $rel;
        if (! is_dir($path)) {
            continue;
        }
        foreach (new DirectoryIterator($path) as $file) {
            if ($file->isDot() || $file->getFilename() === '.gitignore') {
                continue;
            }
            if ($file->isFile()) {
                unlink($file->getPathname());
            }
        }
        ensureGitkeep($path);
    }
}

function ensureGitkeep(string $dir): void {
    $keep = $dir . '/.gitignore';
    if (! is_file($keep)) {
        file_put_contents($keep, "*\n!.gitignore\n");
    }
}

function removeDirectory(string $dir): void {
    if (! is_dir($dir)) {
        return;
    }
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($iterator as $item) {
        if ($item->isDir()) {
            @rmdir($item->getPathname());
        } else {
            @unlink($item->getPathname());
        }
    }
    @rmdir($dir);
}

function buildHtaccess(): string {
    return <<<'HTACCESS'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Authorization / CSRF headers (Laravel)
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Block sensitive files
    RewriteRule ^(\.env|composer\.(json|lock)|artisan|phpunit\.xml)(/|$) - [F,L]

    # Block sensitive directories (storage/app/public dilayani lewat rewrite di bawah)
    RewriteRule ^(app|bootstrap|config|database|resources|routes|vendor|tests)(/|$) - [F,L]

    # Public disk tanpa symlink: /storage/* -> storage/app/public/*
    RewriteRule ^storage/app/public/ - [L]
    RewriteCond %{DOCUMENT_ROOT}/storage/app/public/$1 -f
    RewriteRule ^storage/(.+)$ storage/app/public/$1 [L]
    RewriteRule ^storage/ - [F,L]

    # Redirect trailing slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Front controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options SAMEORIGIN
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

<FilesMatch "^\.">
    <IfModule mod_authz_core.c>
        Require all denied
    </IfModule>
    <IfModule !mod_authz_core.c>
        Order allow,deny
        Deny from all
    </IfModule>
</FilesMatch>
HTACCESS;
}

function buildReadme(): string {
    return <<<'TXT'
UPLOAD KE public_html
====================

1. Upload SEMUA isi folder ini ke public_html (bukan folder deploy-public-html-nya).
2. Rename env-hosting-template.txt menjadi .env (atau copy ke .env).
3. Edit .env: APP_URL, DB_*, MAIL_* sesuai hosting.
4. Di SSH / Terminal hosting (jika ada):
     php artisan key:generate
     chmod -R 775 storage bootstrap/cache
     php artisan migrate --force
     php artisan config:cache
     php artisan route:cache
     php artisan view:cache
5. JANGAN jalankan php artisan storage:link
   File publik dilayani lewat .htaccess: /storage/* -> storage/app/public/*
6. Pastikan PHP >= 8.2 dan ekstensi: openssl, pdo_mysql, mbstring, tokenizer, xml, ctype, json, fileinfo, gd/imagick.

Tanpa SSH:
- Generate APP_KEY di lokal (`php artisan key:generate --show`) lalu tempel ke .env hosting.
- Import database via phpMyAdmin.
- Set permission storage/ dan bootstrap/cache/ via File Manager (775).

Setelah live: ganti password admin default.
TXT;
}
