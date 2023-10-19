<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use DateTime;

class ScheduleController extends BaseController
{
    public function show() {

        $options =array(
            'http' =>array(
                    'method' => 'GET',
                    'header' => 'User-Agent: Mixtend Coding Test',
                    )
            );

        $res = file_get_contents('https://mixtend.github.io/schedule.json', false, stream_context_create($options));
        $aryRes = json_decode($res, true);
        $workingHourStart = explode(":", $aryRes['working_hours']['start'])[0];
        $workingHourEnd = explode(":", $aryRes['working_hours']['end'])[0];
        $aryWorkingHours = range($workingHourStart, $workingHourEnd);

        $week = array( "日", "月", "火", "水", "木", "金", "土" );
        $aryDate = [];
        $aryMeetings = [];
        foreach ($aryRes['meetings'] as $date => $meetings) {
            $dateTime = new DateTime($date);
            $strDate = $dateTime->format("n/j (") . $week[$dateTime->format('w')] . ")";
            $aryDate[] = $strDate;
            foreach($meetings as $meeting) {
                $aryMeetings[] = [
                    'start' => $strDate . str_replace(':', '', $meeting['start']),
                    'summary' => $meeting['summary']
                ];
            }   
        }

        return view('schedule', [
            'aryWorkingHours' => $aryWorkingHours,
            'aryDate' => $aryDate,
            'aryMeetings' => $aryMeetings
        ]);
    }
}
