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
            'apiKey' => '59d0cd6332d9a739e89153a188dcf0c4580553a1cbce29e3a87da2334cbc66ef6e22bb86952e2cb2838841738fe85bd0',
            'accessKey' => 'c0cffd90a80d566da45fcb8be8d11909b88bce5168031e3a76ffeb512aad2c1d156311bef5e84e029be6780a51492db7',
            'secretKey' => 'f12393272a2a520c4b5d7e92f381ab03f231d6671908f66ee43fd733d21b1c615407152a1924cedb4effe1c6f65de019',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [VideoServiceProvider::class];
    }
}
