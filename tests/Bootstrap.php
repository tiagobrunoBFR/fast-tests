<?php

use Illuminate\Contracts\Console\Kernel;

$app = require __DIR__.'/../bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

\Illuminate\Support\Facades\Artisan::call('migrate:fresh');
