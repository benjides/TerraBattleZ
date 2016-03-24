<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $news = App\News::orderBy('date','desc')->take(10)->get();
    return view('index' , ['news' => $news]);
});
Route::resource('characters', 'CharacterController');

/*
  Admin Routes
*/
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => 'admin' , 'middleware' => 'auth'], function() {
    Route::get('/', function() {
        return view('admin.dashboard');
    });
    Route::group(['middleware' => 'admin'], function() {
      Route::resource('users', 'UserController');
      Route::resource('news', 'NewsController');
    });

    /*
    * Characters Routes
    */
    Route::resource('classes', 'ClassController');
    Route::resource('races', 'RaceController');

    /*
    * Skills Routes
    */
    Route::resource('affections', 'AffectionController');

});
