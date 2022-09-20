<?php

namespace Pbmengine\Video\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ImageData extends DataTransferObject
{
    /** @var string */
    public $id;

    /** @var string */
    public $project_id;

    /** @var string */
    public $template_id;

    /** @var string */
    public $status;

    /** @var string */
    public $status_message;

    /** @var string */
    public $url;

    /** @var string */
    public $download_url;

    /** @var bool */
    public $is_public;

    /** @var int */
    public $filesize;

    /** @var string */
    public $content_type;

    /** @var string */
    public $format;

    /** @var string */
    public $destination;

    /** @var int */
    public $width;

    /** @var int */
    public $height;

    /** @var int */
    public $render_time;

    /** @var string|null */
    public $render_token;

    /** @var string */
    public $aspect_ratio;

    /** @var string */
    public $storage_key;

    /** @var string */
    public $created_by;

    /** @var Carbon|null */
    public $created_at;

    /** @var Carbon|null */
    public $updated_at;

    public static function fromApiResponse(array $response)
    {
        return new self($response);
    }

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {

            if ($key == 'created_at') {
                $value = Carbon::createFromTimestamp(strtotime($value));
            }

            if ($key == 'deletion_at' && $value !== null) {
                $value = Carbon::createFromTimestamp(strtotime($value));
            }

            if ($key == 'updated_at' && $value !== null) {
                $value = Carbon::createFromTimestamp(strtotime($value));
            }

            $this->{$key} = $value;
        }
    }
}
