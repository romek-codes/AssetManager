<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'appName' => config('app.name', 'Asset Management'),
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Category Routes

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/search-categories', [CategoryController::class, 'search'])->name('search-categories');
    Route::post('/delete-categories', [CategoryController::class, 'deleteCategories'])->name('delete-categories');

    Route::post('/delete-categories', function (Request $request) {
    })->name('search-categories');

    // Asset Routes
    Route::get('/assets', [AssetController::class, 'index'])->name('assets');

    Route::get('/search-assets', [AssetController::class, 'search'])->name('search-assets');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
