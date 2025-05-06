<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'entity_id'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_team')
            ->withPivot('role', 'total_xp')
            ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

}
