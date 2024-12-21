<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\CronController;

Route::get('/', function () {
    return view('login');
});

Route::get('future', [ScriptController::class, 'future']);
Route::get('test', [ScriptController::class, 'test']);

Route::get('fetchequities', [CronController::class, 'fetequities']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'api'], function () {
        Route::get('fetch-stock-data/{id}', [ApiController::class, 'fetchStockData']);
        Route::get('fetchstockinfo/{stocktype}', [ApiController::class, 'fetchstockinfo'])->name('fetchstockinfo');





    });


    Route::get('wallet', [ProfileController::class, 'wallet']);
    Route::get('portfolio', [ProfileController::class, 'portfolio'])->name('portfolio');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::POST('change-password', [ProfileController::class, 'changePassword']);
    Route::post('update-profile', [ProfileController::class, 'updateProfile']);
    Route::get('logout', [ProfileController::class, 'logout'])->name('logout');





    Route::get('/nifty50', [StockController::class, 'nifty'])->name('nifty');
    Route::get('/sensex', [StockController::class, 'sensex'])->name('sensex');
    Route::get('/stocks/{slug}/{id}', [StockController::class, 'niftyInner'])->name('nifty-inner');
    Route::get('/fetch-stock-data/{id}', [StockController::class, 'fetchStockData']);
    Route::get('/fetch-nifty50-stock-data', [StockController::class, 'fetchNifty50StockData']);
    Route::get('/fetch-sensex-stock-data', [StockController::class, 'fetchSensexStockData']);
    Route::get('orders', [StockController::class, 'orderHistory'])->name('order');
    Route::get('watchlist', [StockController::class, 'watchlist'])->name('watchlist');


    Route::get('admin/home',[AdminController::class, 'home'])->name('admin_home');
    Route::get('admin/add-user',[AdminController::class, 'add_user'])->name('admin_add_user');
    Route::post('admin/add-user',[AdminController::class, 'addUser'])->name("add-user-post");
    Route::get('admin/add-admin',[AdminController::class, 'add_admin'])->name('admin_add_admin');
    Route::post('admin/add-admin',[AdminController::class, 'addAdmin'])->name("add-admin-post");
    Route::get('admin/all-admin',[AdminController::class, 'allAdmin'])->name("all-admin");
    Route::get('admin/all-user',[AdminController::class, 'allUser'])->name("all-user");
    Route::get('admin/user/{id}',[AdminController::class, 'user'])->name("user");
    Route::post('admin/approve-deposit', [AdminController::class, 'approveDeposit'])->name('approve-deposit');
Route::post('admin/approve-withdraw', [AdminController::class, 'approveWithdraw'])->name('approve-withdraw');
    Route::get('admin/deposit-txn', [AdminController::class, 'depositTxn'])->name('deposit_txn');
    Route::get('admin/withdraw-txn', [AdminController::class, 'withdrawTxn'])->name('withdraw_txn');
    

    Route::post('/payment-link', [PaymentController::class, 'generatePaymentLink'])->name('payment-link');
    Route::get('deposit', [PaymentController::class, 'deposit'])->name('deposit');
    Route::get('recharge/{txn_id}', [PaymentController::class, 'recharge'])->name('recharge');
    Route::post('/upload-ref', [PaymentController::class, 'uploadRef'])->name('uploadRef');
    Route::get('withdraw', [PaymentController::class, 'withdraw'])->name('withdraw');
    Route::post('withdrawRef', [PaymentController::class, 'withdrawRef'])->name('withdrawRef');
    Route::get('bank-details', [PaymentController::class, 'bankDetails'])->name('bank-details');
    Route::post('bank-update', [PaymentController::class, 'updateBankDetails'])->name('update-bank-details');



});





require __DIR__.'/auth.php';
