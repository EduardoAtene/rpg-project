<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatDateTime(?string $date, string $format = 'd/m/Y H:i'): ?string
    {
        if (!$date) {
            return null;
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }
}
