<?php

class Todo extends Eloquent
{
    protected $fillable = ['name', 'completed', 'created_at'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function allForUser($user)
    {
        return static::with('user')->orderBy('created_at')->get();
    }

    public function scopeForUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function getCompletedAttribute($value)
    {
        return (bool)$value;
    }

    public function __toString()
    {
        return $this->name;
    }
}
