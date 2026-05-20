<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\peopleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
    ->middleware('auth')
    ->name('profile.self');


// EDIT PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // FOLLOW
    Route::post('/follow/{id}', [FollowController::class, 'follow'])
        ->name('follow');

    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])
        ->name('unfollow');
});


// PROFILE ORANG
// Pastikan followers/following didefinisikan sebelum route pengguna umum
Route::get('/profile/{username}/followers', [ProfileController::class, 'followers'])
    ->name('followers');

Route::get('/profile/{username}/following', [ProfileController::class, 'following'])
    ->name('following');

Route::get('/profile/{username}', [ProfileController::class, 'show'])
    ->name('profile');
/*    
|--------------------------------------------------------------------------
| BORROW
|--------------------------------------------------------------------------
*/

Route::post('/borrow', [BorrowController::class, 'store']);

Route::get('/borrows', [BorrowController::class, 'feed'])
    ->middleware('auth')
    ->name('borrows.feed');

Route::get('/borrows/{user:slug}', [BorrowController::class, 'userBorrows'])
    ->middleware('auth')
    ->name('borrows');

Route::delete('/borrow/{borrow}/cancel', [BorrowController::class, 'cancel'])
    ->middleware('auth')
    ->name('borrow.cancel');

Route::post('/borrow/{borrow}/comment', [BorrowController::class, 'comment'])
    ->middleware('auth')
    ->name('borrow.comment');

Route::get('/borrow/detail/{borrow}', [BorrowController::class, 'detail'])
    ->middleware('auth')
    ->name('borrow.detail');
/*    
|--------------------------------------------------------------------------
| Story
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/story/create', [BookController::class, 'create'])->name('story.create');
    Route::get('/story/{book:slug}/edit', [BookController::class, 'edit'])->name('story.edit');
    Route::delete('/story/{book:slug}', [BookController::class, 'destroy'])->name('story.destroy');
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
        | Tampilan People
        |--------------------------------------------------------------------------
        
        */

Route::get('/people', [peopleController::class, 'index'])
    ->name('people');
    


    //repost
 

   Route::get('/books/{book}/repost', function ($book) {
        return redirect()->back();
    });

    Route::post('/books/{book}/repost', [BookController::class, 'repost'])
        ->middleware('auth');
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
        Route::resource('user', UserController::class);
        Route::resource('book', BookController::class);

        // Borrow admin
        Route::get('/borrow', [BorrowController::class, 'index']);
        Route::get('/borrow/{borrow}/edit', [BorrowController::class, 'edit']);
        Route::put('/borrow/{borrow}', [BorrowController::class, 'update']);
        Route::delete('/borrow/{borrow}', [BorrowController::class, 'destroy']);
    });

// Halaman pemberitahuan untuk verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Handler untuk memproses link verifikasi yang diklik user
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Mengirim ulang link verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Contoh rute yang hanya bisa diakses setelah verifikasi
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);
