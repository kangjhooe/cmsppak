<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'admin@alfalahkrui.sch.id')->first();

if ($user) {
    print_r($user->toArray());
} else {
    echo "User not found\n";
}

