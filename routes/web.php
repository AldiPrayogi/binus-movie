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

Auth::routes();

//welcome page and searching
Route::get('/', 'WelcomeController@welcome');
Route::get('/movie-welcome', 'WelcomeController@searching');

//home page, movie page and searching
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/movie/{id}', 'MovieController@index');
Route::get('/search-movie', 'HomeController@searching');

//profile, editprofile, updateprofile
Route::get('/profile', 'UserController@profile')->middleware('auth');
Route::get('/profile/updateProfile/{id}', 'UserController@index')->middleware('auth');
Route::post('/profile/updateProfile/edit', 'UserController@update')->middleware('auth');
Route::post('/sendmessage/{to_id}', 'ProfileController@sendMessage');
Route::get('/inbox/{id}', 'ProfileController@viewInbox')->middleware('auth');
Route::get('/messageDelete/{id}', 'ProfileController@deleteMessage')->middleware('auth');
Route::get('/profiles/{id}', 'ProfileController@view');

//movie 
Route::post('/movieComment', 'MovieController@postComment')->middleware('checkMember');
Route::get('/deleteComment/{id}', 'MovieController@deleteComment')->middleware('checkMember');

//Admin Manage Movie
Route::get('/managemovie', 'MovieController@daftarMovie')->name('daftar.movie')->middleware('checkAdmin');
Route::get('/add-movie', 'MovieController@create')->name('daftar.movie.add')->middleware('checkAdmin');
Route::post('/add-movie/store', 'MovieController@store')->name('daftar.movie.store')->middleware('checkAdmin');
Route::get('/edit-movie/{id}','MovieController@edit')->name('daftar.movie.edit')->middleware('checkAdmin');
Route::post('/edit-movie/{id}/update','MovieController@update')->name('daftar.movie.update')->middleware('checkAdmin');
Route::get('/delete-movie/{id}','MovieController@destroy')->name('movie.destroy')->middleware('checkAdmin');



//Admin Manage Genre
Route::get('/genre','GenreController@index')->name('genre')->middleware('checkAdmin');
Route::get('/edit-genre/{id}','GenreController@edit')->name('genre.edit')->middleware('checkAdmin');
Route::post('/edit-genre/{id}/update','GenreController@update')->name('genre.update')->middleware('checkAdmin');
Route::get('/add-genre','GenreController@create')->middleware('checkAdmin');
Route::post('/add-genre/addgenre','GenreController@create')->name('genre.add')->middleware('checkAdmin');
Route::post('/add-genre/addgenre/store','GenreController@store')->name('genre.store')->middleware('checkAdmin');
Route::get('/delete-genre/{id}','GenreController@destroy')->name('genre.destroy')->middleware('checkAdmin');


//Admin Manage User
Route::get('/user','ProfileController@index')->name('user')->middleware('checkAdmin');
Route::get('/add-user','ProfileController@create')->name('user.add')->middleware('checkAdmin');
Route::post('/add-user/adduser/store','ProfileController@store')->name('user.store')->middleware('checkAdmin');
Route::get('/edit-user/{id}','ProfileController@edit')->name('user.edit')->middleware('checkAdmin');
Route::post('/edit-user/{id}/edit','ProfileController@update')->name('user.update')->middleware('checkAdmin');
Route::get('/delete-user/{id}','ProfileController@destroy')->name('user.destroy')->middleware('checkAdmin');


//route savedMovies
Route::get('/bookmarks', 'UserController@indexBookmark')->middleware('checkMember');
Route::post('/addbookmark/{id}', 'UserController@addBookmark')->middleware('checkMember');
Route::get('/deletebookmark/{id}', 'UserController@deleteBookmark')->middleware('checkMember');

