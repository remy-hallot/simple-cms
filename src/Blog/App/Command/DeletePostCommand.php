<?php

namespace SimpleCms\Blog\App\Command;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class DeletePostCommand
 */
class DeletePostCommand
{
    /** @var string */
    private $id;

    /**
     * DeletePostCommand constructor.
     * @param string $id
     */
    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return DeletePostCommand
     */
    public static function withId(string $id): DeletePostCommand
    {
        return new static($id);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }
}
