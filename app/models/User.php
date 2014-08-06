<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden   = ['password', 'remember_token'];
    protected $fillable = ['email', 'name', 'password'];

    public function todos()
    {
        return $this->hasMany('Todo')->orderBy('created_at');
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function getAdminAttribute($value)
    {
        return (bool) $value;
    }

    public function __toString()
    {
        return $this->name;
    }
}
