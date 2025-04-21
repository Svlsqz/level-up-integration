<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class XPLog extends Model
{
    protected $fillable = ['user_id', 'points', 'reason', 'source_type', 'source_id'];
    protected $table = 'xp_logs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function source(): MorphTo
    {
        return $this->morphTo();
    }
}
