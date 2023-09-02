<?php

use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('directories')->name('directory.')->controller(DirectoryController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/{id}/show', 'show')->where(['id' => '[0-9]+'])->name('show');

    Route::match(['get', 'post'], '/new', 'create')->name('create');

    Route::match(['get', 'post'], '/{id}/edit', 'edit')->where(['id' => '[0-9]+'])->name('edit');

    Route::delete('/{id}', 'delete')->where(['id' => '[0-9]+'])->name('delete');
});
