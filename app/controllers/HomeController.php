<?php

class HomeController extends BaseController
{
    protected $viewBase = 'home';
    protected $layout   = 'layouts.account';

    public function __construct()
    {
        $this->beforeFilter('@authorize', ['only' => 'dashboard']);
    }

    public function show()
    {
        $orgs = $this->currentUser()->organizations;
        $this->view('show', compact('orgs'));
    }

    public function dashboard()
    {
        $counts = [
            'organizations' => Organization::count(),
            'users'         => User::count(),
            'todos'         => Todo::count(),
            'mt_users'      => User::has('organizations', '>', 1)->count()
        ];

        $newestOrg = Organization::orderBy('created_at', 'desc')->first();

        $orgWithMostTodos = DB::table('organizations')
            ->select(['organizations.name', DB::raw('count(todos.organization_id) as total')])
            ->join('todos', 'todos.organization_id', '=', 'organizations.id')
            ->orderBy('total', 'desc')
            ->groupBy('todos.organization_id')
            ->first();

        $this->view('dashboard', compact('counts', 'newestOrg', 'orgWithMostTodos'));
    }

    public function authorize()
    {
        if (! $this->currentUser()->isMemberOf(Organization::vendor())) {
            return App::abort(404);
        }
    }
}
