<?php

namespace SimpleCms\Blog\App\CommandHandler;

use Doctrine\ORM\ORMException;
use SimpleCms\Blog\App\Command\DeletePostCommand;
use SimpleCms\Blog\Domain\Exception\PostNotFoundException;
use SimpleCms\Blog\Domain\Repository\PostReaderInterface;
use SimpleCms\Blog\Domain\Repository\PostWriterInterface;

/**
 * Class DeletePostCommandHandler
 */
class DeletePostCommandHandler
{
    /** @var PostReaderInterface */
    private $postReader;

    /** @var PostWriterInterface $postWriter */
    private $postWriter;

    /**
     * DeletePostCommandHandler constructor.
     * @param PostWriterInterface $postWriter
     * @param PostReaderInterface $postReader
     */
    public function __construct(PostWriterInterface $postWriter, PostReaderInterface $postReader)
    {
        $this->postWriter = $postWriter;
        $this->postReader = $postReader;
    }

    /**
     * @param DeletePostCommand $command
     * @throws PostNotFoundException
     * @throws ORMException
     */
    public function __invoke(DeletePostCommand $command): void
    {
        $id = $command->getId();
        $post = $this->postReader->findRequired($id);

        $this->postWriter->delete($post);
    }
}
