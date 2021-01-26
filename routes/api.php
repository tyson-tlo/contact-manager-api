<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Tags\TagController;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\Tags\TagCompanyController;
use App\Http\Controllers\API\Tags\TagContactController;
use App\Http\Controllers\API\Contacts\ContactController;
use App\Http\Controllers\API\Companies\CompanyController;
use App\Http\Controllers\API\Companies\Tags\CompanyTagMapController;

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

Route::post('register', [RegistrationController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:api');
Route::resource('contacts', ContactController::class)->middleware('auth:api');
Route::resource('companies', CompanyController::class)->middleware('auth:api');
Route::resource('tags', TagController::class)->middleware('auth:api');
Route::resource('companies/{company}/tags', CompanyTagMapController::class)->middleware('auth:api');

Route::prefix('tags')->middleware('auth:api')->group(function () {
    Route::post('{tag}/companies', [TagCompanyController::class, 'store']);
});
Route::resource('tags/{tag}/companies', TagCompanyController::class)->middleware('auth:api');
Route::resource('tags/{tag}/contacts', TagContactController::class)->middleware('auth:api');
