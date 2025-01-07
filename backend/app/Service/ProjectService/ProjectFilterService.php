<?php
namespace App\Service\ProjectService;
use App\Service\CommonServices\QueryFilterService;

class ProjectFilterService extends QueryFilterService{
    protected $safeParams = [
        "id"=>["eq","lt","lte","gt","gte","neq"],
        "project_name"=>["eq","neq"],
        "status_id"=>["eq","lt","lte","gt","gte","neq"],
        "deleted_at"=>["eq","lt","lte","gt","gte","neq"],
        "created_at"=>["eq","lt","lte","gt","gte","neq"]
    ];
}
