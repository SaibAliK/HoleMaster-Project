<?php

use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('login', [UserController::class, 'login']);
});


Route::post('upload-image', [JobController::class, 'uploadImage']);

Route::post('/form-submit', [FormController::class, 'formSubmit'])->name('form.submit');
Route::get('stages', [FormController::class, 'Stages'])->name('stages');
Route::get('/get-form/{id}', [FormController::class, 'getForm'])->name('getform');


Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'v1'], function () {

        Route::get('get_job', [JobController::class, 'get_job']);
        Route::get('get-job-detail/{id}', [JobController::class, 'get_job_detail']);
        Route::get('get-forms/{job_detail}/{form}', [JobController::class, 'get_forms']);
        Route::post('make-form-locked', [JobController::class, 'make_form_locked']);
        Route::get('get-job-by-operative', [JobController::class, 'get_jobs_by_operative']);
    });
});
