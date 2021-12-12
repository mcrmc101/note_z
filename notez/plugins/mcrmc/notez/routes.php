<?php
use Illuminate\Http\Request;

Route::post('/isUser', 'Mcrmc\Notez\Controllers\RouteControl@isUser');
Route::post('/loginUser', 'Mcrmc\Notez\Controllers\RouteControl@loginUser');
Route::get('/getNotez', 'Mcrmc\Notez\Controllers\RouteControl@getNotez');
Route::get('/testUser', 'Mcrmc\Notez\Controllers\RouteControl@testUser');
Route::get('/checkUser', 'Mcrmc\Notez\Controllers\RouteControl@getAuthenticatedUser');
Route::post('/getSelectedNote', 'Mcrmc\Notez\Controllers\RouteControl@getSelectedNote');
Route::get('test',function(){
    return 'Testing Routes';
});

