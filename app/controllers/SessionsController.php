<?php

class SessionsController extends BaseController
{
    protected $layout = "layouts.sign-in";

    public function create()
    {
        return View::make('layouts.sign-in');
    }

    public function store()
    {
        if (Auth::attempt(Input::only('email', 'password'), Input::get('remember'))) {
            return Redirect::to('/')->withSuccess('Signed in successfully');
        } else {
            return Redirect::route('sign-in')->withError('Invalid username or password');
        }
    }

    public function destroy()
    {
        $redirect = Redirect::route('sign-in');

        if (Auth::check()) {
            return $redirect->withSuccess('Signed out successfully');
        } else {
            return $redirect;
        }
    }
}
