<?php

class TodoCreation
{
    use FormObject;

    protected $todo;
    protected $user;
    protected $params;

    public function __construct($user, $params)
    {
        $this->user      = $user;
        $this->params    = $params;
        $this->todo      = new Todo($params);
        $this->validator = Validator::make($params, ['name' => 'required']);
    }

    public function save()
    {
        $success = false;

        if ($this->isValid()) {
            $this->user->todos()->insert($this->todo);
            $success = (bool) $this->todo;
        }

        return $success;
    }

    public function getTodo()
    {
        return $this->todo;
    }
}
