<?php
use Illuminate\Http\Request;
use Mcrmc\Notez\Models\Account;

Route::post('/isUser', 'Mcrmc\Notez\Controllers\RouteControl@isUser');
Route::post('/loginUser', 'Mcrmc\Notez\Controllers\RouteControl@loginUser');
Route::get('/getNotez', 'Mcrmc\Notez\Controllers\RouteControl@getNotez');
Route::get('/testUser', 'Mcrmc\Notez\Controllers\RouteControl@testUser');
Route::get('/getCats', 'Mcrmc\Notez\Controllers\RouteControl@getCats');
Route::get('/checkUser', 'Mcrmc\Notez\Controllers\RouteControl@getAuthenticatedUser');
Route::post('/getSelectedNote', 'Mcrmc\Notez\Controllers\RouteControl@getSelectedNote');
Route::post('/saveNote', 'Mcrmc\Notez\Controllers\RouteControl@saveNote');
Route::post('/testSave', 'Mcrmc\Notez\Controllers\RouteControl@testSave');
Route::get('test',function(){
    return 'Testing Routes';
});

Route::get('acc',function(){
    return Account::all();
});

