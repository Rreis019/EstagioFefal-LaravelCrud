<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CrudUserController;

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

//route para lista de usuarios UsersController
//Route::resource('users', UserController::class);

Route::get("/login",[CustomAuthController::class,"login"])->middleware("alreadyLoggedIn");
Route::get("/register",[CustomAuthController::class,"register"]);

Route::post("/register-user",[CustomAuthController::class,"registerUser"])->name('register-user');
Route::post("/login-user",[CustomAuthController::class,"loginUser"])->name('login-user');



Route::get("/dashboard",[CustomAuthController::class,"dashboard"])->name('dashboard');
Route::get("/logout",[CustomAuthController::class,"logout"])->name("logout");

//actions
Route::get("/delete-user/{id}",[CrudUserController::class,"deleteUser"])->name('user.delete');
Route::get("/edit-user/{id}",[CrudUserController::class,"editUser"]);
Route::get("/add-user",function(){
    return view("crud.addUser");
})->name("user.add");
Route::post("/edit-user",[CrudUserController::class,"updateUser"])->name('edit-user');

//Route::get("/edit-user/{id}",[CrudUserController::class,"editPost"])->name('post.edit');
/*
Route::get("/delete-user/{id}",[CrudUserController::class,"deletePost"])->name('post.delete');

*/