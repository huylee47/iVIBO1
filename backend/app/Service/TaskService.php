<?php

namespace App\Service;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService {
    public function index(){
        $tasks = Task::with('project:id,project_name', 'status:id,status_name', 'user:id,name')->get();
        $formatTask = $tasks->map(function($task){
            $userNames = $task->user->pluck('name')->toArray();  
            return [
                'task' => $task->task_name,
                'project' => $task->project ? $task->project->project_name : null,
                'status' => $task->status ? $task->status->status_name : null,
                'users' => $userNames, 
                'description' => $task->description,
                'start_time' => $task->start_time,
                'end_time' => $task->end_time,
            ];
        });

        return response()->json($formatTask, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function indexId(){
        $user = Auth::user();
        $userId = $user->id;
        $tasks = Task::with('user:id,name', 'project:id,project_name', 'status:id,status_name')
        ->whereHas('user', function ($query) use ($userId) {
            // Chỉ lấy các task mà user hiện tại tham gia
            $query->where('user_id', $userId);
        })
        ->get();

    $formatTask = $tasks->map(function ($task) {
        return [
            'task' => $task->task_name,
            'project' => $task->project ? $task->project->project_name : null,
            'status' => $task->status ? $task->status->status_name : null,
            'user' => $task->user->pluck('name')->join(', '), // Dùng pluck để lấy tên người dùng
            'start_time' => $task->start_time,
            'end_time' => $task->end_time,
        ];
    });

    return response()->json($formatTask, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function store(TaskRequest $request){
        $task = Task::create([
            'task_name' => $request->task_name,
            'project_id' => $request->project_id,
            'status_id' => $request->status_id,
            'user_id' => $request->user_id,
           'start_time'=> $request->start_time,
            'end_time'=> $request->end_time,
        ]);
        return response()->json($task);
    }
    // public function show($id){
    //     $task = Task::with('project:id,project_name','status:id,status_name','user:id,name')->findOrFail($id);
    //     return response()->json([
    //             'task_name' => $task->task_name,
    //             'project' => $task->project? $task->project->project_name : null,
    //             'user' => $task->user? $task->user->name : null,
    //             'status' => $task->status ? $task->status->status_name : null,
    //             'start_time'=> $task->start_time,
    //             'end_time'=> $task->end_time,
    //         ]);
    // }

}