<?php

namespace Pbmengine\Video\Concerns;

use Pbmengine\Video\DTO\TemplateData;
use Pbmengine\Video\Resources\Template;

trait HandleTemplates
{
    public function templates($projectId): array
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/templates" . $this->getQueryString())
        );

        return $this->transformCollection(
            $response->json()['data'],
            Template::class,
            TemplateData::class
        );
    }

    public function template($id, $projectId): Template
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/templates/{$id}")
        );

        return $this->transformItem(
            $response->json()['data'],
            Template::class,
            TemplateData::class);
    }

    public function createTemplate($projectId, array $data): Template
    {
        $response = $this->handleResponse(
            $this->getClient()->post('projects/' . $projectId . '/templates', $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Template::class,
            TemplateData::class);
    }

    public function updateTemplate($id, $projectId, array $data): Template
    {
        $response = $this->handleResponse(
            $this->getClient()
                ->put("projects/{$projectId}/templates/{$id}", $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Template::class,
            TemplateData::class);
    }

    public function deleteTemplate($id, $projectId): string
    {
        $this->handleResponse(
            $this->getClient()->delete("projects/{$projectId}/templates/{$id}")
        );

        return $id;
    }
}
