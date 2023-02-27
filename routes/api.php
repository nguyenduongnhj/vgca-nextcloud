<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\KeyEncryptionUserController;
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

Route::get('/users', [UserController::class, 'list']);
Route::get('/thumbprints/{thumbprint}', [UserController::class, 'findByThumbprint']);
Route::post('/users', [UserController::class, 'create']);
Route::get('/users/{user_id}/public-key', [UserController::class, 'getPublicKey']);
Route::get('/users/{user_id}', [UserController::class, 'get']);
Route::put('/users/{user_id}', [UserController::class, 'update']);
Route::delete('/users/{user_id}', [UserController::class, 'delete']);
Route::post('/users/verify-signature', [UserController::class, 'verifySignature']);

Route::get('/v2/users/{id}/public-key', [UserController::class, 'getPublicKeyById']);
Route::get('/v2/users/{id}', [UserController::class, 'getById']);
Route::put('/v2/users/{id}', [UserController::class, 'updateById']);
Route::delete('/v2/users/{id}', [UserController::class, 'deleteById']);
Route::post('/v2/users/verify-signature', [UserController::class, 'verifySignatureById']);

Route::get('/key-encryption', [KeyEncryptionUserController::class, 'list']);
Route::get('/key-encryption/rooms/{room_id}', [KeyEncryptionUserController::class, 'getByRoomId']);
Route::get('/key-encryption/rooms/{room_id}/users/{user_id}', [KeyEncryptionUserController::class, 'getByUserId']);
Route::post('/key-encryption', [KeyEncryptionUserController::class, 'create']);
Route::put('/key-encryption', [KeyEncryptionUserController::class, 'update']);
Route::delete('/key-encryption/rooms/{room_id}', [KeyEncryptionUserController::class, 'deleteByRoomId']);
Route::delete('/key-encryption/rooms/{room_id}/users/{user_id}', [KeyEncryptionUserController::class, 'deleteByUserId']);

