<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(
    function (): void {
        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index')->name('products-list');
            Route::get('product-create', 'create')->name('product-create');
            Route::post('product-store', 'store')->name('product-store');
            Route::get('product-edit/{id}', 'edit')->name('product-edit');
            Route::post('product-update/{id}', 'update')->name('product-update');
            Route::post('product-delete/{id}', 'delete')->name('product-delete');
            Route::get('product-toggle-status/{id}', 'toggleStatus')->name('product-toggle-status');
        });

        Route::controller(CategoryController::class)->group(
            function () {
                Route::get('get-parent-categories', 'getParentCategories')->name('get-parent-categories');
            }
        );
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
