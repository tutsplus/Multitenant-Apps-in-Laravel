<?php

class UserInvite
{
    use FormObject;

    protected $user;

    public function __construct($email)
    {
        $params          = ['email' => $email];
        $this->user      = new User($params);
        $this->validator = Validator::make($params, [
            'email' => 'required|email|unique:users,email'
        ]);
    }

    public function save()
    {
        $success = false;
        $this->user->password = $this->user->email.time();
        $this->user->active   = false;

        if ($this->isValid()) {
            $success = (bool) $this->user->save();
        }

        return $success;
    }

    public function getUser()
    {
        return $this->user;
    }
}
