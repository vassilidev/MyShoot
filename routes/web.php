<?php

use App\Http\Controllers\Panel\Datatables\PeopleDataTablesController;
use App\Http\Controllers\Panel\Datatables\RoleDataTablesController;
use App\Http\Controllers\Panel\Datatables\ShootingDataTablesController;
use App\Http\Controllers\Panel\ImportPeopleController;
use App\Http\Controllers\Panel\PeopleController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\ShootingController;
use Illuminate\Support\Facades\Route;

//There is no front-end, feel free to build your own !
Route::redirect('/', 'login');

//All your dashboard's routes going to be here.
Route::group([
    'as'         => 'panel.',
    'middleware' => [
        'verified',
    ],
], static function () {
    Route::get('/test', function () {
        $user = \App\Models\People::find(121)->first();

        dump($user->getAvatar());
    });

    Route::resource('people', PeopleController::class);
    Route::resource('shooting', ShootingController::class);
    Route::resource('role', RoleController::class);

    Route::post('/people/importPeople', ImportPeopleController::class)->name('people.importPeople');

    Route::group([
        'as'     => 'datatables.',
        'prefix' => 'datatables',
    ], static function () {
        Route::get('/people', [PeopleDataTablesController::class, 'index'])->name('people');
        Route::get('/shooting', [ShootingDataTablesController::class, 'index'])->name('shooting');
        Route::get('/shooting/{shooting}/people', [ShootingDataTablesController::class, 'people'])->name('shooting.people');
        Route::get('/role', [RoleDataTablesController::class, 'index'])->name('role');
    });
});
