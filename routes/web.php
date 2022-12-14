<?php 


use Ikonc\PhpMvc\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class,'index']);

//register
Route::get('/register', [RegisterController::class, 'index']);
Route::get('/register/create', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']); 

//login 
Route::get('/login', [LoginController::class, 'index']);