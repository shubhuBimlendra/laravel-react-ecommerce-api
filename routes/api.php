<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;

Route::POST('/register',[AuthController::class, 'register']);
Route::POST('/login',[AuthController::class, 'login']);


Route::middleware(['auth:sanctum','IsApiAdmin'])->group(function(){

    Route::get('/checkingAuthenticated', function(){
        return response()->json(['message' =>'You are in', 'status'=>200], 200);
    });

    //Category
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}',[CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'delete']);
    Route::get('all-category', [categoryController::class, 'allcategory']);

    //Product
    Route::post('store-product', [productController::class, 'store']);
    Route::get('view-product', [productController::class, 'index']);
    Route::get('edit-product/{id}', [productController::class, 'edit']);
    Route::post('update-product/{id}', [productController::class, 'update']);
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout',[AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
