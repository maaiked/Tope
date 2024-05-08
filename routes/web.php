<?php

use App\Http\Controllers\ProfielController;
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
    //profile routes
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/nieuw', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/nieuw', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //profiel routes
    Route::get('/profielnieuw', [ProfielController::class, 'create'])->name('profiel.create');
    Route::post('/profielnieuw', [ProfielController::class, 'store'])->name('profiel.store');
    Route::get('/profiel', [ProfielController::class, 'edit'])->name('profiel.edit');
    Route::put('/profiel', [ProfielController::class, 'update'])->name('profiel.update');


    //activiteit routes
    Route::get('/activiteiten{id?}', [ActiviteitController::class, 'index'])->name('activiteiten.index');
    Route::post('/activiteiten/nieuw', [ActiviteitController::class, 'store'])->name('activiteiten.store');
    Route::get('/activiteiten/{id}', [ActiviteitController::class, 'show'])->name('activiteiten.show');
    Route::post('/activiteiten', [InschrijvingsdetailController::class, 'store'])->name('inschrijvingsdetail.store');

    //kind routes
    Route::get('/kinderen', [KindController::class, 'index'])->name('kinderen.index');
    Route::get('/kinderennieuw', [KindController::class, 'create'])->name('kind.create');
    Route::post('/kinderennieuw', [KindController::class, 'store'])->name('kind.store');
    Route::get('/kind/{id}/edit', [KindController::class, 'edit'])->name('kind.edit');
    Route::put('/kind/{id}', [KindController::class, 'update'])->name('kind.update');

    //inschrijvingsdetails routes
    Route::get('/inschrijvingsdetails', [InschrijvingsdetailController::class, 'index'])->name('inschrijvingsdetails.index');
    Route::get('/inschrijvingsdetails/{id}', [InschrijvingsdetailController::class, 'show'])->name('inschrijvingsdetails.show');
    Route::get('/inschrijvingsdetails/destroy/{id}', [InschrijvingsdetailController::class, 'destroy'])->name('inschrijvingsdetails.destroy');
    //inschrijvingsdetails enkel voor admin - animator
    //TODO:: beveilig zodat enkel admin - animator deze routes kan volgen
    Route::post('/inschrijvingsdetails/activiteit/{id}/inschrijven', [InschrijvingsdetailController::class, 'create'])->name('inschrijvingsdetails.create');
    Route::get('/inschrijvingsdetails/activiteit/{id}', [InschrijvingsdetailController::class, 'indexActiviteit'])->name('inschrijvingsdetails.indexActiviteit');
    Route::get('/inschrijvingsdetails/lijsten/{id}', [InschrijvingsdetailController::class, 'indexLijsten'])->name('inschrijvingsdetails.indexLijsten');
    Route::get('/inschrijvingsdetails/lijsten/{id}/{modus}', [InschrijvingsdetailController::class, 'showLijst'])->name('inschrijvingsdetails.showLijst');
    Route::get('/inschrijvingsdetails/activiteit/{activiteit}/{inschrijving}/{detail}', [InschrijvingsdetailController::class, 'edit'])->name('inschrijvingsdetails.edit');
    Route::post('/inschrijvingsdetails/activiteit/{id}', [KindController::class, 'editAdminAnimatorInfo'])->name('kind.editAdminAnimatorInfo');

});

require __DIR__.'/auth.php';
