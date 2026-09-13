<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$profile = App\Models\Profile::first();
if($profile) {
    echo "Profile found!\n";
    echo "Logo field: " . ($profile->logo ?? 'NULL') . "\n";
    echo "Logo URL: " . $profile->logo_url . "\n";
    echo "Nama sekolah: " . ($profile->nama_sekolah ?? 'NULL') . "\n";
} else {
    echo "No profile found\n";
}
