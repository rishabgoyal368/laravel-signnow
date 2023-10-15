<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignNowController;

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

Route::group([ 'prefix' => 'sign-now' ], function () {
    Route::get('/authenticate', [SignNowController::class, 'authenticate']);
    Route::get('/handle-oauth-code', [SignNowController::class, 'handleAuthCode'])->name('sign-now-handle-auth-code');

    Route::get('/sign-links', [SignNowController::class, 'getSigningLinks']);
    Route::post('/sign-link/{documentId}', [SignNowController::class, 'signLink']);

    Route::get('/folders', [SignNowController::class, 'getFolders']);
    Route::get('/documents/{folderId?}', [SignNowController::class, 'getDocuments']);

    Route::post('/document', [SignNowController::class, 'createDocument']);
    Route::get('/document/{documentId}', [SignNowController::class, 'getDocument']);
    Route::post('/document/{documentId}/invite', [SignNowController::class, 'createInvite']);
    Route::put('/document/{documentId}', [SignNowController::class, 'updateDocument']);
    Route::delete('/document/{documentId}', [SignNowController::class, 'deleteDocument']);
});
