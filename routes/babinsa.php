<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\PublicActivityController;
use App\Http\Controllers\NaturalDisasterController;

Route::group(['prefix' => 'babinsa', 'as' => 'babinsa.', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\Babinsa\DashboardController::class, 'dashboard']);
    Route::resource('absensi', AttendenceController::class);
    Route::resource('natural-disaster', NaturalDisasterController::class);

    Route::get('public-activity/{id}/delete-attachment', [PublicActivityController::class, 'deleteAttachment'])->name('public-activity.deleteAttachment');
    Route::post('public-activity/update-status', [PublicActivityController::class, 'updateStatus'])->name('public-activity.updateStatus');
    Route::resource('public-activity', PublicActivityController::class);
    ROute::resource('activity', ActivityController::class);

    Route::group(['prefix' => 'keuangan', 'as' => 'keuangan.'], function () {
        Route::resource('operasional', OperasionalController::class);
        Route::resource('pengeluaran', OutcomeController::class);
    });
});