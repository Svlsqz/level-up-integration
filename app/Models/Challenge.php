<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'entity_id',
        'xp_reward',
        'status',
        'deadline',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
