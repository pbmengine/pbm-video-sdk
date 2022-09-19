<?php

namespace Pbmengine\Video\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pbmengine\Video\VideoServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('pbm-video-api', [
            'basePath' => 'https://video2.dev.pbm.sh/api/v1/videoservice/',
            'apiKey' => '',
            'accessKey' => '',
            'secretKey' => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [VideoServiceProvider::class];
    }
}
