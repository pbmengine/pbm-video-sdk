<?php

namespace Pbmengine\Video\Resources;

use Pbmengine\Video\Video;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Resource
{
    /** @var DataTransferObject */
    protected $dto;

    /** @var Video */
    protected $api;

    public function __construct(DataTransferObject $dto, Video $api)
    {
        $this->dto = $dto;
        $this->api = $api;
    }

    public function data(): DataTransferObject
    {
        return $this->dto;
    }
}
