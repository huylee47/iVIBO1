<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;
    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }
    // public function index(){
    //     return $this->taskService->indexId();
    // }
}
