<?php

namespace SimpleCms\Blog\UI\RestNormalizer;

use SimpleCms\Blog\Domain\Post;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class PostNormalizer
 *
 * @uses NormalizerInterface
 */
class PostNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'title' => $object->getTitle(),
            'content' => $object->getContent(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Post;
    }
}
