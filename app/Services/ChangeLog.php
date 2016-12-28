<?php

namespace App\Services;

use App\Models\Commit;
use App\Utils\LocalDate;
use Illuminate\Support\Collection;

/**
 * ChangeLog
 * -----------------------
 * Service class to receive the latest git commits.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Services
 */
class ChangeLog {

    /**
     * Fetches the latest unique git commits.
     *
     * @param int $count The number of results to retrieve.
     *
     * @return Collection
     */
    public static function get($count = 10) {
        $output = [];
        exec("git log -$count" , $output);

        return collect(self::parseLog($output));
    }

    private static function parseLog($log) {

        $changeLog = [];
        $commit = new Commit();
        foreach ($log as $key => $line) {

            if (strpos($line, 'commit') === 0 || $key == count($log)) {
                if ($commit->id != null) {
                    $commit->message = substr($commit->message, 4);

                    // Only add if commit message is not equal to the last one
                    if (empty($changeLog) || $commit->message != $changeLog[sizeof($changeLog) - 1]->message) {
                        array_push($changeLog, $commit);
                    }

                    $commit = new Commit();
                }
                $commit->id = substr($line, strlen('commit') + 1);
            } else if (strpos($line, 'Author') === 0) {
                $commit->author = substr($line, strlen('Author:') + 1);
            } else if (strpos($line, 'Date') === 0) {
                $commit->date = LocalDate::parse(substr($line, strlen('Date:') + 3));
            } elseif (strpos($line, 'Merge') === 0) {
                $commit->merge = substr($line, strlen('Merge:') + 1);
                $commit->merge = explode(' ', $commit->merge);
            } else {
                if (isset($commit->message)) {
                    $commit->message .= $line;
                } else {
                    $commit->message = $line;
                }
            }
        }

        return $changeLog;
    }

}