<?php

namespace Pbmengine\Video\Concerns;

use Pbmengine\Video\DTO\VideoData;
use Pbmengine\Video\DTO\VideoStatusData;
use Pbmengine\Video\Resources\Video;
use Pbmengine\Video\Resources\VideoStatus;

trait HandleVideos
{
    public function videos($projectId): array
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/videos" . $this->getQueryString())
        );

        return $this->transformCollection(
            $response->json()['data'],
            Video::class,
            VideoData::class
        );
    }

    public function video($id, $projectId): Video
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/videos/{$id}")
        );

        return $this->transformItem(
            $response->json()['data'],
            Video::class,
            VideoData::class);
    }

    public function videoStatus($id, string $projectId): VideoStatus
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/videos/{$id}/status")
        );

        return $this->transformItem(
            $response->json()['data'],
            VideoStatus::class,
            VideoStatusData::class);
    }

    public function createVideo($projectId, $templateId, string $name, array $data): Video
    {
        $data['template_id'] = $templateId;
        $data['name'] = $name;

        $response = $this->handleResponse(
            $this->getClient()->post('projects/' . $projectId . '/videos', $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Video::class,
            VideoData::class);
    }

    public function deleteVideo($id, $projectId): string
    {
        $this->handleResponse(
            $this->getClient()->delete("projects/{$projectId}/videos/{$id}")
        );

        return $id;
    }
}
