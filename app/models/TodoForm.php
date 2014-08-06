<?php

class TodoForm
{
    protected $todo;
    protected $user;
    protected $params;
    protected $validator;

    public function __construct($params, $user, $todo)
    {
        $this->user          = $user;
        $this->params        = $params;
        $this->todo          = $todo;
        $this->todo->user_id = $this->user->id;
        $this->validator     = new TodoValidator(array_merge($this->todo->toArray(), $params));

        $this->todo->fill($this->params);
    }

    public function save()
    {
        if ($this->isValid()) {
            return (bool) $this->todo->save();
        }

        return false;
    }

    public function isValid()
    {
        return $this->validator->isValid();
    }

    public function getErrors()
    {
        return $this->validator->getErrors();
    }

    public function getTodo()
    {
        return $this->todo;
    }

    public function getValidator()
    {
        return $this->validator;
    }
}
