<?php

namespace App\Services;

use App\Models\UserTransaction;

class SummaryService
{

    /**
     * @param string $from
     * @param string $to
     * @return array
     */
    public function calculateSumInDays(string $from, string $to)
    {
        $result = [];
        $firstTransaction = UserTransaction::find(1);
        if (!$firstTransaction) {
            return [];
        }
        if ($from != '') {
            $dateFromUnixTime = strtotime($from . ' 00:00:00');
        } else {
            $dateFromUnixTime = UserTransaction::firstDayStart($firstTransaction->created_at);
        }

        if ($to != '') {
            $dateToUnixTime = strtotime($to . " 23:59:59");
        } else {
            $dateToUnixTime = time();
        }

        for ($i = $dateFromUnixTime; $i < $dateToUnixTime; $i += UserTransaction::daySecondsCount) {
            $sum = UserTransaction::calculateSumPeriod(date('Y-m-d H:s:i', $i), date('Y-m-d H:s:i', $i + UserTransaction::daySecondsCount));
            $day = date('d-m', $i);
            $result[$day] = $sum;
        }

        return $result;

    }
}
