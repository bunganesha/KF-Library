<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/PostLogin', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['middleware' => ['isAdmin']], function () {

    Route::get('/permission', [PermissionController::class, 'index']);
    Route::get('/permission/create', [PermissionController::class, 'create']);
    Route::post('/permission/save', [PermissionController::class, 'store']);
    Route::get('/permission/{id}/edit', [PermissionController::class, 'show']);
    Route::post('/permission/{id}/update', [PermissionController::class, 'update']);
    Route::get('/permission/{id}/delete', [PermissionController::class, 'destroy']);

    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/role/create', [RoleController::class, 'create']);
    Route::post('/role/save', [RoleController::class, 'store']);
    Route::get('/role/{id}/edit', [RoleController::class, 'show']);
    Route::post('/role/{id}/update', [RoleController::class, 'update']);
    Route::get('/role/{id}/delete', [RoleController::class, 'destroy']);
    Route::get('/role/{id}/add-permission', [RoleController::class, 'addPermissionToRole']);
    Route::post('/role/{id}/give-permission', [RoleController::class, 'givePermissionToRole']);

    Route::get('/employee', [EmployeeController::class, 'index']);
    Route::get('/employee/create', [EmployeeController::class, 'create']);
    Route::post('/employee/save', [EmployeeController::class, 'store']);
    Route::get('/employee/{id}/edit', [EmployeeController::class, 'show']);
    Route::post('/employee/{id}/update', [EmployeeController::class, 'update']);
    Route::get('/employee/{id}/delete', [EmployeeController::class, 'destroy']);

    Route::get('/book', [BookController::class, 'index']);
    Route::get('/book/create', [BookController::class, 'create']);
    Route::post('/book/save', [BookController::class, 'store']);
    Route::get('/book/{id}/edit', [BookController::class, 'show']);
    Route::post('/book/{id}/update', [BookController::class, 'update']);
    Route::get('/book/{id}/delete', [BookController::class, 'destroy']);
    Route::get('/category', [CategoryController::class, 'index']);

    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/save', [CategoryController::class, 'store']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'show']);
    Route::post('/category/{id}/update', [CategoryController::class, 'update']);
    Route::get('/category/{id}/delete', [CategoryController::class, 'destroy']);

    Route::get('/shelf', [ShelfController::class, 'index']);
    Route::get('/shelf/create', [ShelfController::class, 'create']);
    Route::post('/shelf/save', [ShelfController::class, 'store']);
    Route::get('/shelf/{id}/edit', [ShelfController::class, 'show']);
    Route::post('/shelf/{id}/update', [ShelfController::class, 'update']);
    Route::get('/shelf/{id}/delete', [ShelfController::class, 'destroy']);

    Route::get('/lending', [LendingController::class, 'index']);
    Route::get('/lending/create', [LendingController::class, 'create']);
    Route::post('/lending/save', [LendingController::class, 'store']);
    Route::get('/lending/{id}/delete', [LendingController::class, 'destroy']);
});

Route::get('/lending/status/{id}', [LendingController::class, 'status']);
Route::get('/lending/status/{id}', [LendingController::class, 'status']);
