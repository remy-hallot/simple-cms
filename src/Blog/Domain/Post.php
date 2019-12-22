<?php

namespace SimpleCms\Blog\Domain;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Post
 */
class Post
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * Post constructor.
     * @param UuidInterface $id
     * @param string        $title
     * @param string        $content
     */
    public function __construct(UuidInterface $id, string $title, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $title
     */
    public function rename(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $content
     */
    public function modifyContent(string $content): void
    {
        $this->content = $content;
    }
}
