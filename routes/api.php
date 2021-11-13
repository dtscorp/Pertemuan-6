<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\student_Controller;
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

Route::get("/students", [student_Controller::class, "index"]);
Route::get("/students/{id}", [student_Controller::class,"show"]);
Route::post("/students", [student_Controller::class, "create"]);
Route::put("/students/{id}", [student_Controller::class, "update"]);
Route::delete("/students/{id}", [student_Controller::class, "destroy"]);
