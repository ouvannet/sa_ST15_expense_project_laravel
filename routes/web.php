<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;





Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('dashboard.index');
})->middleware('auth');


Route::get('/expense', [ExpenseController::class, 'index'])->name('Expense');
Route::get('/category', [CategoryController::class, 'index'])->name('Category');

Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Update a category
Route::put('/category/{id}', [CategoryController::class, 'update']);

// Delete a category
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');










Route::get('/recurring', [RecurringController::class, 'index'])->name('Recurring');
Route::get('/report', [ReportController::class, 'index'])->name('Report');
Route::get('/user', [UserController::class, 'index'])->name('User');
Route::get('/role', [RoleController::class, 'index'])->name('Role');
Route::get('/permission', [PermissionController::class, 'index'])->name('Permission');
Route::get('/department', [DepartmentController::class, 'index'])->name('Department');


















