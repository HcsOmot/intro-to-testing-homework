<?php
/**
 * Created by PhpStorm.
 * User: latz
 * Date: 06.12.17.
 * Time: 13:40
 */

class DateTimeFactory
{
    public function getDaysAgo(Int $daysAgo, $today = null)
    {
        if(!$today) {
            $today = new \DateTime();
        }

        return $today->sub(new DateInterval('P'. $daysAgo . 'D'))->format('Y-m-d');
    }
}