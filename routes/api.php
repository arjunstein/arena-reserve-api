<?php

use App\Http\Controllers\Api\Field\FieldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/api/documentation', [\L5Swagger\Http\Controllers\SwaggerController::class, 'api'])->name('l5-swagger.api');

// Route::resource('/fields', FieldController::class);
Route::prefix('fields')->group(function () {
    Route::get('/', [FieldController::class, 'index'])->name('fields.index');
    Route::get('/{field}', [FieldController::class, 'show'])->name('fields.show');
    Route::post('/', [FieldController::class, 'store'])->name('fields.store');
    Route::put('/{field}', [FieldController::class, 'update'])->name('fields.update');
    Route::delete('/{field}', [FieldController::class, 'destroy'])->name('fields.destroy');
});
