<?php

class UsersController extends BaseController
{
    protected $viewBase = "users";

    public function __construct()
    {
        $this->beforeFilter('@authorize', ['only' => ['edit', 'update', 'destroy']]);
        $this->beforeFilter('@authorizeInvite', ['only' => ['store', 'create']]);
    }

    public function index()
    {
        $users = $this->currentOrg()->users;
        $this->view('index', compact('users'));
    }

    public function create()
    {
        $this->view('create');
    }

    public function store()
    {
        $invite = new UserInvite(Input::get('email'), $this->currentOrg());

        if ($invite->save()) {
            return $this->redirectToIndex()
                ->withSuccess('User invited successfully');
        } else {
            $this->view('create', ['user' => $invite->getUser()])
                ->withErrors($invite->getErrors());
        }
    }

    public function edit(Organization $org, User $user)
    {
        $this->view('edit', compact('user'));
    }

    public function update(Organization $org, User $user)
    {
        $change = new UserChange($user, Input::get('user'));

        if ($change->save()) {
            return $this->redirectToIndex()
                ->withSuccess('User updated successfully');
        } else {
            $this->view('edit', ['user' => $invite->getUser()])
                ->withErrors($change->getErrors());
        }
    }

    public function destroy(Organization $org, User $user)
    {
        $user->delete();
        return $this->redirectToIndex()
            ->withSuccess('User deleted successfully');
    }

    public function authorize($route, $request)
    {
        $allowed = App::make('canI')->can('manage', $route->parameter('users'));

        if (! $allowed) {
            return App::abort(401);
        }
    }

    public function authorizeInvite($route, $request)
    {
        $allowed = CanI::can('invite', 'User');

        if (! $allowed) {
            return App::abort(401);
        }
    }

    public function redirectToIndex()
    {
        return Redirect::route('organizations.users.index', [$this->currentOrg()->id]);
    }
}
