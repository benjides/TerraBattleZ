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
Route::get('/characters', function () {
    $classes = App\CharClass::orderBy('order_key','desc')->get();
    foreach ($classes as $class) {
      $class->characters = $class->characters()
                                  ->where('adventurer','=',true)
                                  ->orderBy('name','asc')
                                  ->get();
      foreach ($class->characters as $character) {
        $character->icon = asset('/assets/characters/'.$character->savename.'/icon.jpg');
      }
    }
    return view('rooster' , ['classes' => $classes]);
});
Route::get('/characters/{name}', function ($name) {
    $character = App\Character::where('name','=',$name)->first();
    $character->class = $character->className()->first()->class;
		foreach ($character->jobs = $character->jobs()->orderBy('number','asc')->get() as $job) {
			$job->skills = $job->skills()->orderBy('lvl','asc')->get();
			$job->items = $job->items()->orderBy('quantity','asc')->get();
		}
    $character->interactions = $character->interactions()->get();
    return view('character' , ['character' => $character]);
});

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
    Route::resource('characters', 'CharacterController');
    Route::resource('classes', 'ClassController');
    Route::resource('races', 'RaceController');

    /*
    * Skills Routes
    */
    Route::resource('skills', 'SkillController');
    Route::resource('affections', 'AffectionController');

    /*
    * Items Routes
    */
    Route::resource('items', 'ItemController');

});
