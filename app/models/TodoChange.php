<?php

class TodoChange
{
    use FormObject;

    protected $todo;
    protected $user;

    public function __construct($user, $todo, $params)
    {
        $this->user          = $user;
        $this->todo          = $todo;

        $this->todo->fill($params);

        $this->validator = Validator::make($this->todo->toArray(), ['name' => 'required']);

    }

    public function save()
    {
        $success = false;

        if ($this->isValid()) {
            $success = $this->todo->save();
        }

        return $success;
    }

    public function getTodo()
    {
        return $this->todo;
    }
}
