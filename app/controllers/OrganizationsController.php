<?php

class OrganizationsController extends BaseController
{
    protected $viewBase = 'organizations';

    public function show()
    {
        $this->view('show');
    }
}
