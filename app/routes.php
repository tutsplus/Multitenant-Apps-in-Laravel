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

Route::group(['domain' => '{tenant}.toodoo.dev', 'before' => 'guest'], function() {
    Route::get('sign-in',     ['as' => 'sign-in',  'uses' => 'SessionsController@create']);
    Route::post('sign-in',    ['as' => 'sign-in',  'uses' => 'SessionsController@store']);
});

Route::group(['domain' => '{tenant}.toodoo.dev', 'before' => 'auth'], function() {
    Route::get('/', "HomeController@show");

    Route::resource('todos', 'TodosController'); // Will remove for manual routes maybe?
    Route::model('todos', 'Todo');

    Route::resource('users', 'UsersController');
    Route::model('users', 'User');

    Route::delete('sign-out', ['as' => 'sign-out', 'uses' => 'SessionsController@destroy']);
});

Route::bind('tenant', function($value) {
    $tenant = App::make('tenant');

    if ($tenant->slug === $value) {
        return $tenant;
    } else {
        return App::abort(404);
    }
});

View::composer('shared._notifications', function($view) {
    $view->with('flash', [
        'success' => Session::get('success'),
        'error'   => Session::get('error')
    ]);
});

View::share('currentUser', Auth::check() ? Auth::user() : new Guest);
View::share('currentOrg', App::make('tenant'));
View::share('isLoggedIn', Auth::check());

View::share('canI', function($action, $entity) {
    return CanI::can($action, $entity);
});

function tenantRoute($route, $params = [])
{
    $params = (array) $params;

    if (! isset($params['tenant'])) {
        $params['tenant'] = App::make('tenant')->slug;
    }

    return URL::route($route, $params);
}
