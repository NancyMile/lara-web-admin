<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin all route
Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin.logout','destroy')->name('admin.logout');
        Route::get('/admin.profile','profile')->name('admin.profile');
        Route::get('edit/profile','edit')->name('edit.profile');
        Route::post('store/profile','store')->name('store.profile');
        Route::get('change/password','changePassword')->name('change.password');
        Route::post('update/password','updatePassword')->name('update.password');
    });
});

//home slider all route
Route::middleware(['auth'])->group(function () {
    Route::controller(HomeSliderController::class)->group(function(){
        Route::get('/','homeMain')->name('home');
        Route::get('home/slider','homeSlider')->name('home.slide');
        Route::post('update/slider','updateSlider')->name('update.slide');
    });
});

//about page all route
Route::middleware(['auth'])->group(function () {
    Route::controller(AboutController::class)->group(function(){
        Route::get('about/page','aboutPage')->name('about.page');
        Route::post('update/about','updateAbout')->name('update.about');
        Route::get('about','homeAbout')->name('home.about'); //frontend
        Route::get('about/multi/image','aboutMultiImage')->name('about.multi.image'); //frontend
        Route::post('store/multi/images','storeMultiImages')->name('store.multi.image');//admin backend
        Route::get('all/multi/image','allMultiImage')->name('all.multi.image'); //admin backend theme
        Route::get('edit/multi/image/{id}','editMultiImage')->name('edit.multi.image'); //admin backend theme
        Route::post('update/multi/image','updateMultiImage')->name('update.multi.image'); //admin backend theme
        Route::get('delete/multi/image/{id}','deleteMultiImage')->name('delete.multi.image'); //admin backend theme
    });
});
//portfolio all route
Route::middleware(['auth'])->group(function () {
    Route::controller(PortfolioController::class)->group(function(){
        Route::get('portfolio','allPortfolio')->name('all.portfolio');
        Route::get('add/portfolio','addPortfolio')->name('add.portfolio');
        Route::post('store/portfolio','storePortfolio')->name('store.portfolio'); //admin backend
        Route::get('edit/portfolio/{id}','editPortfolio')->name('edit.portfolio'); //admin backend
        Route::post('update/portfolio','updatePortfolio')->name('update.portfolio'); //admin backend
        Route::get('delete/multi/image/{id}','deletePortfolio')->name('delete.portfolio'); //admin backend theme
        Route::get('portfolio/details/{id}','detailsPortfolio')->name('portfolio.details'); //frontend
        Route::get('all/portfolio','homePortfolio')->name('home.portfolio'); //frontend
    });
});

//BlogCategory all route
Route::middleware(['auth'])->group(function () {
    Route::controller(BlogCategoryController::class)->group(function(){
        Route::get('all/blog/category','allBlogCategory')->name('all.blog.category'); //admin backend
        Route::get('add/blog/category','addBlogCategory')->name('add.blog.category'); //admin backend
        Route::post('store/blog/category','storeBlogCategory')->name('store.blog.category'); //admin backend
        Route::get('edit/blog/category/{id}','editBlogCategory')->name('edit.blog.category'); //admin backend
        Route::post('update/blog/category/{id}','updateBlogCategory')->name('update.blog.category'); //admin backend
        Route::get('delete/blog/category/{id}','deleteBlogCategory')->name('delete.blog.category'); //admin backend
    });
});

//Blog all route
Route::middleware(['auth'])->group(function () {
    Route::controller(BlogController::class)->group(function(){
        Route::get('all/blog','allBlog')->name('all.blog'); //admin backend
        Route::get('add/blog','addBlog')->name('add.blog'); //admin backend
        Route::post('store/blog','storeBlog')->name('store.blog'); //admin backend
        Route::get('edit/blog/{id}','editBlog')->name('edit.blog'); //admin backend
        Route::post('update/blog/{id}','updateBlog')->name('update.blog'); //admin backend
        Route::get('delete/blog/{id}','deleteBlog')->name('delete.blog'); //admin backend
        Route::get('blog/details/{id}','detailsBlog')->name('blog.details'); //frontend
        Route::get('category/blog/{id}','categoryBlog')->name('category.blog'); //frontend
        Route::get('blog','homeBlog')->name('home.blog'); //frontend
    });
});

//footer all route
Route::middleware(['auth'])->group(function () {
    Route::controller(FooterController::class)->group(function(){
        Route::get('footer/setup','footerSetup')->name('footer.setup'); //admin backend
        Route::post('update/footer','updateFooter')->name('update.footer'); //admin backend
    });
});

//contact all route
Route::middleware(['auth'])->group(function () {
    Route::controller(ContactController::class)->group(function(){
        Route::get('contact','contact')->name('contact.me'); //frontend
        Route::post('store/contact','storeContact')->name('store.contact'); //frontend
        Route::get('contact/messages','contactMessages')->name('contact.messages'); //backend
        Route::get('delete/contact/{id}','deleteContact')->name('delete.contact'); //admin backend
    });
});


require __DIR__.'/auth.php';
