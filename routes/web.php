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

Route::get('/home',[HomeController::class,'home']);

Route::get('/about',[HomeController::class,'about']);

Route::get('/aboutsenior',[HomeController::class,'aboutsenior']);

Route::get('/product',[AdminController::class,'product']);

Route::get('/orders',[AdminController::class,'orders']);

Route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

Route::get('/showproduct',[AdminController::class,'showproduct']);

Route::get('/updateorder/{id}',[AdminController::class,'updateorder']);

Route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

Route::get('/updateview/{id}',[AdminController::class,'updateview']);

Route::post('/updateproduct/{id}',[AdminController::class,'updateproduct']);

Route::get('/search',[HomeController::class,'search']);

Route::get('/searchsenior',[HomeController::class,'searchsenior']);

Route::post('/addcart/{id}',[HomeController::class,'addcart']);

Route::get('/showcart',[HomeController::class,'showcart']);

Route::get('/delete/{id}',[HomeController::class,'deletecart']);


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

Route::get('/allproductsuser',[HomeController::class,'allproductsuser']);

Route::get('/showseniororders/{senior_id}',[HomeController::class,'showseniororders']);

Route::get('/showorder/{id}',[HomeController::class,'showorder']);

Route::get('/showorderandconfirm/{id}',[HomeController::class,'showorderandconfirm']);

Route::get('/deleteorderproduct/{orderproduct_id}',[HomeController::class,'deleteorderproduct']);

Route::post('/confirmorder/{order_id}',[HomeController::class,'confirmorder']);

Route::get('/subcategoryuser/{subcategory_id}',[HomeController::class,'subcategoryuser']);

Route::get('/categoryuser/{category_id}',[HomeController::class,'categoryuser']);

Route::get('/categorysenior/{category_id}',[HomeController::class,'categorysenior']);

Route::get('/subcategorysenior/{category_id}',[HomeController::class,'subcategorysenior']);
 
Route::get('/choosecategory',[HomeController::class,'choosecategory']);

Route::get('/choosecategoryuser',[HomeController::class,'choosecategoryuser']);

Route::get('/choosesubcategory/{category_id}',[HomeController::class,'choosesubcategory']);

Route::get('/choosesubcategoryuser/{category_id}',[HomeController::class,'choosesubcategoryuser']);

Route::get('/products/{subcategory_id}',[HomeController::class,'products']);

Route::get('/productsuser/{subcategory_id}',[HomeController::class,'productsuser']);









