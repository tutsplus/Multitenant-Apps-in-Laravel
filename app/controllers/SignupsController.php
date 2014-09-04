<?php

class SignupsController extends BaseController
{
    protected $layout   = 'layouts.account';
    protected $viewBase = 'signups';

    public function create()
    {
        $this->view('create');
    }

    public function store()
    {
        $signup = new Signup(Input::all());

        if ($signup->save()) {
            Auth::login($signup->getUser());

            return Redirect::to('/')
                ->withSuccess('Signup completed successfully');
        } else {
            $this->view('create')->withErrors($signup->getErrors());
        }
    }
}
