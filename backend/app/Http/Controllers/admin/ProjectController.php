<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService){
        $this->projectService = $projectService;
    }
    
}
