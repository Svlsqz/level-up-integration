<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LevelUp\Experience\Concerns\GiveExperience;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, GiveExperience;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'entity_id',
        'is_visible',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_visible' => 'boolean',
        ];
    }

    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }
}
