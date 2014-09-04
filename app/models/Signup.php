<?php

class Signup
{
    use FormObject;

    protected $org;
    protected $user;
    protected $params;

    public function __construct($params)
    {
        $this->user = new User;
        $this->org  = new Organization;
        $this->params = $params;

        $this->validator = Validator::make($params, [
            'organization_name' => 'required|unique:organizations,name',
            'name'              => 'required',
            'email'             => 'required|email',
            'password'          => 'required|min:8|confirmed'
        ]);
    }

    public function save()
    {
        if ($this->isValid()) {
            $this->org->name = $this->params['organization_name'];

            $this->user->admin  = true;
            $this->user->active = true;
            $this->user->fill([
                'name'     => $this->params['name'],
                'email'    => $this->params['email'],
                'password' => $this->params['password'],
            ]);

            $this->org->save();
            $this->org->users()->save($this->user);

            return true;
        }

        return false;
    }

    public function getUser()
    {
        return $this->user;
    }
}
