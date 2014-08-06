<?php

class TodoValidator
{
    protected $validator;
    protected $rules = [
        'name'    => 'required',
        'user_id' => 'required',
    ];

    public function __construct($params)
    {
        $this->params    = $params;
        $this->validator = $this->buildValidator();
    }

    public function isValid()
    {
        return $this->validator->passes();
    }

    public function getErrors()
    {
        return $this->validator->messages();
    }

    protected function buildValidator()
    {
        return Validator::make($this->params, $this->rules);
    }
}
