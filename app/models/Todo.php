<?php

class Todo extends Eloquent
{
    protected $fillable = ['name', 'completed', 'created_at'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function organization()
    {
        return $this->belongsTo('Organization');
    }

    public function scopeWithUsers($query)
    {
        return $query->with('user')->orderBy('created_at');
    }

    public function scopeForOrganization($query, $org)
    {
        return $query->withUsers()->where('organization_id', $org->id);
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
