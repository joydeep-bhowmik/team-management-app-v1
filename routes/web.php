<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

Route::middleware(['auth', 'suspend'])->group(function () {

    Route::get('/test', [TestController::class, '__invoke']);

    require __DIR__ . '/onboading.php';

    Route::middleware(['onboarding', 'employee'])->group(function () {

        Route::view('/attendences/requests', 'pages.AttendenceRequests')->name('attendences.requests');

        Route::view('people', 'pages.people')
            ->name('people');

        Route::view('profile', 'pages.profile')
            ->name('profile');

        Route::view('dashboard', 'pages.dashboard')
            ->name('dashboard');

        Route::view('profile', 'pages.profile')
            ->name('profile');

        Route::view('mynotes', 'pages.notes')
            ->name('notes');

        Route::prefix('leave-applications')->group(function () {

            Route::view('/create', 'pages.save-leave-application')->name('leaveApplications.create');

            Route::view('/all', 'pages.leave-applications')->name('leaveApplications.all');
        });

        Route::prefix('tasks')->group(function () {

            Route::view('/create', 'pages.save-task')->name('tasks.create');

            Route::view('/edit/{id}', 'pages.save-task')->name('tasks.edit');
            Route::view('/all', 'pages.tasks')->name('tasks.all');
            Route::view('/{id}', 'pages.view-task')->name('tasks.view');
        });

        Route::view('/conversations/edit/{id}', 'pages.edit-conversation')->name('conversations.edit');

        Route::view('/employees/{id}', 'pages.view-employee')
            ->name('employees.view');

        Route::view('notifications', 'pages.notifications')->name('notifications');

        Route::prefix('guidelines')->group(function () {

            Route::view('/create', 'pages.save-guideline')->name('guidelines.create');
        });
    });
});
