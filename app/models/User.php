<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table    = 'users';
    protected $hidden   = ['password', 'remember_token'];
    protected $fillable = ['email', 'name', 'password'];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            if ($model->isDirty('password')) {
                $model->password = Hash::make($model->password);
            }
        });
    }

    public function organizations()
    {
        return $this->belongsToMany('Organization')->withTimestamps();
    }

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

    public function delete()
    {
        foreach ($this->todos as $todo) {
            $todo->delete();
        }

        $user->organizations()->detach();

        parent::delete();
    }

    public function __toString()
    {
        return $this->name;
    }
}
