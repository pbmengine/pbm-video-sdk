<?php

namespace Pbmengine\Video\Resources;

use Pbmengine\Video\DTO\TemplateData;

class Template extends Resource
{
    /** @var TemplateData */
    protected $dto;

    public function update(array $data): Template
    {
        return $this->api->updateTemplate($this->data()->id, $this->data()->project_id, $data);
    }

    public function createVideo(string $name, array $data): Video
    {
        return $this->api->createVideo($this->data()->project_id, $this->data()->id, $name, $data);
    }

    public function delete(): string
    {
        return $this->api->deleteTemplate($this->data()->id, $this->data()->project_id);
    }
}
