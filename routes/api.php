<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::group(['middleware' => ['check_auth']],function() {   // كدا كدا هو واخد ال perfix ف ملف ال RouteServicePovider

Route::prefix('v1')->group(function (){
//    Route::get('posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post');
//    Route::get('post/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('postById');
//    Route::post('store_post', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
//    Route::put('update_post/{id}', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
//    Route::delete('delete_post/{id}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');

// =====  Posts  =========
    Route::controller(PostController::class)->group(function () {
        Route::resource('posts', PostController::class); // resource == apiResource
        Route::get('posts_files', 'Files');
        Route::post('post_upload_file','UploadFiles');
    });

// =====  Products  =========
    Route::controller(ProductController::class)->group(function () {
        Route::apiResource('products', ProductController::class)
            ->missing(function () {
            return response()->json(['error' => 'sorry not found this Product'], Response::HTTP_NOT_FOUND); // == 404
            }); // resource == apiResource
        Route::get('products/{product}/reviews', 'ProductReviews') // resource == apiResource
        ->missing(function () {
            return response()->json(['error' => 'sorry not found this Product'], Response::HTTP_NOT_FOUND); // == 404
        });
//        Route::get('products/{$product}', 'ProductReviews'); // resource == apiResource
    });

// =====  Reviews  =========
    Route::controller(ReviewController::class)->group(function () {
        Route::apiResource('reviews', ReviewController::class)
            ->missing(function () {
                return response()->json(['error' => 'sorry not found this Review'], Response::HTTP_NOT_FOUND); // == 404
            });
        // resource == apiResource
        Route::get('review/{review}/products', 'ReviewProduct') // resource == apiResource
        ->missing(function () {
            return response()->json(['error' => 'sorry not found this Review'], Response::HTTP_NOT_FOUND); // == 404
        });
    });
});

//});
