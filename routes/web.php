<?php

use App\Http\Controllers\BetalingsdetailController;
use App\Http\Controllers\ProfielController;
use App\Http\Controllers\UitpasController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActiviteitController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\InschrijvingsdetailController;
use App\Http\Controllers\LocatieController;

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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {

    //Dashboard routes
    Route::get('/dashboard', [TextController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [TextController::class, 'store'])->name('text.store');

    //profile routes
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/nieuw', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/nieuw', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/updateAdmin', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //profiel routes
    Route::get('/profielen', [ProfielController::class, 'index'])->name('profiel.index');
    Route::get('/profielnieuw', [ProfielController::class, 'create'])->name('profiel.create');
    Route::post('/profielnieuw', [ProfielController::class, 'store'])->name('profiel.store');
    Route::get('/profiel', [ProfielController::class, 'edit'])->name('profiel.edit');
    Route::put('/profiel', [ProfielController::class, 'update'])->name('profiel.update');
    Route::get('/profiel/{id}', [ProfielController::class, 'editById'])->name('profiel.editById');
    Route::put('/profiel/{id}', [ProfielController::class, 'updateById'])->name('profiel.updateById');

    //activiteit routes
    Route::get('/activiteiten{id?}', [ActiviteitController::class, 'index'])->name('activiteiten.index');
    Route::get('/activiteiten/nieuw', [ActiviteitController::class, 'create'])->name('activiteiten.create');
    Route::post('/activiteiten/nieuw', [ActiviteitController::class, 'store'])->name('activiteiten.store');
    Route::get('/activiteiten/{id}/edit', [ActiviteitController::class, 'edit'])->name('activiteiten.edit');
    Route::put('/activiteiten/{id}', [ActiviteitController::class, 'update'])->name('activiteiten.update');
    Route::get('/activiteiten/{id}', [ActiviteitController::class, 'show'])->name('activiteiten.show');
    Route::put('/activiteiten/{id}/addKind', [ActiviteitController::class, 'updateAddKind'])->name('activiteiten.updateAddKind');
    Route::get('/activiteiten/{id}/addKind', [ActiviteitController::class, 'showAddKind'])->name('activiteiten.showAddKind');
    Route::get('/activiteiten/{id}/kinderen', [ActiviteitController::class, 'showKinderen'])->name('activiteiten.showKinderen');
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
    Route::get('/inschrijvingsdetails/ziekenfonds/{id}', [InschrijvingsdetailController::class, 'ziekenfondsattest'])->name('inschrijvingsdetails.ziekenfondsattest');


    //inschrijvingsdetails enkel voor admin - animator
    //TODO:: beveilig zodat enkel admin - animator deze routes kan volgen
    Route::post('/inschrijvingsdetails/activiteit/{id}/inschrijven', [InschrijvingsdetailController::class, 'create'])->name('inschrijvingsdetails.create');
    Route::get('/inschrijvingsdetails/activiteit/{id}', [InschrijvingsdetailController::class, 'indexActiviteit'])->name('inschrijvingsdetails.indexActiviteit');
    Route::get('/inschrijvingsdetails/lijsten/{id}', [InschrijvingsdetailController::class, 'indexLijsten'])->name('inschrijvingsdetails.indexLijsten');
    Route::get('/inschrijvingsdetails/lijsten/{id}/{modus}', [InschrijvingsdetailController::class, 'showLijst'])->name('inschrijvingsdetails.showLijst');
    Route::get('/inschrijvingsdetails/activiteit/{activiteit}/{inschrijving}/{detail}', [InschrijvingsdetailController::class, 'edit'])->name('inschrijvingsdetails.edit');
    Route::post('/inschrijvingsdetails/activiteit/{id}', [KindController::class, 'editAdminAnimatorInfo'])->name('kind.editAdminAnimatorInfo');

    //betalingsdetail routes
    Route::post('/inschrijvingsdetails/activiteit/betaling/{id}', [BetalingsdetailController::class, 'store'])->name('betaling.store');

    //uitpas routes
    Route::get('/uitpas', [UitpasController::class, 'index'])->name('uitpas.index');
    Route::post('/uitpas/set', [UitpasController::class, 'store'])->name('uitpas.store');
    Route::get('/uitpas/token', [UitpasController::class, 'buttonCreate'])->name('uitpas.buttonCreate');
    Route::get('/uitpas/edit', [UitpasController::class, 'edit'])->name('uitpas.edit');
    Route::post('/uitpas/edit', [UitpasController::class, 'update'])->name('uitpas.update');

    //locatie routes
    Route::resource('locatie', LocatieController::class);




    /*
    Route::get('locatie', [LocatieController::class, 'index'])->name('locatie.index');
    Route::get('locatie/create', [LocatieController::class, 'create'])->name('locatie.create');
    Route::post('locatie', [LocatieController::class, 'store'])->name('locatie.store');
    Route::get('locatie/{locatie}', [LocatieController::class, 'show'])->name('locatie.show');
    Route::get('locatie/{locatie}/edit', [LocatieController::class, 'edit'])->name('locatie.edit');
    Route::put('locatie/{locatie}', [LocatieController::class, 'update'])->name('locatie.update');
    Route::delete('locatie/{locatie}', [LocatieController::class, 'destroy'])->name('locatie.destroy');
    */

});

require __DIR__.'/auth.php';
