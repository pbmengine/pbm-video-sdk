<?php

namespace Pbmengine\Video\Resources;

use Pbmengine\Video\DTO\VideoData;

class Video extends Resource
{
    /** @var VideoData */
    protected $dto;

    public function delete(): string
    {
        return $this->api->deleteVideo($this->data()->id, $this->data()->project_id);
    }

    public function template(): Template
    {
        return $this->api->template($this->data()->template_id, $this->data()->project_id);
    }
}
