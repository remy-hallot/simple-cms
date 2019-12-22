<?php

namespace SimpleCms\Blog\Infra\Repository\DoctrineORM;

use Doctrine\ORM\EntityManagerInterface;
use SimpleCms\Blog\Domain\Post;
use SimpleCms\Blog\Domain\Repository\PostWriterInterface;

/**
 * Class PostWriter
 *
 * @uses PostWriterInterface
 */
class PostWriter implements PostWriterInterface
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

    public function save(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function delete(Post $post): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}
