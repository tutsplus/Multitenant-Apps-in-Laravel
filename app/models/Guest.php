<?php

use Illuminate\Auth\UserInterface;

class Guest implements UserInterface
{
    public $id;
    public $name;
    public $exists = false;

    public function toArray()
    {
        return ['id' => $this->id, 'name' => $this->name];
    }

	public function getAuthIdentifier() {}
	public function getAuthPassword() {}
	public function getRememberToken() {}
	public function setRememberToken($value) {}
	public function getRememberTokenName() {}
}

