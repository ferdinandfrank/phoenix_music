<?php

namespace App\Utils;

use App;
use Carbon\Carbon;
use Lang;

/**
 * LocalDate
 * -----------------------
 * Date class to present readable dates.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Utils
 */
class LocalDate extends Carbon {

    /**
     * Format the instance as date and time.
     *
     * @return string
     */
    public function toDateTimeString() {
        return $this->formatLocalized('%d %b %y') . ' (' . $this->toTimeString() . ')';
    }

    /**
     * Format the instance as time.
     *
     * @return string
     */
    public function toTimeString() {
        $time = $this->format('H:i');
        if (App::isLocale('en')) {
            $time = $this->format('h:i');
        }
        if ($this->hour > 12) {
            return $time . ' ' . Lang::get('date.afternoon_suffix');
        }

        return $time . ' ' . Lang::get('date.morning_suffix');
    }

    /**
     * Format the instance as an age integer.
     *
     * @return int
     */
    public function toAge() {
        return static::now()->diffInYears($this);
    }

    /**
     * Format the instance as an localized date string.
     *
     * @return string
     */
    public function toDateString() {
        return $this->formatLocalized('%d %B %Y');
    }

    /**
     * Format the instance as an localized date string including the weekday.
     *
     * @return string
     */
    public function toWeekDateString() {
        return $this->formatLocalized('%A, %d %b, %Y');
    }

    /**
     * Format the instance as a range of date and time, where the instance is treated as the date range start and the
     * give parameter as the range end.
     *
     * @param LocalDate $endDate
     *
     * @return string
     */
    public function toDateTimeRangeString(LocalDate $endDate) {
        if ($this->isSameDay($endDate)) {
            return $this->toDateString() . ' (' . $this->toTimeString() . ' - ' . $endDate->toTimeString() . ')';
        }

        return $this->toDateTimeString() . ' - ' . $endDate->toDateTimeString();
    }

    /**
     * Get the difference in a human readable format in the current locale.
     * When comparing a value in the past to default now:
     * 1 hour ago
     * 5 months ago
     * When comparing a value in the future to default now:
     * 1 hour from now
     * 5 months from now
     * When comparing a value in the past to another value:
     * 1 hour before
     * 5 months before
     * When comparing a value in the future to another value:
     * 1 hour after
     * 5 months after
     *
     * @param Carbon|null $other
     * @param bool        $absolute removes time difference modifiers ago, after, etc
     *
     * @return string
     */
    public function diffForHumans(Carbon $other = null, $absolute = false) {
        $isNow = $other === null;

        if ($isNow) {
            $other = static::now($this->tz);
        }

        $diffInterval = $this->diff($other);

        switch (true) {
            case ($diffInterval->y > 0):
                $unit = 'year';
                $count = $diffInterval->y;
                break;

            case ($diffInterval->m > 0):
                $unit = 'month';
                $count = $diffInterval->m;
                break;

            case ($diffInterval->d > 0):
                $unit = 'day';
                $count = $diffInterval->d;
                if ($count >= self::DAYS_PER_WEEK) {
                    $unit = 'week';
                    $count = (int)($count / self::DAYS_PER_WEEK);
                }
                break;

            case ($diffInterval->h > 0):
                $unit = 'hour';
                $count = $diffInterval->h;
                break;

            case ($diffInterval->i > 0):
                $unit = 'minute';
                $count = $diffInterval->i;
                break;

            default:
                $count = $diffInterval->s;
                $unit = 'second';
                break;
        }

        if ($count === 0) {
            $count = 1;
        }

        if ($absolute) {
            return Lang::choice("date.count_$unit", $count, ['count' => $count]);
        }

        $isFuture = $diffInterval->invert === 1;

        $transId = $isNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        return Lang::choice('date.' . $unit . '_' . $transId, $count, ['count' => $count]);
    }

    /**
     * Gets the day string in a readable format.
     *
     * @return array|null|string
     */
    public function dayDiffForHumans() {
        if ($this->isToday()) {
            return Lang::get('date.today');
        } elseif ($this->isTomorrow()) {
            return Lang::get('date.tomorrow');
        } elseif ($this->isYesterday()) {
            return Lang::get('date.yesterday');
        }

        return $this->toDateString();
    }
}