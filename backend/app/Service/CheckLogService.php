<?php

namespace App\Service;

use App\Models\check_log;
use Carbon\Carbon;

class CheckLogService {
    public function index() {
        $check_logs = check_log::with('user:id,name')
            ->whereTime('created_at', '>=', '07:00:00')
            ->whereTime('created_at', '<=', '19:00:00')
            ->orderBy('user_id')
            ->orderBy('created_at')
            ->get();
        $userLogs = $check_logs->groupBy(function ($log) {
            return $log->user_id . '_' . $log->created_at->format('Y-m-d');
        })->map(function ($logs, $key) {
            $totalHours = 0;

            if ($logs->count() === 1) {
                $userId = $logs->first()->user_id;
                $userName = $logs->first()->user->name ?? null;
                $date = $logs->first()->created_at->format('Y-m-d');

                return [
                    'user_id' => $userId,
                    'user_name' => $userName,
                    'date' => $date,
                    'is_fulfilled' => false,
                    'message' => 'Chưa check out',
                ];
            }

            for ($i = 1; $i < $logs->count(); $i++) {
                $previousLog = $logs[$i - 1]->created_at;
                $currentLog = $logs[$i]->created_at;

                $diffInHours = $previousLog->diffInHours($currentLog);
                $totalHours += $diffInHours;
            }

            $userId = $logs->first()->user_id;
            $userName = $logs->first()->user->name ?? null;
            $date = $logs->first()->created_at->format('Y-m-d');

            $isFulfilled = $totalHours >= 8;

            return [
                'user_id' => $userId,
                'user_name' => $userName,
                'total_hours' => round($totalHours,2    ),
                'date' => $date,
                'is_fulfilled' => $isFulfilled,
                'message' => $isFulfilled ? 'Đã đủ 8 tiếng' : 'Chưa đủ 8 tiếng',
            ];
        });

        return response()->json($userLogs->values());
    }
}


