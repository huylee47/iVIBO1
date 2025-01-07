<?php

namespace App\Service\ProjectService;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectService
{
    public function index(Request $request)
    {
        $filterService = new ProjectFilterService();
        $filterConditions = $filterService->transform($request);

        // Retrieve projects based on filter conditions
        $query = Project::query();

        if (!empty($filterConditions)) {
            $query->where($filterConditions);
        }

        $projects = $query->get(); // Execute query to fetch results
        $projectResources = ProjectResource::collection($projects);
        return response()->json($projectResources);
    }


    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        try {
            return response()->json([
                'success' => true,
                'data' => $project,
                'message' => 'Project found',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find project by ID ' . $id . ": " . $e->getMessage(),
            ], 500);
        }
    }

    public function store(ProjectRequest $request)
    {
        $project = $request->all();
        $project["status_id"] = 0;//newly created
        try {
            $project = Project::create($project);
            return response()->json([
                'success' => true,
                'data' => $project,
                'message' => 'Project created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create project. ' . $e->getMessage(),
            ], 500);
        }
    }
}
