<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\IndexController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
// 	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::get('/billing', [DashboardController::class, 'billing'])->name('admin.billing');
    

Route::get('/checkout-process/{id}', [IndexController::class, 'checkout_process'])->name('checkout_process');
Route::post('/submit-checkout-process', [IndexController::class, 'submit_checkout_process'])->name('submit_checkout_process');
Route::get('/thankyou/{id}', [IndexController::class, 'thankyou'])->name('thankyou');
Route::get('/admin/login', [IndexController::class, 'sign_in'])->name('admin.login');

Route::group(['middleware' => ['auth'],'prefix'=>'admin'], function () { 
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/billing', [DashboardController::class, 'billing'])->name('admin.billing');
    Route::get('/order', [DashboardController::class, 'order'])->name('admin.order');
    Route::get('/order/delete/{id}', [DashboardController::class, 'order_delete'])->name('admin.order.destroy');
     
    Route::get('/create-order', [DashboardController::class, 'create_order'])->name('admin.create.order');
    Route::get('/order-details/{id}', [DashboardController::class, 'order_details'])->name('admin.order.details');
    Route::post('/submit-order', [DashboardController::class, 'submit_order'])->name('admin.submit.order');
    Route::post('/update-order', [DashboardController::class, 'update_order'])->name('admin.update.order');
    
    Route::resource('brand', BrandController::class);
    
});

// Route::group(['middleware' => ['auth'],'prefix'=>'admin','namespace'=>'admin'], function () {
    
//     // Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
//     // Route::get('/rtl', [DashboardController::class, 'rtl'])->name('rtl');
//     // Route::get('/tables', [DashboardController::class, 'tables'])->name('tables');
//     // Route::get('/virtual-reality', [DashboardController::class, 'virtual_reality'])->name('virtual_reality');
// });



