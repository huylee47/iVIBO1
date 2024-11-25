<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\TimeKeepingService;
use Illuminate\Http\Request;

class TimeKeepingController extends Controller
{
    private $timekeepingService;

    public function __construct(TimeKeepingService $timekeepingService){
        $this->timekeepingService = $timekeepingService;
    }
    public function checkIn(Request $request){
        return $this->timekeepingService->checkIn($request);
    }
}
