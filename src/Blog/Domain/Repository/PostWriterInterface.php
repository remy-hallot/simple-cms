<?php

namespace SimpleCms\Blog\Domain\Repository;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use SimpleCms\Blog\Domain\Post;

/**
 * Interface PostWriterInterface
 */
interface PostWriterInterface
{
    /**
     * @param Post $post
     *
     * @throws ORMException
     *
     * @return void
     */
    public function save(Post $post): void;

    /**
     * @param Post $post
     *
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     *
     * @return void
     */
    public function delete(Post $post): void;
}
