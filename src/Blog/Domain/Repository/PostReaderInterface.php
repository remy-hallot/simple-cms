<?php

namespace SimpleCms\Blog\Domain\Repository;

use Ramsey\Uuid\UuidInterface;
use SimpleCms\Blog\Domain\Exception\PostNotFoundException;
use SimpleCms\Blog\Domain\Post;

/**
 * Interface PostReaderInterface
 */
interface PostReaderInterface
{
    /**
     * @param UuidInterface $id
     *
     * @throws PostNotFoundException
     *
     * @return Post
     */
    public function findRequired(UuidInterface $id): Post;
}
