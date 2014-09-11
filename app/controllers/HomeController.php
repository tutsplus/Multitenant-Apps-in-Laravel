<?php

class HomeController extends BaseController
{
    protected $viewBase = 'home';
    protected $layout   = 'layouts.account';

    public function show()
    {
        $orgs = $this->currentUser()->organizations;
        $this->view('show', compact('orgs'));
    }
}
