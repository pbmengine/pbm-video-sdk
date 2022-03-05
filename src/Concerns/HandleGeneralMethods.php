<?php

namespace Pbmengine\Video\Concerns;

trait HandleGeneralMethods
{
    public function destinations(): array
    {
        return $this->handleResponse($this->getClient()->get('destinations'))->json();
    }

    public function videoFormats(): array
    {
        return $this->handleResponse($this->getClient()->get('formats/videos'))->json();
    }

    public function imageFormats(): array
    {
        return $this->handleResponse($this->getClient()->get('formats/images'))->json();
    }

    public function iswProject(mixed $projectId): array
    {
        return $this->handleResponse($this->getClient()->get('isw/projects/' . $projectId))->json();
    }

    public function iswProjects(): array
    {
        return $this->handleResponse($this->getClient()->get('isw/projects'))->json();
    }

    public function status(): array
    {
        return $this->handleResponse($this->getClient()->get('status'))->json();
    }

    public function eventlogs(): array
    {
        return $this->handleResponse($this->getClient()->get('eventlogs'))->json();
    }
}
