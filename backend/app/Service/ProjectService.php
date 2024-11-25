<?php

namespace App\Service;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
class ProjectService {
    public function index(){
        $projects = Project::with('status:id,status_name ')->get();
        return response()->json($projects->map(function( $project){
            return [
                'id' => $project->id,
                'project_name' => $project->project_name,
                'status' => $project->status ? $project->status->status_name : null,
            ];
        }));
    }
    public function store(ProjectRequest $request){
        $project = Project::create( 
            [
                'project_name' => $request->project_name,
            ]
        );
        return response()->json($project);
    }
}