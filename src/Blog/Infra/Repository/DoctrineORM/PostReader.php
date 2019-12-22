<?php

namespace SimpleCms\Blog\Infra\Repository\DoctrineORM;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use SimpleCms\Blog\Domain\Exception\PostNotFoundException;
use SimpleCms\Blog\Domain\Post;
use SimpleCms\Blog\Domain\Repository\PostReaderInterface;

/**
 * Class PostReader
 *
 * @uses PostReaderInterface
 */
class PostReader implements PostReaderInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findRequired(UuidInterface $id): Post
    {
        $resource = $this->entityManager->getRepository(Post::class)->find($id);

        if (null === $resource) {
            throw new PostNotFoundException(sprintf('Post with identifier "%s" does not exist.', $id));
        }

        return $resource;
    }
}
