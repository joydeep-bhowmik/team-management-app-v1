<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    static function admin_pages(): array
    {

        return [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard'
            ]
        ];
    }
}
