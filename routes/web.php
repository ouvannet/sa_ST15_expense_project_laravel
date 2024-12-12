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



//This are all the routes for expense;
Route::get('/expense', [ExpenseController::class, 'index'])->name('Expense');
Route::post('/expense', [ExpenseController::class, 'add'])->name('Expense.add');
Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name('Expense.edit');
Route::put('/expense/{id}', [ExpenseController::class, 'update']);
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('Expense.destroy');







//This are all the routes for category;
Route::get('/category', [CategoryController::class, 'index'])->name('Category');
Route::post('/category', [CategoryController::class, 'add'])->name('category.add');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');




Route::get('/recurring', [RecurringController::class, 'index'])->name('Recurring');
Route::get('/report', [ReportController::class, 'index'])->name('Report');
Route::get('/user', [UserController::class, 'index'])->name('User');
Route::get('/role', [RoleController::class, 'index'])->name('Role');
Route::get('/permission', [PermissionController::class, 'index'])->name('Permission');




//This are all the routes for department;
Route::get('/department', [DepartmentController::class, 'index'])->name('Department');
Route::post('/department', [DepartmentController::class, 'add'])->name('department.add');
Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/department/{id}', [DepartmentController::class, 'update']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
















