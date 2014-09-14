<?php

use Illuminate\Support\Fluent;

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
        return $this->belongsToMany('User')->withTimestamps();
    }

    public function todos()
    {
        return $this->hasMany('Todo')->with('user');
    }

    public function isVendor()
    {
        return $this->id === static::vendor()->id;
    }

    public function getDataAttribute($value)
    {
        $data = $value ? json_decode($value, true) : [];
        return new Fluent($data);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function getCssAttribute($value)
    {
        return new Fluent($this->data->css ?: []);
    }

    public function setCssAttribute($value)
    {
        $this->data = array_merge($this->data->toArray(), ['css' => $value]);
    }
}
