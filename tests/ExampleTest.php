<?php

namespace Pbmengine\Video\Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function test_project()
    {
        $video = new \Pbmengine\Video\Video(
            //
            'https://video2.dev.pbm.sh/api/v1/videoservice/',
            '59d0cd6332d9a739e89153a188dcf0c4580553a1cbce29e3a87da2334cbc66ef6e22bb86952e2cb2838841738fe85bd0',
            '583fce51cd2bf99438667b9b341a7e61d70856b63dee13ac32da4f4ee80157b1dc7da61c193ecbbd35ed5755aba1e37a',
            'ae8b96a14dfaa86d4c879131645b0850471e9a5e3ed7857c64a922c2db2e8354ac459903af05dde97b806c90a07e21a6'
            //
        );

        $iswMovieProjectId = '12e2045f-6257-48c7-bdaa-3a975bf74598';
        $iswMovieName = 'intro_clip';
        $videoData = [
          'params' => [
                "hintergrund" => "hintergrund.jpg",
                "vorname" => "Fritz",
                "nachname" => "Fischer",
            ],
        ];

        $templateData = [
            'name' => 'super duper video',
            'movie_name' => $iswMovieName,
            'movie_project_id' => $iswMovieProjectId,
            'protection' => true // if protected the video is not publicly accessible
        ];

        $projectId = '2382eae743b7427a9332a60ba0fd1668';
        $templateId = '9b18a243a3454f0884ff387121170214';

        //$video = $video->createTemplate($projectId, $templateData);
        //$video = $video->createVideo($projectId, $templateId, 'video6', $videoData);
        $video = $video->video('08a166d0955349b7a4dc504b347d4383', $projectId);
        //$video = $video->updateTemplate($templateId, $projectId, ['routing_key' => 'default']);
        dd($video->data()->toArray());
        //dd($video->getClient()->get('projects/'.$projectId.'/videos/472897db34d34bb1b2beace6dbf2c3a2')->json());
        $this->assertTrue(true);
    }
}
