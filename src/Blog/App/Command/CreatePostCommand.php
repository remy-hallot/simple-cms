<?php

namespace SimpleCms\Blog\App\Command;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CreatePostCommand
 */
class CreatePostCommand
{
    /** @var string */
    private $id;

    /** @var mixed[] */
    private $payload;

    /**
     * CreatePostCommand constructor.
     * @param string $id
     * @param array  $payload
     */
    private function __construct(string $id, array $payload)
    {
        $this->id = $id;
        $this->payload = $payload;
    }

    /**
     * @param string $id
     * @param array  $payload
     * @return CreatePostCommand
     */
    public static function fromData(string $id, array $payload): CreatePostCommand
    {
        return new static($id, $payload);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->payload['title'];
    }

    /**
     * @return string
     */
    public function getContent():string
    {
        return $this->payload['content'];
    }
}
