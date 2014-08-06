<?php

class BaseController extends Controller
{
    protected $layout = 'layouts.application';
    protected $viewBase = '';

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
}
