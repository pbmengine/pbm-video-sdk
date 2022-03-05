<?php

namespace Pbmengine\Video\Concerns;

use Pbmengine\Video\DTO\ProjectData;
use Pbmengine\Video\Resources\Project;

trait HandleProjects
{
    public function projects(): array
    {
        $response = $this->handleResponse(
            $this->getClient()->get('projects' . $this->getQueryString())
        );

        return $this->transformCollection(
            $response->json()['data'],
            Project::class,
            ProjectData::class
        );
    }

    public function project($id): Project
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$id}")
        );

        return $this->transformItem(
            $response->json()['data'],
            Project::class,
            ProjectData::class);
    }

    public function projectLogs($id): array
    {
        return $this->handleResponse(
            $this->getClient()->get("projects/{$id}/eventlogs")
        )->json();
    }

    public function projectStatistics($id): array
    {
        return $this->handleResponse(
            $this->getClient()->get("projects/{$id}/statistics")
        )->json();
    }

    public function createProject(
        string $name,
        ?string $identifier = null,
        ?string $description = null
    ): Project
    {
        $data = ['name' => $name];

        if ($identifier) {
            $data['identifier'] = $identifier;
        }

        if ($description) {
            $data['description'] = $description;
        }

        $response = $this->handleResponse(
            $this->getClient()->post('projects', $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Project::class,
            ProjectData::class
        );
    }

    public function updateProject($id, array $data): Project
    {
        $response = $this->handleResponse(
            $this->getClient()
                ->put("projects/{$id}", $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Project::class,
            ProjectData::class);
    }

    public function deleteProject($id): string
    {
        $this->handleResponse(
            $this->getClient()->delete("projects/{$id}")
        );

        return $id;
    }
}
