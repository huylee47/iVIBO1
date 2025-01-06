<?php
namespace App\Service;

use App\Models\check_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

Class TimeKeepingService{
    public $officeLatitude = 20.838185590254955;
    public $officeLongitude = 106.71405281225722;
    public $allowedDistance = 50;

    public function checkIn(Request $request)
    {
        $currentHour = Carbon::now()->format('H'); 

        if ($currentHour < 7 || $currentHour > 19) {
            return response()->json(
                ['message' => 'Chấm công không hợp lệ.'], 
                400,
                [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
        $user = Auth::user();
        $userLatitude = $request->latitude;
        $userLongitude = $request->longitude;

        $distance = $this->calculateDistance($this->officeLatitude, $this->officeLongitude, $userLatitude, $userLongitude);

        if ($distance <= $this->allowedDistance) {
            check_log::create([
                'user_id' => $user->id,
            ]);

            return response()->json(
                [
                    'message' => 'Check-in thành công!',
                    'user'=>$user->name],
                    200,
                    [],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );
        } else {
            return response()->json(['message' => 'Bạn không nằm trong phạm vi check-in cho phép.'], 400,[], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    { 
        $earthRadius = 6371000; 

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

}
