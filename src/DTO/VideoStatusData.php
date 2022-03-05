<?php

namespace Pbmengine\Video\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class VideoStatusData extends DataTransferObject
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

    /** @var Carbon */
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

            $this->{$key} = $value;
        }
    }
}
