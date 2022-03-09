<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

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
    $brands = DB::table('brands')->get();
    return view('home',compact('brands'));
});

Route::get('/home', function () {
    echo "This is Home Page";
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/contact',[ContactController::class,'index'])->name('con');

//Category Controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);

Route::post('/category/update/{id}',[CategoryController::class,'Update']);

Route::get('/softdelete/category/{id}',[CategoryController::class,'SoftDelete']);

Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);

Route::get('/pdelete/category/{id}',[CategoryController::class,'Pdelete']);

//Brand Route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');

Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);

Route::post('/brand/update/{id}',[BrandController::class,'Update']);

Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);

//MultiPics Route

Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');

Route::post('/multi/add',[BrandController::class,'StoreImage'])->name('store.image');


//ADMIN ALL ROUTE
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');

Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');

Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');

Route::get('/slider/edit/{id}',[HomeController::class,'Edit']);

Route::post('/slider/update/{id}',[HomeController::class,'Update']);

Route::get('/slider/delete/{id}',[HomeController::class,'Delete']);

//Home About Route

Route::get('/home/About',[AboutController::class,'HomeAbout'])->name('home.about');

Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');

Route::post('/store/About',[AboutController::class,'StoreAbout'])->name('store.about');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // $users = User::all();
     $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');


Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');
