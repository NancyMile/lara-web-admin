<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Events\Logout;
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
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin all route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin.logout','destroy')->name('admin.logout');
    Route::get('/admin.profile','profile')->name('admin.profile');
    Route::get('edit/profile','edit')->name('edit.profile');
    Route::post('store/profile','store')->name('store.profile');
    Route::get('change/password','changePassword')->name('change.password');
    Route::post('update/password','updatePassword')->name('update.password');
});

//home slider all route
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('home/slider','homeSlider')->name('home.slide');
    Route::post('update/slider','updateSlider')->name('update.slide');
});

//about page all route
Route::controller(AboutController::class)->group(function(){
    Route::get('about/page','aboutPage')->name('about.page');
    Route::post('update/about','updateAbout')->name('update.about');
    Route::get('about','homeAbout')->name('home.about'); //frontend
});

require __DIR__.'/auth.php';
