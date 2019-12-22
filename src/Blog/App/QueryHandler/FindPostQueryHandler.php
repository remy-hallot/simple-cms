<?php

namespace SimpleCms\Blog\App\QueryHandler;

use SimpleCms\Blog\App\Query\FindPostQuery;
use SimpleCms\Blog\Domain\Exception\PostNotFoundException;
use SimpleCms\Blog\Domain\Post;
use SimpleCms\Blog\Domain\Repository\PostReaderInterface;

/**
 * Class FindPostQueryHandler
 */
class FindPostQueryHandler
{
    /** @var PostReaderInterface $postReader */
    private $postReader;

    /**
     * FindPostQueryHandler constructor.
     * @param PostReaderInterface $postReader
     */
    public function __construct(PostReaderInterface $postReader)
    {
        $this->postReader = $postReader;
    }

    /**
     * @param FindPostQuery $query
     * @return Post
     * @throws PostNotFoundException
     */
    public function __invoke(FindPostQuery $query): Post
    {
        return $this->postReader->findRequired($query->getId());
    }
}
