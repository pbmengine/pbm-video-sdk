<?php

if (!function_exists('video')) {
    function video(): \Pbmengine\Video\Video {
        return app()->make(\Pbmengine\Video\Video::class);
    }
}
