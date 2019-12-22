<?php

namespace SimpleCms\Blog\App\CommandHandler;

use Doctrine\ORM\ORMException;
use SimpleCms\Blog\App\Command\UpdatePostCommand;
use SimpleCms\Blog\Domain\Exception\PostNotFoundException;
use SimpleCms\Blog\Domain\Repository\PostReaderInterface;
use SimpleCms\Blog\Domain\Repository\PostWriterInterface;

/**
 * Class UpdatePostCommandHandler
 */
class UpdatePostCommandHandler
{
    /** @var PostReaderInterface $postReader */
    private $postReader;

    /** @var PostWriterInterface $postWriter */
    private $postWriter;

    /**
     * UpdatePostCommandHandler constructor.
     * @param PostReaderInterface $postReader
     * @param PostWriterInterface $postWriter
     */
    public function __construct(PostReaderInterface $postReader, PostWriterInterface $postWriter)
    {
        $this->postWriter = $postWriter;
        $this->postReader = $postReader;
    }

    /**
     * @param UpdatePostCommand $command
     * @throws ORMException
     * @throws PostNotFoundException
     */
    public function __invoke(UpdatePostCommand $command): void
    {
        $id = $command->getId();
        $title = $command->getTitle();
        $content = $command->getContent();

        $post = $this->postReader->findRequired($id);

        $post->rename($title);
        $post->modifyContent($content);

        $this->postWriter->save($post);
    }
}
