<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\CheckLogService;
class CheckLogController extends Controller
{
    private $checkLogService;
    public function __construct(CheckLogService $checkLogService)
    {
        $this->checkLogService = $checkLogService;
    }
    public function index(){
       return $this->checkLogService->index();
    }
}
