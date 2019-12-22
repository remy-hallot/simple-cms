<?php

namespace SimpleCms\Blog\App\Query;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class FindPostQuery
 */
class FindPostQuery
{
    /** @var string */
    private $id;

    /**
     * FindPostQuery constructor.
     * @param string $id
     */
    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return FindPostQuery
     */
    public static function withId(string $id): FindPostQuery
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
