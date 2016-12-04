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

Route::get('/', 'Ntq\Tickit\Controller\Web\UserStoryController@index')
    ->name('home');
Route::get('/assign/{userStoryId}', 'Ntq\Tickit\Controller\Web\UserStoryController@getAssign');
Route::post('/assign/{userStoryId}', 'Ntq\Tickit\Controller\Web\UserStoryController@postAssign');