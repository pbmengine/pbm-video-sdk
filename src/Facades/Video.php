<?php

namespace Pbmengine\Video\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pbmengine\Video\Video
 */
class Video extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Pbmengine\Video\Video::class;
    }
}
