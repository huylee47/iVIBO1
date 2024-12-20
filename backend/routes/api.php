<?php

use App\Http\Controllers\client\TimeKeepingController;;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CheckLogController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');\
// Route::middleware(['auth:sanctum','abilities:admin'])->get('/admin', function () {
//     return response()->json(['message' => 'Welcome Admin']);
// });
// Route::middleware('auth:sanctum')->get('/user', function () {
//     return response()->json(['message' => 'Welcome User']);
// });
Route::post('/login', [LoginController::class, 'login']);

// Route cho admin
Route::middleware(['auth:sanctum','abilities:admin'])->group(function(){
    Route::prefix('user')->group(function (){
        Route::get('/', [UserController::class,'index']);
        Route::post('/store',[UserController::class,'store']);
        Route::delete('/delete/{id}',[UserController::class,'destroy']);
    });
    Route::prefix('check-log')->group(function (){
        Route::get('/list',[CheckLogController::class,'index']);
    });
    // Route::prefix('/project')->group(function (){
    //     Route::get('/',[ProjectController::class,'index']);
    //     Route::post('/store',[ProjectController::class,'store']);
    //     Route::get('/show/{id}',[ProjectController::class,'show']);
    //     Route::put('/update/{id}',[ProjectController::class,'update']);
    //     Route::delete('/delete/{id}',[ProjectController::class,'destroy']);
    // });
    Route::prefix('task')->group(function (){
        Route::post('/store',[TaskController::class,'store']);
    });
});
Route::middleware(['auth:sanctum'])->group(function (){
    Route::prefix('task')->group(function (){
        Route::get('/',[TaskController::class,'indexID']);
    });
    Route::prefix('check-in')->group(function (){
        Route::post('/',[TimeKeepingController::class,'checkIn']);
    });
    Route::prefix('user')->group(function (){
        Route::get('/show/{id}',[UserController::class,'show']);
        Route::put('/update/{id}',[UserController::class,'update']);
    });
        Route::prefix('task')->group(function (){
        Route::get('/list',[TaskController::class,'index']);
    });
});
