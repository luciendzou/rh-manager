<?php

use App\Http\Controllers\AdminNavigationController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', function () {
    return view('welcome');
})->name('login');


Route::post('/login-process', [AuthController::class, 'Login'])->name('login-process');


Route::middleware(['auth'])->group(function () {

    Route::get('/', [AdminNavigationController::class, 'Dashboard'])->name('admin');
    Route::get('/admin', [AdminNavigationController::class, 'Dashboard'])->name('admin');
    Route::get('/admin/add-user', [AdminNavigationController::class, 'AddUser'])->name('add-user');
    Route::get('/admin/list-users', [AdminNavigationController::class, 'ListUser'])->name('list-user');
    Route::get('/admin/data-attendence/{start}/{end}', [AdminNavigationController::class, 'DataAttendence']);
    Route::get('/admin/data-month/{id}', [AdminNavigationController::class, 'DataMonth']);
    Route::get('/admin/export-pdf-data-month/{id}', [AdminNavigationController::class, 'DataMonthPdf']);

    Route::post('/admin/adding-user/', [AuthController::class, 'AddingUser']);
    Route::get('/logout', [AuthController::class, 'Logout']);

});




Route::get('/list-users', function () {
    return view('pages.users.list_users');
});
Route::get('/card-users', function () {
    return view('pages.users.cart_members');
});
Route::get('/grant-loans', function () {
    return view('pages.loans.grant_loans');
});
Route::get('/generate-deadlines', function () {
    return view('pages.loans.generate_deadline');
});
Route::get('/send-money', function () {
    return view('pages.loans.send_money');
});
