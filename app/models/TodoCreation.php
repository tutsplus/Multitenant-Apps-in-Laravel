<?php

class TodoCreation
{
    use FormObject;

    protected $todo;
    protected $user;
    protected $params;

    public function __construct($user, $org, $params)
    {
        $this->user      = $user;
        $this->params    = $params;
        $this->todo      = new Todo($params);
        $this->validator = Validator::make($params, ['name' => 'required']);
        $this->todo->organization_id = $org->id;
    }

    public function save()
    {
        $success = false;

        if ($this->isValid()) {
            $this->user->todos()->save($this->todo);
            $success = (bool) $this->todo;
        }

        return $success;
    }

    public function getTodo()
    {
        return $this->todo;
    }
}
