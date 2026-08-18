<?php

namespace App\Http\Requests\Api\V1\Projects;

use App\Enums\ProjectPriority;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $project = $this->route('project');

        return $project instanceof Project
            && ($this->user()?->can('update', $project) ?? false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique(Project::class)->ignore($this->route('project')),
            ],
            'type' => ['sometimes', 'required', Rule::in(['web', 'mobile', 'desktop', 'api', 'frontend', 'other'])],
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date' => ['sometimes', 'required', 'date', 'after_or_equal:start_date'],
            'deadline' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
            'duration' => ['sometimes', 'required', 'integer', 'min:1'],
            'status' => ['sometimes', Rule::enum(ProjectStatus::class)],
            'priority' => ['sometimes', Rule::enum(ProjectPriority::class)],
        ];
    }
}
