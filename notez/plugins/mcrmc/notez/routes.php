<?php
use Illuminate\Http\Request;

Route::post('/isUser', 'Mcrmc\Notez\Controllers\RouteControl@isUser');
Route::post('/loginUser', 'Mcrmc\Notez\Controllers\RouteControl@loginUser');
Route::get('/getNotes', 'Mcrmc\Notez\Controllers\RouteControl@getNotes');
Route::get('/testUser', 'Mcrmc\Notez\Controllers\RouteControl@testUser');
Route::get('/checkUser', 'Mcrmc\Notez\Controllers\RouteControl@getAuthenticatedUser');
Route::get('test',function(){
    return 'Testing Routes';
});

