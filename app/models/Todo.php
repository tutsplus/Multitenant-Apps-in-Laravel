<?php

class Todo extends Eloquent
{
    protected $fillable = ['name', 'completed', 'created_at'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function scopeWithUsers($query)
    {
        return $query->with('user')->orderBy('created_at');
    }

    public function scopeForOrganization($query, $org)
    {
        return $query->withUsers()
            ->whereIn('user_id', $org->users()->lists('id'));
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
