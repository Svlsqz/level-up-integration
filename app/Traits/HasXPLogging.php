<?php

namespace App\Traits;

use App\Models\XPLog;
use LevelUp\Experience\Models\Experience;

trait HasXPLogging
{
    public function addPoints(int $amount, ?string $reason = null, $source = null): void
    {
        $this->addPointsBase($amount);

        XPLog::create([
            'user_id' => $this->id,
            'points' => $amount,
            'reason' => $reason,
            'source_type' => $source ? get_class($source) : null,
            'source_id' => $source?->id,
        ]);
    }

    public function deductPoints(int $amount, ?string $reason = null, $source = null): void
    {
        $this->deductPointsBase($amount);

        XPLog::create([
            'user_id' => $this->id,
            'points' => -$amount,
            'reason' => $reason,
            'source_type' => $source ? get_class($source) : null,
            'source_id' => $source?->id,
        ]);
    }
}
