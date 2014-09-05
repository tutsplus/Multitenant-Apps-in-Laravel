<?php

class UserInvite
{
    use FormObject;

    protected $user;
    protected $org;

    public function __construct($email, $org)
    {
        $params          = ['email' => $email];
        $this->user      = new User($params);
        $this->org       = $org;
        $this->validator = Validator::make($params, [
            'email' => 'required|email|unique:users,email'
        ]);
    }

    public function save()
    {
        $success = false;
        $this->user->password        = $this->user->email.time();
        $this->user->active          = false;

        if ($this->isValid()) {
            $success = (bool) $this->user->save();
            $this->user->organizations()->attach($this->org->id);
        }

        return $success;
    }

    public function getUser()
    {
        return $this->user;
    }
}
