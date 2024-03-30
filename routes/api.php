<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TestimonialController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Services
Route::get("getService",[ServicesController::class,'get_services']);
Route::post("saveService",[ServicesController::class,'save_service']);
Route::post("updateService",[ServicesController::class,'update_service']);
Route::get("deleteService/{id}",[ServicesController::class,'delete_service']);

//Testimonial
Route::get("getTestimonial",[TestimonialController::class,'get_testimonial']);
Route::post("saveTestimonial",[TestimonialController::class,'save_testimonial']);
Route::post("updateTestimonial",[TestimonialController::class,'update_testimonial']);
Route::get("deleteTestimonial/{id}",[TestimonialController::class,'delete_testimonial']);
