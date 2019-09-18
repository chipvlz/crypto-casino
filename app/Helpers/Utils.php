<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Utils
{
    /**
     * Get a daily time series of a given size
     *
     * @param $size
     * @return Collection
     */
    public static function timeSeries($size): Collection
    {
        $timeSeries = new Collection();

        for ($i=$size; $i>=0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $timeSeries->put($date, [
                'date'      => $date,
                'value'     => 0
            ]);
        }

        return $timeSeries;
    }
}