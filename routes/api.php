<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/goal/create', 'GoalController@create');
Route::get('/goal/read', 'GoalController@read');
Route::put('/goal/update', 'GoalController@update');
Route::delete('/goal/delete/{id}', 'GoalController@delete');
Route::post('/goal/search', 'GoalController@search');