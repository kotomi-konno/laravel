<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// goal
Route::post('/goal/create', 'GoalController@create');
Route::get('/goal/read', 'GoalController@read');
Route::put('/goal/update', 'GoalController@update');
Route::delete('/goal/delete/{id}', 'GoalController@delete');
Route::post('/goal/search', 'GoalController@search');


// action
Route::post('/action/save', 'ActionController@save');
Route::get('/action/read', 'ActionController@read');