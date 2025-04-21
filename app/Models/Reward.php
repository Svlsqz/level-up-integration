<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'name',
        'description',
        'required_level',
        'type',
        'entity_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
