<?php

namespace Pbmengine\Video\Resources;

use Pbmengine\Video\DTO\ImageData;

class Image extends Resource
{
    /** @var ImageData */
    protected $dto;

    public function delete(): string
    {
        return $this->api->deleteImage($this->data()->id, $this->data()->projectId);
    }

    public function template(): Template
    {
        return $this->api->template($this->data()->template_id, $this->data()->project_id);
    }
}
