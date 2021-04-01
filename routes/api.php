<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index']);
Route::post('/locations/update/{id}' , [App\Http\Controllers\LocationController::class, 'update']);
Route::post('/locations' , [App\Http\Controllers\LocationController::class , 'store']);
Route::get('/locations/delete/{id}' , [App\Http\Controllers\LocationController::class , 'delete']);

Route::post('/tickets' , [App\Http\Controllers\TicketController::class, 'store']);
Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index']);
Route::post('/ticket/delete/{id}' , [App\Http\Controllers\TicketController::class, 'delete']);



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
