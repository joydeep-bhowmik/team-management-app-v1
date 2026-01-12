<?php

use App\Http\Middleware\RedirectToDashboardIfOnboardingDone;
use Illuminate\Support\Facades\Route;

Route::prefix('onboarding', 'suspend')->middleware(RedirectToDashboardIfOnboardingDone::class)->group(function () {

    Route::get('/', function () {
        return redirect(auth()->user()->onboarding()->nextUnfinishedStep()->link);
    })->name('onboarding');

    Route::view('basic', 'pages.onboarding.basic')->name('onboarding.basic');

    Route::view('bank-details', 'pages.onboarding.bank-details')->name('onboarding.bank-details');

    Route::view('documents', 'pages.onboarding.documents')->name('onboarding.documents');

    Route::view('address', 'pages.onboarding.address')->name('onboarding.address');

    Route::view('guardian-information', 'pages.onboarding.guardian-Info')->name('onboarding.guardian-info');
});
