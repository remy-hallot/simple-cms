<?php

namespace SimpleCms\Blog\App\CommandHandler;

use Doctrine\ORM\ORMException;
use SimpleCms\Blog\App\Command\CreatePostCommand;
use SimpleCms\Blog\Domain\Post;
use SimpleCms\Blog\Domain\Repository\PostWriterInterface;

/**
 * Class CreatePostCommandHandler
 */
class CreatePostCommandHandler
{
    /** @var PostWriterInterface $postWriter */
    private $postWriter;

    /**
     * CreatePostCommandHandler constructor.
     * @param PostWriterInterface $postWriter
     */
    public function __construct(PostWriterInterface $postWriter)
    {
        $this->postWriter = $postWriter;
    }

    /**
     * @param CreatePostCommand $command
     * @throws ORMException
     */
    public function __invoke(CreatePostCommand $command): void
    {
        $id = $command->getId();
        $title = $command->getTitle();
        $content = $command->getContent();

        $post = new Post($id, $title, $content);

        $this->postWriter->save($post);
    }
}
