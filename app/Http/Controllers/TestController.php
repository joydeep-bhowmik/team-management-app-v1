<?php

namespace App\Http\Controllers;

use App\Models\AttendenceRequest;

class TestController extends Controller
{
    public function __invoke()
    {

        $attrende_requests = AttendenceRequest::where('status', 'approved')->where('type', 'checkout')->get();

        foreach ($attrende_requests as $attendenceRequest) {

            $attendence = Attendence::whereDate('out_time', Carbon::parse($attendenceRequest->time))
                ->where('user_id', $attendenceRequest->user_id)
                ->first();
            if ($attendence) {
                $attendence->user_id = $attendenceRequest->user_id;

                $attendence->created_at = $attendenceRequest->created_at;

                $attendence->updated_at = $attendenceRequest->updated_at;

                $attendence->save();
            }

        }
    }
}
