<?php
// Web Routes

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Storage link utility
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Article search
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');

// Public articles index
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->where('article', '[0-9]+')->name('articles.show');


// About Us page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->where('article', '[0-9]+')->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->where('article', '[0-9]+')->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->where('article', '[0-9]+')->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->where('article', '[0-9]+')->name('articles.destroy');
});

require __DIR__.'/auth.php';
