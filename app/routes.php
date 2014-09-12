<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['domain' => 'toodoo.dev', 'before' => 'guest'], function() {
    Route::get('sign-in',     ['as' => 'sign-in',  'uses' => 'SessionsController@create']);
    Route::post('sign-in',    ['as' => 'sign-in',  'uses' => 'SessionsController@store']);

    Route::get('sign-up',     ['as' => 'sign-up',  'uses' => 'SignupsController@create']);
    Route::post('sign-up',    ['as' => 'sign-up',  'uses' => 'SignupsController@store']);
});

Route::group(['domain' => 'toodoo.dev', 'before' => 'auth'], function() {
    Route::get('/', ['uses' => 'HomeController@show', 'as' => 'home']);

    Route::delete('sign-out', ['as' => 'sign-out', 'uses' => 'SessionsController@destroy']);
});

Route::group(['domain' => '{organizations}.toodoo.dev', 'before' => 'auth|tenant'], function() {
    Route::get('/', ['uses' => 'OrganizationsController@show', 'as' => 'organizations.show']);
    Route::bind('organizations', function($value, $route) {
        return Organization::where('slug', $value)->firstOrFail();
    });

    Route::resource('todos', 'TodosController'); // Will remove for manual routes maybe?
    Route::model('todos', 'Todo');

    Route::resource('users', 'UsersController');
    Route::model('users', 'User');
});

View::composer('shared._notifications', function($view) {
    $view->with('flash', [
        'success' => Session::get('success'),
        'error'   => Session::get('error')
    ]);
});

View::share('currentUser', Auth::check() ? Auth::user() : new Guest);
View::share('isLoggedIn', Auth::check());

View::share('canI', function($action, $entity) {
    return CanI::can($action, $entity);
});

function tenantRoute($route, $params = [])
{
    $params = (array) $params;

    if (! starts_with($route, ['sign-', 'organizations.']) && ! isset($params['organizations'])) {
        $org    = Route::current()->parameter('organizations');
        $params = array_merge(['organizations' => $org->slug], $params);
    }

    return URL::route($route, $params);
}
