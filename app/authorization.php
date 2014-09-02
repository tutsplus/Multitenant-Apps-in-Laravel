<?php

$canI = new CanI\CanI(Auth::user());

if (Auth::check()) {
    if (Auth::user()->isAdmin()) {
        $canI->allow('invite', 'User');
        $canI->allow('manage', 'User');
        $canI->allow('manage', 'Todo');
    } else {
        $canI->allow('manage', 'User', function($user) {
            return $this->getUser()->id === $user->id;
        });

        $canI->allow('manage', 'Todo', function($todo) {
            return $this->getUser()->id === $todo->user_id;
        });
    }
}

App::instance('canI', $canI);
