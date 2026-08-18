<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'type' => $this->type,
            'status' => $this->status,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'files_count' => $this->files_count,
            'tasks' => $this->whenLoaded('tasks', fn ($q) => TaskResource::collection($this->tasks)),
            'teams' => $this->whenLoaded('teams', fn ($q) => $this->teams
                ->map(fn ($team): array => [
                    'id' => $team->id,
                    'name' => $team->name,
                ])
                ->values()),
            'members' => $this->whenLoaded('members', fn ($q) => $this->members
                ->map(fn ($member): array => [
                    'id' => $member->id,
                    'name' => $member->name,
                    'email' => $member->email,
                    'role' => $member->pivot->role->value,
                ])
                ->values()),
            'files' => $this->whenLoaded('files', fn ($q) => FileResource::collection($this->files)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
