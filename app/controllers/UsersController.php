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
        $this->view('create');
    }

    public function store()
    {
        $invite = new UserInvite(Input::get('email'));

        if ($invite->save()) {
            return Redirect::route('users.index')
                ->withSuccess('User invited successfully');
        } else {
            $this->view('create', ['user' => $invite->getUser()])
                ->withErrors($invite->getErrors());
        }
    }

    public function edit(User $user)
    {
        $this->view('edit', compact('user'));
    }

    public function update(User $user)
    {
        $change = new UserChange($user, Input::get('user'));

        if ($change->save()) {
            return Redirect::route('users.index')
                ->withSuccess('User updated successfully');
        } else {
            $this->view('edit', ['user' => $invite->getUser()])
                ->withErrors($change->getErrors());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index')
            ->withSuccess('User deleted successfully');
    }
}
