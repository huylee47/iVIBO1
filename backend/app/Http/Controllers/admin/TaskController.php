<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;
    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }
    public function index(){
        return $this->taskService->index();
    }
    public function adjustTime(Request $request ,$id ){
        return $this->taskService->adjustTime($request ,$id);
    }
    public function indexId(){
        return $this->taskService->indexId();
    }
}
