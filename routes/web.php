<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LeadRegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('details/{slug}', [FrontendController::class, 'details'])->name('details');


Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');




Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
Route::post('order/confirmation', [FrontendController::class, 'orderConfirm'])->name('order.confirm');
Route::get('/order/success/{abc}',[FrontendController::class,'orderSuccess'])->name('order.success');
Route::post('/review/store',[FrontendController::class,'reviewStore'])->name('review.store');
Route::post('/add/cart',[CartController::class,'cartStore'])->name('add.cart');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('cart-remove/{id}', [CartController::class, 'cartRemove'])->name('cart.remove');
Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

//leadcollect
Route::get('/register',[LeadRegisterController::class,'RegisterCreate'])->name('register.create');
Route::post('/register/store',[LeadRegisterController::class,'RegisterStore'])->name('register.store');
Route::get('/register-done',[LeadRegisterController::class,'RegisterDone'])->name('register.done');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //order
    Route::get('/orders',[OrderController::class,'orders'])->name('orders');
    Route::post('/order/status',[OrderController::class,'orderStatus'])->name('order.status');

    Route::resource('products', ProductController::class);

    
    //profile-setting
    // Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    // Route::post('/profile-baicInfo-change', [ProfileController::class, 'infoUpdate'])->name('info.update');
    // Route::post('/profile-password-update', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');


});

require __DIR__.'/auth.php';
