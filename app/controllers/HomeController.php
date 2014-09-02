<?php

class HomeController extends BaseController
{
    protected $viewBase = 'home';

    public function show()
    {
        $this->view('show');
    }
}
