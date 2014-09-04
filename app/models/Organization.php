<?php

class Organization extends Eloquent
{
    protected static $vendor;

    protected $fillable = ['name'];

    public static function vendor()
    {
        static::$vendor || static::$vendor = static::find(1);
        return static::$vendor;
    }

    public function users()
    {
        return $this->hasMany('User');
    }

    public function todos()
    {
        return $this->hasManyThrough('Todo', 'User')->with('user');
    }

    public function isVendor()
    {
        return $this->id === static::vendor()->id;
    }
}
