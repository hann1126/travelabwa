<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontControler;
use App\Http\Controllers\PackageBankController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PackageTourController;
use App\Http\Controllers\ProfileController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;



Route::get('/', [FrontControler::class,'index'])->name('front.index');
Route::get('/category/{category:slug}', [FrontControler::class,'category'])->name('front.category');
Route::get('/details/{packageTour:slug}', [FrontControler::class,'details'])->name('front.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    route::middleware('can: checkout package')-> group(function() {
        route::get('/book/{packageTour:slug}', [FrontControler::class, 'book'])
        ->name('front.book');

        route::post('/book/save/{packageTour:slug}', [FrontControler::class, 'book_store'])
        ->name('front.book.store');

        route::get('/book/choose-bank/{packageBooking}/', [FrontControler::class, 'choose_bank'])
        ->name('front.choose');

        route::patch('/book/choose-bank{packageBooking}/save', [FrontControler::class, 'choose_bank_store'])
        ->name('front.choose_bank_store');

        route::get('/book/payment/{packageBooking}/', [FrontControler::class, 'book_payment'])
        ->name('front.book_payment');

        route::patch('/book/payment/{packageBooking}/save', [FrontControler::class, 'book_payment_store'])
        ->name('front.book_payment_store');

        route::get('/book-finis', [FrontControler::class, 'book_finis'])
        ->name('front.book_finis');
    });
    
    Route::prefix('dashboard')->name('dashboard.')->group(function(){

        Route::middleware('can:view oreder')->group(function() {
            Route::get('/my-booking', [DashboardController::class, 'my_booking'])
            ->name('bookings');

            Route::get('/my-booking/details/{packageBooking}', [DashboardController::class, 'booking_details'])
            ->name('bookings.details');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        route::middleware('can: manage categories')-> group(function() {
            route::resource('categories', CategoryController::class);
        });

        route::middleware('can: manage categories')-> group(function() {
            route::resource('package_tours', PackageTourController::class);
        });

        route::middleware('can: manage categories')-> group(function() {
            route::resource('package_banks', PackageBankController::class);
        });

        route::middleware('can: manage categories')-> group(function() {
            route::resource('package_bookings', PackageBookingController::class);
        });

    });
});

require __DIR__.'/auth.php';
