<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class,'redirect']);

Route::get('/',[HomeController::class,'index']);

Route::get('/product',[AdminController::class,'product']);

Route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

Route::get('/showproduct',[AdminController::class,'showproduct']);

Route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

Route::get('/updateview/{id}',[AdminController::class,'updateview']);

Route::post('/updateproduct/{id}',[AdminController::class,'updateproduct']);

Route::get('/search',[HomeController::class,'search']);

Route::post('/addcart/{id}',[HomeController::class,'addcart']);

Route::get('/showcart',[HomeController::class,'showcart']);

Route::get('/delete/{id}',[HomeController::class,'deletecart']);

Route::post('/order',[HomeController::class,'confirmorder']);

Route::get('/registerseniorform',[HomeController::class,'registerseniorform']);
Route::post('/registersenior',[HomeController::class,'registersenior']);


Route::get('/loginchoice',[HomeController::class,'loginchoice']);

Route::get('/seniorloginform',[HomeController::class,'seniorloginform']);

Route::post('/seniorlogin',[HomeController::class,'seniorlogin']);

Route::get('/seniorlogout',[HomeController::class,'seniorlogout']);

Route::get('/seniorhome',[HomeController::class,'seniorhome']);

Route::get('/showsenior',[HomeController::class,'showsenior']);

Route::get('/updateseniorform/{senior_id}',[HomeController::class,'updateseniorform']);

Route::post('/updatesenior/{senior_id}',[HomeController::class,'updatesenior']);

Route::get('/deletesenior/{senior_id}',[HomeController::class,'deletesenior']);

Route::get('/addcreditform/{senior_id}',[HomeController::class,'addcreditform']);

Route::post('/addcredit/{senior_id}',[HomeController::class,'addcredit']);

Route::post('/changequantity/{cartproduct_id}',[HomeController::class,'changequantity']);

Route::get('/deletecartproduct/{cartproduct_id}',[HomeController::class,'deletecartproduct']);


Route::post('/confirmcart',[HomeController::class,'confirmcart']);

Route::get('/allproducts',[HomeController::class,'allproducts']);




