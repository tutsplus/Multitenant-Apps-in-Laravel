<?php

class UsersController extends BaseController
{
    protected $viewBase = "users";

    public function index()
    {
        $users = User::all();
        $this->view('index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        $this->view('create', compact('user'));
    }

    public function store()
    {
        $registration = new UserAdminRegistration(Input::get('user'), new User());

        if ($registration->save()) {
            return Redirect::route('users.index')
                ->withSuccess('User created successfully');
        } else {
            $this->view('create', ['user' => $registration->getUser()])
                ->withErrors($registration->getErrors());
        }
    }

    public function edit(User $user)
    {
        $this->view('edit', compact('user'));
    }

    public function update(User $user)
    {
        $registration = new UserAdminRegistration(Input::get('user'), $user);

        if ($registration->save()) {
            return Redirect::route('users.index')
                ->withSuccess('User updated successfully');
        } else {
            $this->view('edit', compact('user'))
                ->withErrors($registration->getErrors());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index')
            ->withSuccess('User deleted successfully');
    }
}
