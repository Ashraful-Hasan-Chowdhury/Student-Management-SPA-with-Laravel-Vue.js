<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});
Route::get('/addStudents', function () {
    return view('home');
});
Route::get('/viewStudents', function () {
    return view('home');
});
Route::get('/editStudent/{name}', function () {
    return view('home');
})->where('name','[0-9]+');
Route::get('/createPost', function () {
    return view('home');
});

Auth::routes();
Route::get('/index', function () {
    return view('project.index');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('insert', 'StudentController@insert');
Route::get('show', 'StudentController@show');
Route::get('edit/{id}', 'StudentController@edit');
Route::get('editStudent/edit/{id}', 'StudentController@edit');
Route::put('update/{id}', 'StudentController@update');
Route::put('editStudent/update/{id}', 'StudentController@update');
Route::delete('delete/{id}', 'StudentController@destroy');
Route::get('search/{searchQuery}', 'StudentController@search');

Route::get('/addpage', 'StudentController@addpageIndex');
