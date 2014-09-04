<?php

class BaseController extends Controller
{
    protected $layout = 'layouts.application';
    protected $viewBase = '';
    protected $currentUser;
    protected $currentOrg;

    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function view($viewName, $data = [])
    {
        $view = View::make("{$this->viewBase}.{$viewName}", $data);
        $this->layout->content = $view;
        return $view;
    }

    protected function currentUser()
    {
        if (! $this->currentUser) {
            $this->currentUser = Auth::user() ?: new Guest();
        }

        return $this->currentUser;
    }

    protected function currentOrg()
    {
        if (! $this->currentOrg) {
            $this->currentOrg = $this->currentUser()->organization;
        }

        return $this->currentOrg;
    }
}
