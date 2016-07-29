<?php

namespace App\SocialMedia\Stats;

use Carbon\Carbon;

class Metrics
{
    public function countFor($platform)
    {
        $count = auth()->user()->socialMediaStats()->latest()->value($platform);

        if ( ! $count) return 0;

        return $count;
    }

    public function percentageFor($platform)
    {
        $count = $this->countFor($platform);

        $yesterdayCount = auth()->user()->socialMediaStats()->latest()->where('created_at', '<', Carbon::today())->value($platform);

        if( ! $yesterdayCount) return $count;

        return ceil((($count - $yesterdayCount) / $yesterdayCount) * 100);
    }
}