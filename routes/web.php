<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\RecurringReportController;
use App\Http\Controllers\PaymentReportController;



use App\Http\Controllers\Auth\LoginController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/', function () {
//     return view('dashboard.index');
// })->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->name('Dashboard')->middleware('auth');


//This are all the routes for expense;
Route::get('/expense', [ExpenseController::class, 'index'])->name('Expense');
Route::post('/expense', [ExpenseController::class, 'add'])->name('Expense.add');
Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name('Expense.edit');
Route::put('/expense/{id}', [ExpenseController::class, 'update'])->name('Expense.update');
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('Expense.destroy');
Route::put('/expense/{id}/status', [ExpenseController::class, 'updateStatus']);


Route::get('/expense/{id}', [ExpenseController::class, 'showUseBalance'])->name('expense.show');
Route::post('/expense/{id}/use', [ExpenseController::class, 'useBalance'])->name('expense.use');

Route::get('expense/preview/{id}',[ExpenseController::class, 'preview'])->name('expense.previewHtml');




//This are all the routes for category;


Route::get('/category', [CategoryController::class, 'index'])->name('Category');
Route::get('/category_add', [CategoryController::class, 'add'])->name('category.add');
Route::post('/category_add', [CategoryController::class, 'submit_add'])->name('category.submit_add');

Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');



Route::get('/recurring', [RecurringController::class, 'index'])->name('Recurring');
Route::get('/recurring_add', [RecurringController::class, 'add'])->name('Recurring.add');
Route::post('/recurring_submit_add', [RecurringController::class, 'submit_add'])->name('recurring.submit_add');
Route::get('/recurring/{id}/edit', [RecurringController::class, 'edit'])->name('recurring.edit');
Route::put('/recurring', [RecurringController::class, 'update']);
Route::delete('/recurring/{id}', [RecurringController::class, 'destroy'])->name('recurring.destroy');



Route::get('/expense_report', [ExpenseReportController::class, 'index'])->name('Expense_report');
Route::get('/recurring_report', [RecurringReportController::class, 'index'])->name('Recurring_report');
Route::get('/payment_report', [PaymentReportController::class, 'index'])->name('Payment_report');






//This are all the routes for department;


Route::get('/department', [DepartmentController::class, 'index'])->name('Department');
Route::get('/department_add', [DepartmentController::class, 'add'])->name('department.add');
Route::post('/department_add', [DepartmentController::class, 'submit_add'])->name('department.submit_add');

Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/department', [DepartmentController::class, 'update']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');




//This are all the routes for user;
Route::get('/user', [UserController::class, 'index'])->name('User');
Route::get('/user_add', [UserController::class, 'add'])->name('user.add');
Route::post('/user_add', [UserController::class, 'submit_add'])->name('user.submit_add');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//This are all the routes for role;
Route::get('/role', [RoleController::class, 'index'])->name('Role');
Route::get('/role_add', [RoleController::class, 'add'])->name('role.add');
Route::post('/role_add', [RoleController::class, 'submit_add'])->name('role.submit_add');
Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/role', [RoleController::class, 'update']);
Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
Route::get('/role/setpermission/{id}', [RoleController::class, 'set_permission_role'])->name('role.set_permission');
Route::post('/role/setpermission/submit', [RoleController::class, 'submit_set_permission_role'])->name('role.submit_set_permission');

//This are all the routes for permission;
Route::get('/permission', [PermissionController::class, 'index'])->name('Permission');
Route::get('/permission_add', [PermissionController::class, 'add'])->name('permission.add');
Route::post('/permission_add', [PermissionController::class, 'submit_add'])->name('permission.submit_add');
Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::put('/permission', [PermissionController::class, 'update']);
Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');




















