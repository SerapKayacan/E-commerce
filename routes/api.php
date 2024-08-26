<?php
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\AuthorApiController;
use App\Http\Controllers\Api\CampaignApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('product',ProductApiController::class);
Route::apiResource('user',UserApiController::class);
Route::apiResource('category',CategoryApiController::class);
Route::apiResource('order',OrderApiController::class);
Route::apiResource('author',AuthorApiController::class);
Route::apiResource('campaign',CampaignApiController::class);




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');





