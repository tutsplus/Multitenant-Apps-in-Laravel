<?php

class UserRecordValidator
{
    protected $validator;
    protected $rules = [
        'name'  => 'required',
        'email' => 'required|email|unique:users,email',
    ];

    public function __construct($params)
    {
        $this->params    = $params;
        $this->setUniqueness();
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
        $validator = Validator::make($this->params, $this->rules);

        $validator->sometimes('password', 'required|min:8|confirmed', function($input) {
            return ! $input->id || $input->password;
        });

        return $validator;
    }

    protected function setUniqueness()
    {
        if (isset($this->params['id'])) {
            $this->rules['email'] = "{$this->rules['email']},{$this->params['id']}";
        }

        return $this;
    }
}
