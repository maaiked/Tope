<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActiviteitController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\InschrijvingsdetailController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //profiel routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //activiteit routes
    Route::get('/activiteiten', [ActiviteitController::class, 'index'])->name('activiteiten.index');
    Route::post('/activiteiten', [ActiviteitController::class, 'store'])->name('activiteiten.store');

    //kind routes
    Route::get('/kinderen', [KindController::class, 'index'])->name('kinderen.index');
    Route::post('/kinderen', [KindController::class, 'store'])->name('kinderen.store');

    //inschrijvingsdetails routes
    Route::get('/inschrijvingsdetails', [InschrijvingsdetailController::class, 'index'])->name('inschrijvingsdetails.index');
    Route::post('/inschrijvingsdetails', [InschrijvingsdetailsController::class, 'store'])->name('inschrijvingsdetails.store');

});

require __DIR__.'/auth.php';
