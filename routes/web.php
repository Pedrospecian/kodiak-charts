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
Route::get('/', 'PagesController@chartIndex');
Route::get('/charts/{id}', 'PagesController@chartSingle');
Route::get('/chartsArtists/{id}', 'PagesController@chartSingleArtists');
Route::get('/archive/{sort?}', 'PagesController@archiveIndex');
Route::get('/archive/single/{id}', 'PagesController@archiveSingle');
Route::get('/search/{sort?}', 'PagesController@search');

//Rotas do admin
Route::middleware(['auth'])->group(function () {
	Route::get('/admin', function(){
		return view('admin/index');
	});

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
	Route::get('/admin/artistas', 'ArtistsController@select')->name('artistas-all');
	Route::get('/admin/artistas/new', 'ArtistsController@insertScreen');
	Route::post('/admin/artistas/insert', 'ArtistsController@insert');
	Route::get('/admin/artistas/{id}', 'ArtistsController@single')->name('artist-single');
	Route::get('/admin/artistas/{id}/editar', 'ArtistsController@edit')->name('artist-edit');
	Route::post('/admin/artistas/{id}/update', 'ArtistsController@update');

	//Listas
	Route::get('/admin/listas', 'ListsController@select')->name('listas-all');
	Route::get('/admin/listas/new', 'ListsController@newForm');
	Route::post('/admin/listas/insert', 'ListsController@insert');
	Route::get('/admin/listas/{id}', 'ListsController@single')->name('list-single');
	Route::get('/admin/listas/{id}/novoregistro', 'ListsController@newEntryForm');
	Route::get('/admin/listas/{id}/visualizar/{registroid}', 'ListsController@seeEntry')->name('list-register-single');
	Route::post('/admin/listas/insertEntry', 'ListsController@insertEntry');

	//Listas de Artistas
	Route::get('/admin/listas-artistas', 'ListsArtistsController@select')->name('listas-artistas-all');
	Route::get('/admin/listas-artistas/new', 'ListsArtistsController@newForm');
	Route::post('/admin/listas-artistas/insert', 'ListsArtistsController@insert');
	Route::get('/admin/listas-artistas/{id}', 'ListsArtistsController@single')->name('list-artist-single');
	Route::get('/admin/listas-artistas/{id}/novoregistro', 'ListsArtistsController@newEntryForm');
	Route::get('/admin/listas-artistas/{id}/visualizar/{registroid}', 'ListsArtistsController@seeEntry')->name('list-artist-register-single');
	Route::post('/admin/listas-artistas/insertEntry', 'ListsArtistsController@insertEntry');
});

Auth::routes();


//Estatisticas
Route::get('/maiorPosicaoLista/{idMusica}/{idLista}', 'ListsController@maiorPosicaoLista');
Route::get('/positionLastWeek/{idMusica}/{idLista}/{idEntryAtual}', 'ListsController@positionLastWeek');
Route::get('/noSemanasNoChart/{idMusica}/{idLista}', 'ListsController@noSemanasNoChart');