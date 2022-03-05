<?php

namespace Pbmengine\Video;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Pbmengine\Video\Concerns\HandleGeneralMethods;
use Pbmengine\Video\Concerns\HandleImages;
use Pbmengine\Video\Concerns\HandleProjects;
use Pbmengine\Video\Concerns\HandleTemplates;
use Pbmengine\Video\Concerns\HandleVideos;
use Pbmengine\Video\Exceptions\NotFoundException;
use Pbmengine\Video\Exceptions\ServerException;
use Pbmengine\Video\Exceptions\ValidationException;
use Pbmengine\Video\Query\Builder;

class Video
{
    use HandleProjects,
        HandleTemplates,
        HandleVideos,
        HandleImages,
        HandleGeneralMethods;

    /** @var string */
    protected $basePath;

    protected int $timeout = 30;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $accessKey;

    /** @var string */
    protected $secretKey;

    /** @var array|null */
    protected $queryParams;

    /** @var string|null */
    protected $queryString;

    public function __construct($basePath, $apiKey, $accessKey, $secretKey)
    {
        $this->basePath = $basePath;
        $this->apiKey = $apiKey;
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    public function getClient(): PendingRequest
    {
        return app(Factory::class)->withHeaders($this->getAuthHeaders())
            ->timeout($this->timeout)
            ->withOptions(['http_errors' => false])
            ->baseUrl($this->basePath);
    }

    public function setSecretKey($key): self
    {
        $this->secretKey = $key;

        return $this;
    }

    public function setAccessKey($key): self
    {
        $this->accessKey = $key;

        return $this;
    }

    protected function getAuthHeaders(): array
    {
        return [
            'x-api-key'    => $this->apiKey,
            'x-access-key' => $this->accessKey,
            'x-secret-key' => $this->secretKey,
            'Accept' => 'application/json',
        ];
    }

    protected function transformCollection(array $collection, $class, $dto): array
    {
        return array_map(function ($data) use ($class, $dto) {
            return new $class($dto::fromApiResponse($data), $this);
        }, $collection);
    }

    protected function transformItem(array $item, $class, $dto)
    {
        return new $class($dto::fromApiResponse($item), $this);
    }

    protected function handleResponse(Response $response): Response
    {
        if ($response->successful()) {
            return $response;
        }

        $this->handleResponseError($response);
    }

    protected function handleResponseError(Response $response)
    {
        if ($response->status() == 404) {
            throw new NotFoundException($response->body());
        }

        if ($response->status() == 422) {
            throw new ValidationException($response->body());
        }

        if ($response->serverError()) {
            throw new ServerException($response->body());
        }

        throw new \Exception('error');
    }

    public function query(Builder $builder)
    {
        $this->queryString = $builder->toString();

        return $this;
    }

    protected function getQueryString()
    {
        if ($this->queryString == null) {
            return '';
        }

        return '?' . $this->queryString;
    }
}
