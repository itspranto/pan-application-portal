<?php

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
    return view('index');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/pans', 'PanController@index');
Route::get('/pans/apply', 'PanController@create');
Route::post('/pans', 'PanController@store');

Route::get('/pans/insufficient_balance', 'PanController@insufficientBalance');
Route::get('pans/receipt/{pan}', 'PanController@receipt');
Route::get('pans/download/{pan}', 'PanController@download');
Route::post('pans/upload/{pan}', 'PanController@upload');
Route::get('pans/json/showPans', 'PanController@showPans');

Route::get('/transactions', 'TransactionController@index');
Route::get('/transactions/new', 'TransactionController@create');
Route::post('/transactions', 'TransactionController@store');
Route::get('/transactions/json/showTransactions', 'TransactionController@showTransactions');

Route::get('/notifications', 'NotificationController@index');
Route::get('/notifications/{notification}', 'NotificationController@show');
Route::get('/notifications/json/showNotifications', 'NotificationController@showNotifications');

Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return redirect(env('APP_URL'));
    });

    Route::get('/login', 'AdminController@showLoginForm');
    Route::post('/login', 'AdminController@login');

    Route::get('/dashboard', 'AdminController@index');
    Route::get('/logout', 'AdminController@destroy');

    Route::get("/users/{user}", 'AdminController@userInfo');
    Route::get("/users/activate/{user}", 'AdminController@activateUser');
    Route::get("/users/block/{user}", 'AdminController@blockUser');
    Route::post("/users/penalty/{user}", 'AdminController@penaltyUser');
    Route::patch("/users/{user}", 'AdminController@updateUser');

    Route::get("/pans/{pan}", 'AdminController@panInfo');
    Route::post("/pans/upload/{pan}", 'AdminController@uploadPan');
    Route::post("/pans/reject/{pan}", 'AdminController@rejectPan');

    Route::get("/transactions/{transaction}", 'AdminController@transactionInfo');
    Route::post("/transactions/complete/{transaction}", 'AdminController@validateTransaction');
    Route::get("/transactions/reject/{transaction}", 'AdminController@rejectTransaction');

    Route::prefix('/list')->group(function () {
        Route::get("/users/{sorting}", 'AdminController@users');
        Route::get("/pans/{sorting}", 'AdminController@pans');
        Route::get("/transactions/{sorting}", 'AdminController@transactions');
    });

    Route::prefix('/json')->group(function () {
        Route::get('/users/{sorting}', 'AdminController@getUsers');
        Route::get('/pans/{sorting}', 'AdminController@getPans');
        Route::get("/transactions/{sorting}", 'AdminController@getTransactions');
    });

});

