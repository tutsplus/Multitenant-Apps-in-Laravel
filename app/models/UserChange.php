<?php

class UserChange
{
    use FormObject;

    protected $user;
    protected $params;

    public function __construct($user, $params)
    {
        $this->user   = $user;
        $this->params = $this->cleanParams($params);

        $this->validator = Validator::make($params, [
            'name'  => 'required',
            'email' => "required|email|unique:users,email,{$user->id}",
        ]);
        $this->validator->sometimes('password', 'required|min:8|confirmed', function($input) {
            return $input->password;
        });
    }

    public function save()
    {
        $success = false;
        $this->user->fill($this->params);

        if ($this->isValid()) {
            $success = $this->user->save();
        }

        return $success;
    }

    public function getUser()
    {
        return $this->user;
    }

    protected function cleanParams($params)
    {
        if (isset($params['password']) && ! $params['password']) {
            unset($params['password']);
            unset($params['password_confirmation']);
        }

        return $params;
    }
}
