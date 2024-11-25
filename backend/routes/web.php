<?php

use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('user')->group(function (){
    Route::get('/', [UserController::class,'index']);
    Route::post('/store',[UserController::class,'store']);
});