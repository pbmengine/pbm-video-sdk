# PHP SDK Rest Client for PBM Video API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmengine/pbm-video-sdk.svg?style=flat-square)](https://packagist.org/packages/pbmengine/pbm-video-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmengine/pbm-video-sdk.svg?style=flat-square)](https://packagist.org/packages/pbmengine/pbm-video-sdk)

The PHP SDK provides a convenient way to use the PBM video api. 

## Installation

You can install the package via composer:

```bash
composer require pbmengine/pbm-video-sdk
```

## Usage

### Prerequisites
You need an Api Key to use this package!

### Create a project
You must create a project to use the api. Actually you'll need only 1 project pr application.
So store the project_id somewhere in your config files.

```php
$project = video()->createProject(<project name>, <identifier optional>, <description optional);
// your project id
$project->data()->id
// your project access key
$project->data()->access_key
// your project secret key
$project->data()->secret_key
// store these values in config/pbm-video.php
```

### Create a template
A template is a blueprint for each dynamic movie! So if you have several videos in your application, you'll need 
several templates.

```php
// the data to create a template must contain
// please see api documentation for more properties
// movie name and movie project id must be known from isw
$data = [
    'name' => 'super duper video',
    'movie_name' => 'the well known movie name',
    'movie_project_id' => 'the well known movie project id',
    'protection' => true|false // if protected the video is not publicly accessible
];

$template = video()->createTemplate(<your project id>, array $data);
```

### Check needed params for video
```php
$movie = video()->iswProject(<movie project id>);
// response is something like this
// important here is the variables -> collection field -> name
[
  "data" => array:4 [
    "id" => "12e2045f-6257-48c7-bdaa-3a975bf74598"
    "created_at" => "2019-11-21T12:42:01+00:00"
    "name" => "video_test_api"
    "dynamic_movies" => array:1 [
      0 => array:9 [
        "seconds" => 10
        "variable_length" => false
        "width" => 1920
        "height" => 1080
        "codec" => "H264/AAC"
        "created_at" => "2019-11-21T12:51:03+00:00"
        "updated_at" => "2020-02-04T16:08:15+00:00"
        "name" => "intro_clip"
        "variables" => array:1 [
          "collection" => array:3 [
            0 => array:4 [
              "num_frames" => 250
              "default_value" => "hintergrund.jpg"
              "name" => "hintergrund"
              "type" => "image"
            ]
            1 => array:4 [
              "num_frames" => 250
              "default_value" => "Mustervorname"
              "name" => "vorname"
              "type" => "text"
            ]
            2 => array:4 [
              "num_frames" => 250
              "default_value" => "Musternachname"
              "name" => "nachname"
              "type" => "text"
            ]
          ]
        ]
      ]
    ]
  ]
]
```
### Create video
// you will need the above mentioned params
````php
// data should be
$data = [
    'params' => [
        'key1' => 'value',
        'key2' => 'value',
        'key3' => 'value',
    ]
];
$video = video()->createVideo(<projectId>, <templateId>, <name>, <data>)
````

### Status of Video
````php
$status = video()->videoStatus(<video id>, <project id>);
````

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email systems@personal-business-machine.com instead of using the 
issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
