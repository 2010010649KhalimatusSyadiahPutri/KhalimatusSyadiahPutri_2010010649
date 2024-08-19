<?php

use App\Http\Controllers\Babinsa\DashboardController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('laporan/cetak-gabungan', [LaporanController::class, 'cetakGabungan'])->name('admin.cetakGabungan');

 Route::get('/login', function () {
    return view('login');
 }) ->name('login');

 Route::post('/login', function (){
    $credentials = request(['email','password']);
    if(Auth::attempt($credentials)) {
        return redirect()->intended('/dashboard');
    }

    return redirect()->back()->withErrors(['email' => 'Invalide credentials']);
 });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/danramil.php';
require __DIR__.'/babinsa.php';
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';