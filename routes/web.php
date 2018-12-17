<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//No Auth Page Routes
Route::get('/','NoAuthPages@index');
Route::get('/login','NoAuthPages@login');
Route::get('/register','NoAuthPages@register');
Route::get('/activate/{hash}','NoAuthPages@activate');
Route::get('/resend','NoAuthPages@resend');

//Auth Page Routes
Route::get('/app','AuthPages@app');


//No Auth API Routes
Route::post('/api/user/exists','NoAuthApi@userExists');
Route::post('/api/user/login','NoAuthApi@userLogin');
Route::post('/api/user/register','NoAuthApi@userRegister');
Route::post('/api/activation/resend','NoAuthApi@activationResend');

//Auth API Routes
Route::get('/api/user/logout','AuthApi@userLogout');