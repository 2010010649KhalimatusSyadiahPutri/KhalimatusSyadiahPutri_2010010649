<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\AssignmentAreaController;
use App\Http\Controllers\InComingLetterController;
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\PublicActivityController;
use App\Http\Controllers\NaturalDisasterController;
use App\Http\Controllers\OfficerFacilityController;
use App\Http\Controllers\OutComingLetterController;
use App\Http\Controllers\PendataanKegiatanController;
use App\Models\PendataanKegiatan;

Route::group(['prefix' => 'danramil', 'as' => 'danramil.', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\Danramil\DashboardController::class, 'dashboard']);
    Route::resource('absensi', AttendenceController::class);
    
    Route::resource('anggota', UserController::class);
    Route::resource('assignment-area', AssignmentAreaController::class);
    Route::resource('facility-officer', OfficerFacilityController::class);

    Route::get('incoming-letter/{id}/delete-attachment', [InComingLetterController::class, 'deleteAttachment'])->name('incoming-letter.deleteAttachment');
    Route::post('incoming-letter/add-attachment', [IncomingLetterController::class, 'addAttachment'])->name('incoming-letter.addAttachment');
    Route::resource('incoming-letter', InComingLetterController::class);

    Route::resource('outcoming-letter', OutComingLetterController::class);

    // babinsa
    Route::resource('natural-disaster', NaturalDisasterController::class);

    Route::get('public-activity/{id}/delete-attachment', [PublicActivityController::class, 'deleteAttachment'])->name('public-activity.deleteAttachment');
    Route::post('public-activity/update-status', [PublicActivityController::class, 'updateStatus'])->name('public-activity.updateStatus');
    Route::resource('public-activity', PublicActivityController::class);
    Route::resource('activity', ActivityController::class);

    Route::resource('pendataan-kegiatan', PendataanKegiatanController::class);
    Route::resource('kegiatan-public', KegiatanPublikController::class);

    Route::group(['prefix' => 'keuangan', 'as' => 'keuangan.'], function () {
        Route::resource('operasional', OperasionalController::class);
        Route::resource('pengeluaran', OutcomeController::class);
    });
});