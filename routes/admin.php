<?php

use Illuminate\Support\Facades\Route;


Route::prefix('attendences')->group(function () {


    Route::get('/create', function () {
        if (auth()->user()->hasDesignation('frontdesk') || auth()->user()->isAdmin()) {
            return view('pages.save-attendence');
        }
        abort(403, 'Unauthorized');
    })->name('attendences.create');
});


Route::middleware('admin')->group(function () {



    Route::prefix('designations')->group(function () {

        Route::view('/all', 'pages.designations')->name('designations');

        Route::view('create', 'pages.save-designation')->name('designations.create');

        Route::view('edit/{id}', 'pages.save-designation')->name('designations.edit');
    });

    Route::prefix('employees')->group(function () {

        Route::view('/all', 'pages.employees')->name('employees.all');

        Route::view('edit/{id}', 'pages.save-employee')->name('employees.edit');

        Route::view('/create', 'pages.save-employee')->name('employees.create');
    });


    Route::prefix('attendences')->group(function () {


        Route::view('/all', 'pages.attendences')->name('attendences.all');

        Route::view('/edit/{id}', 'pages.save-attendence')->name('attendences.edit');
    });

    Route::prefix('events')->group(function () {


        Route::view('/all', 'pages.events')->name('events.all');

        Route::view('/create', 'pages.save-event')->name('events.create');

        Route::view('/edit/{id}', 'pages.save-event')->name('events.edit');
    });
});
