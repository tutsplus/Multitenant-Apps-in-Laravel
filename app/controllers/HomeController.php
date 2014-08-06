<?php

class HomeController extends BaseController
{
    protected $viewBase = 'home';

    public function index()
    {
        $this->view('index');
    }
}
