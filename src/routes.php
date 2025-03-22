<?php


Route::get('/api/media/find', '\STukenov\MediaField\Controllers\MediaController@findFiles');
Route::post('/api/media/upload', '\STukenov\MediaField\Controllers\MediaController@uploadFile');
Route::post('/api/media/update', '\STukenov\MediaField\Controllers\MediaController@updateFile');
Route::get('/api/media', '\STukenov\MediaField\Controllers\MediaController@getFiles');
Route::delete('/api/media/delete', '\STukenov\MediaField\Controllers\MediaController@deleteFiles');
