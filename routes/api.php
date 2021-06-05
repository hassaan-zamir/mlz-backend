<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//login
Route::post('/login', [App\Http\Controllers\AuthController::class , 'login']);
Route::post('/tickets' , [App\Http\Controllers\TicketController::class, 'store']);
//Get Locations
Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index']);
//Auth
Route::middleware('auth:sanctum')->group(function() {

  Route::get('user', [App\Http\Controllers\AuthController::class , 'user']);

  Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);


  //Update Locations
  Route::post('/locations/update/{id}' , [App\Http\Controllers\LocationController::class, 'update']);
  //Store Location
  Route::post('/locations' , [App\Http\Controllers\LocationController::class , 'store']);
  //Delete Location
  Route::get('/locations/delete/{id}' , [App\Http\Controllers\LocationController::class , 'delete']);

  // View parking ticket
  Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index']);
  // Add parking ticket
 
  // Delete parking ticket
  Route::get('/tickets/delete/{id}' , [App\Http\Controllers\TicketController::class, 'delete']);

  // View shifts
  Route::get('/shifts' , [App\Http\Controllers\ShiftsController::class , 'index']);
  // Add shift
  Route::post('/shifts' , [App\Http\Controllers\ShiftsController::class, 'store']);
  // Delete shift
  Route::get('/shifts/delete/{id}', [App\Http\Controllers\ShiftsController::class , 'delete']);

  // View reports
  Route::get('/reports/{filter}/{id}' , [App\Http\Controllers\ReportsController::class, 'index']);
  // Add report
  Route::post('/guards/add-report/' , [App\Http\Controllers\GuardsController::class, 'addReport']);
  // Update report(add notes, incidents)
  Route::post('/guards/update-report/', [App\Http\Controllers\GuardsController::class , 'updateReport']);

  // Get User
  Route::get('/admin/get-users/' , [App\Http\Controllers\AdminController::class, 'getUsers'])->middleware('isAdmin');
  // Create user(guard,client)
  Route::post('/admin/create-user/', [App\Http\Controllers\AdminController::class, 'addUser'])->middleware('isAdmin');
  // Update user(guard, client)
  Route::post('/admin/update-user/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->middleware('isAdmin');
  // Delete user
  Route::get('/admin/delete-user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->middleware('isAdmin');
});
