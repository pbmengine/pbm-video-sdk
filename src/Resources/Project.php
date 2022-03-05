<?php

namespace Pbmengine\Video\Resources;

use Pbmengine\Video\DTO\ProjectData;

class Project extends Resource
{
    /** @var ProjectData */
    protected $dto;

    public function update(array $data): Project
    {
        return $this->api->updateProject($this->data()->id, $data);
    }

    public function delete(): string
    {
        return $this->api->deleteProject($this->data()->id);
    }

    public function templates(): array
    {
        return $this->api->templates($this->data()->id);
    }

    public function videos(): array
    {
        return $this->api->videos($this->data()->id);
    }

    public function statistics(): array
    {
        return $this->api->projectStatistics($this->data()->id);
    }

    public function logs(): array
    {
        return $this->api->projectLogs($this->data()->id);
    }
}
