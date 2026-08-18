<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Projects\StoreProjectRequest;
use App\Http\Requests\Api\V1\Projects\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(private ProjectService $service) {}

    /**
     * List all projects
     */
    public function index()
    {

        $projects = $this->service->getAllProjects(Auth::user());

        return $this->successResponse(
            data: ProjectResource::collection($projects),
            message: 'Projects fetched successfully',
        );
    }

    /**
     * Show Project Details
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project = $this->service->showProject(Auth::user(), $project);

        return $this->successResponse(
            data: new ProjectResource($project),
            message: 'Project fetched Successfully',
        );
    }

    /**
     * Create the Project
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->service->createProject(Auth::user(), $request->validated());

        return $this->successResponse(
            data: new ProjectResource($project),
            message: 'Project created Successfully',
        );
    }

    /**
     * Update the Project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project = $this->service->updateProject(Auth::user(), $project, $request->validated());

        return $this->successResponse(
            data: new ProjectResource($project),
            message: 'Project updated Successfully',
        );

    }
}
