<?php

class UserAdminRegistration
{
    protected $user;
    protected $params;
    protected $validator;
    protected $requirePassword;

    public function __construct($params, $user)
    {
        $this->user      = $user;
        $this->params    = $params;
        $mergedParams    = array_merge($this->user->toArray(), $params);
        $this->validator = new UserRecordValidator($mergedParams);

        $this->cleanParams();
    }

    public function save()
    {
        $this->user->fill($this->params);

        if ($this->isValid()) {
            return (bool) $this->user->save();
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

    public function getUser()
    {
        return $this->user;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    protected function requirePassword()
    {
        if ($this->requirePassword === null) {
            $this->requirePassword = (isset($this->params['password']) && $this->params['password'] !== '') || ! $this->user->exists;
        }

        return $this->requirePassword;
    }

    protected function cleanParams()
    {
        if (! $this->requirePassword()) {
            unset($this->params['password']);
        }

        unset($this->params['password_confirmation']);
    }

}
