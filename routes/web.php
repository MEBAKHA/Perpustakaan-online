<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN & REGISTER)
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest');

Route::get('/registration', [LoginController::class, 'registration'])
    ->middleware('guest');

Route::post('/registration', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| HALL / BOOKS
|--------------------------------------------------------------------------
*/

Route::get('/hall', [HallController::class, 'index'])->name('hall');
Route::get('/hall/book/{book:slug}', [HallController::class, 'singleBook']);

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
// PROFILE SENDIRI
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

// 🔥 AUTH ACTIONS (HARUS DI ATAS)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // FOLLOW
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
});

// 🔹 PROFILE ORANG LAIN (PALING BAWAH)
Route::get('/profile/{username}', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->where('username', '^(?!edit$)[A-Za-z0-9_]+');

// 🔹 FOLLOWERS (WAJIB ADA)
Route::get('/profile/{username}/followers', [ProfileController::class, 'followers'])
    ->name('followers');

Route::get('/profile/{username}/following', [ProfileController::class, 'following'])
    ->name('following');
/*    
|--------------------------------------------------------------------------
| BORROW
|--------------------------------------------------------------------------
*/

Route::post('/borrow', [BorrowController::class, 'store']);

Route::get('/borrows/{user:slug}', [BorrowController::class, 'userBorrows'])
    ->middleware('auth')
    ->name('borrows');

Route::get('/borrow/detail/{borrow}', [BorrowController::class, 'detail'])
    ->middleware('auth');
/*    
|--------------------------------------------------------------------------
| Story
|--------------------------------------------------------------------------
*/
    Route::middleware('auth')->group(function () {
        Route::get('/story/create', [BookController::class, 'create'])->name('story.create');
        Route::post('/story', [BookController::class, 'store'])->name('story.store');
    });

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search-suggestions', [BookController::class, 'suggestions']);

/*
|--------------------------------------------------------------------------
| DASHBOARD (ADMIN)
|--------------------------------------------------------------------------
*/

Route::prefix('dashboard')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard.dashboard', ["title" => 'Dashboard']);
        })->name('dashboard');

        // Category
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::post('/category', [CategoryController::class, 'store']);
        Route::get('/category/{category:slug}/edit', [CategoryController::class, 'edit']);
        Route::put('/category/{category:slug}', [CategoryController::class, 'update']);
        Route::delete('/category/{category:slug}', [CategoryController::class, 'delete']);

        // Resources
        Route::resource('author', AuthorController::class);
        Route::resource('user', UserController::class);
        Route::resource('book', BookController::class);

        // Borrow admin
        Route::get('/borrow', [BorrowController::class, 'index']);
        Route::get('/borrow/{borrow}/edit', [BorrowController::class, 'edit']);
        Route::put('/borrow/{borrow}', [BorrowController::class, 'update']);
        Route::delete('/borrow/{borrow}', [BorrowController::class, 'destroy']);
});