<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\TaskList\TaskListController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Front\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Front\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\Front\Dashboard\HomePageController;
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

Route::get('/', function () {
    return view('welcome');
});

//Route for show Home page

Route::get('/',[HomePageController::class,'homePage'])->name('homePage');

//Route for admin
Route::prefix('admin')->group(function (){
    Route::get('/login',[LoginController::class,'showLoginPage'])->name('admin.show.login.page');
    Route::post('/post-login',[LoginController::class,'postLogin'])->name('admin.post.login');
    Route::get('/dashboard',[DashboardController::class,'showAdminDashboard'])->name('admin.dashboard');
    Route::get('/logout',[LoginController::class,'logout'])->name('admin.logout');
});

//Route for user
Route::prefix('user')->group(function (){
    Route::get('/login',[App\Http\Controllers\Front\Auth\LoginController::class,'showLoginPage'])->name('user.show.login.page');
    Route::post('/post-login',[App\Http\Controllers\Front\Auth\LoginController::class,'postLogin'])->name('user.post.login');
    Route::get('/dashboard',[App\Http\Controllers\Front\Dashboard\DashboardController::class,'showUserDashboard'])->name('user.dashboard');
    Route::get('/logout',[App\Http\Controllers\Front\Auth\LoginController::class,'logout'])->name('user.logout');
});

//Route for create new user 
Route::get('/create-user',[UserController::class,'create'])->name('user.create');
Route::post('/store-user',[UserController::class,'store'])->name('user.store');
Route::get('/show-user/{id}',[UserController::class,'show'])->name('user.show');
Route::get('/edit-user/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('/update-user',[UserController::class,'update'])->name('user.update');
Route::get('/delete-user/{id}',[UserController::class,'delete'])->name('user.delete');
Route::get('/delete-image/{id}',[UserController::class,'deleteImage'])->name('user.delete.image');
Route::get('/change-status',[DashboardController::class,'changeStatus'])->name('user.change.status');
Route::post('/clone-column',[UserController::class,'cloneColumn'])->name('user.clone.column');


//Route for add task module
Route::get('/task-list',[TaskListController::class,'index'])->name('tasklist.index');
Route::get('/create-task',[TaskListController::class,'create'])->name('tasklist.create');
Route::post('/store-task',[TaskListController::class,'store'])->name('tasklist.store');
Route::get('/show-task/{id}',[TaskListController::class,'show'])->name('taskList.show');
Route::get('/edit-tasklist/{id}',[TaskListController::class,'edit'])->name('tasklist.edit');
Route::post('/update-task',[TaskListController::class,'update'])->name('tasklist.update');
Route::get('/delete-task/{id}',[TaskListController::class,'delete'])->name('tasklist.delete');
Route::get('/change-task-status',[TaskListController::class,'changeStatus'])->name('tasklist.change.status');
