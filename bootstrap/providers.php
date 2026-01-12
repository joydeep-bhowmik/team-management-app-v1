<?php

use Pest\Laravel\PestServiceProvider;
use JoydeepBhowmik\LaravelMediaLibary\Providers\LaravelMediaServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    JoydeepBhowmik\LivewireDatatable\Providers\DataTableServiceProvider::class,
    LaravelMediaServiceProvider::class,
    PestServiceProvider::class,
];
