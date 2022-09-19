<?php

namespace Pbmengine\Video\Concerns;

use Pbmengine\Video\DTO\ImageData;
use Pbmengine\Video\DTO\ImageStatusData;
use Pbmengine\Video\DTO\VideoData;
use Pbmengine\Video\Resources\Image;
use Pbmengine\Video\Resources\ImageStatus;
use Pbmengine\Video\Resources\Video;

trait HandleImages
{
    public function images($projectId): array
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/images" . $this->getQueryString())
        );

        return $this->transformCollection(
            $response->json()['data'],
            Image::class,
            ImageData::class
        );
    }

    public function createImage($projectId, $templateId, string $name, array $data): Image
    {
        $data['template_id'] = $templateId;
        $data['name'] = $name;

        $response = $this->handleResponse(
            $this->getClient()->post('projects/' . $projectId . '/images', $data)
        );

        return $this->transformItem(
            $response->json()['data'],
            Image::class,
            ImageData::class);
    }

    public function image($id, $projectId): Image
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/images/{$id}")
        );

        return $this->transformItem(
            $response->json()['data'],
            Image::class,
            ImageData::class);
    }

    public function imageStatus($id, string $projectId): ImageStatus
    {
        $response = $this->handleResponse(
            $this->getClient()->get("projects/{$projectId}/images/{$id}/status")
        );

        return $this->transformItem(
            $response->json()['data'],
            ImageStatus::class,
            ImageStatusData::class);
    }

    public function deleteImage($id, $projectId): string
    {
        $this->handleResponse(
            $this->getClient()->delete("projects/{$projectId}/images/{$id}")
        );

        return $id;
    }
}
