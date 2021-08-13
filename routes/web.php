<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\basecontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\productbookingcontroller;

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

//Route::get('/', function () {
  //  return view('welcome');
//});
route::get('/',[basecontroller::class,'home']);
route::get('home',[basecontroller::class,'home'])->name('home');
route::get('specialoffer',[basecontroller::class,'specialoffer'])->name('specialoffer');
route::get('contact',[basecontroller::class,'contact'])->name('contact');
route::get('delivery',[basecontroller::class,'delivery'])->name('delivery');
route::get('cart',[basecontroller::class,'cart'])->name('cart');
route::get('productview/{id}',[basecontroller::class,'productview'])->name('productview');
route::get('/admin/login',[admincontroller::class,'login'])->name('admin.login');
route::post('/admin/login',[admincontroller::class,'makelogin'])->name('admin.makelogin');
route::get('/cart/delete',[cartController::class,'destroy'])->name('cart.delete');
route::post('/cart/booking',[productbookingController::class,'store'])->name('product.booking');
route::get('product/bookingsuccess',[productbookingController::class,'bookingsuccess'])->name('product.bookingsuccess');
route::get('product/bookingfail',[productbookingController::class,'bookingfail'])->name('product.bookingfail');


route::group(['middleware'=>'auth'],function()
{
  route::get('/admin/dashboard',[admincontroller::class,'dashboard'])->name('admin.dashboard');
  route::get('/admin/logout',[admincontroller::class,'logout'])->name('admin.logout');
  route::get('/category/add',[CategoryController::class,'create'])->name('category.add');
  route::post('/category/add',[CategoryController::class,'store'])->name('category.store');
  route::get('/category',[CategoryController::class,'index'])->name('category.index');
  route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
  route::post('/category/edit/{id}',[CategoryController::class,'update'])->name('category.update');
  route::post('/category/delete',[CategoryController::class,'delete'])->name('category.delete');
  route::get('admin/users',[usercontroller::class,'index'])->name('admin.users');
  route::get('admin/users',[usercontroller::class,'index'])->name('admin.users');
  route::post('admin/delete',[usercontroller::class,'delete'])->name('user.delete');
  route::get('admin/bookinglist',[productbookingController::class,'index'])->name('admin.bookinglist');
  route::get('admin/bookingDelete',[productbookingController::class,'destroy'])->name('booking.delete');


// product routes
route::get('/product',[ProductController::class,'index'])->name('product.list');
route::get('/product/create',[ProductController::class,'create'])->name('product.create');
route::post('/product/create',[ProductController::class,'store'])->name('product.store');
route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
route::post('/product/edit/{id}',[ProductController::class,'update'])->name('product.update');
route::post('/product/delete',[ProductController::class,'destroy'])->name('product.delete');
route::get('/product/detail/{id}',[ProductController::class,'extradetail'])->name('product.extradetail');
route::post('/product/detail/{id}',[ProductController::class,'extradetailstore'])->name('product.extradetailstore');

});
route::get('user/login',[basecontroller::class,'userlogin'])->name('user_login');
route::post('user/login',[basecontroller::class,'user_store'])->name('user_store');
route::post('user/checkin',[basecontroller::class,'user_check'])->name('user_check');
route::get('user/logout',[basecontroller::class,'user_logout'])->name('user_logout');
route::post('user/cart',[cartcontroller::class,'store'])->name('cart.store');
