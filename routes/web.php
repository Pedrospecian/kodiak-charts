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

//Rotas do front-end
Route::get('/', function () {
    return view('chart/index');
});
Route::get('/charts/{id}', function () {
    return view('chart/single');
});
Route::get('/archive', function () {
    return view('archive/index');
});
Route::get('/archive/{id}', function () {
    return view('archive/single');
});

//Rotas do admin

//Países
Route::get('/admin/paises', 'CountriesController@select')->name('paises-all');
Route::get('/admin/paises/new', function(){
	return view('admin/countries/new');
});
Route::post('/admin/paises/insert', 'CountriesController@insert');

//Gêneros
Route::get('/admin/generos', 'GenresController@select')->name('generos-all');
Route::get('/admin/generos/new', function(){
	return view('admin/genres/new');
});
Route::post('/admin/generos/insert', 'GenresController@insert');
Route::get('/admin/generos/{id}', 'GenresController@single')->name('genre-single');
Route::get('/admin/generos/{id}/subgenero', 'GenresController@new_subgenre');
Route::post('/admin/generos/{id}/subgenero/insert', 'GenresController@new_subgenre_insert');

//Artistas

//Listas