<?php

namespace SimpleCms\Blog\UI\Controller;

use Ramsey\Uuid\Uuid;
use SimpleCms\Blog\App\Command\CreatePostCommand;
use SimpleCms\Blog\App\Command\DeletePostCommand;
use SimpleCms\Blog\App\Command\UpdatePostCommand;
use SimpleCms\Blog\App\Query\FindPostQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 */
class PostController
{
    /**
     * @param Request             $request
     * @param MessageBusInterface $commandBus
     * @return JsonResponse
     * @throws \Exception
     *
     * @Route("/post.{_format}", methods="POST", requirements={"_format": "json"})
     */
    public function createAction(Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);
        $command = CreatePostCommand::fromData(Uuid::uuid4()->toString(), $payload);
        $commandBus->dispatch($command);

        return new JsonResponse(
            '',
            Response::HTTP_CREATED,
            ['X-RESOURCE-ID' => $command->getId()]
        );
    }

    /**
     * @param MessageBusInterface $queryBus
     * @param NormalizerInterface $normalizer
     * @param string              $id
     *
     * @return JsonResponse
     *
     * @throws ExceptionInterface
     *
     * @Route("/post/{id}.{_format}", methods="GET", requirements={"_format": "json"})
     */
    public function retrieveAction(
        MessageBusInterface $queryBus,
        NormalizerInterface $normalizer,
        string $id
    ): JsonResponse {
        $envelope = $queryBus->dispatch(FindPostQuery::withId($id));

        $post = $envelope->last(HandledStamp::class)->getResult();

        return new JsonResponse(
            $normalizer->normalize($post),
            Response::HTTP_OK
        );
    }

    /**
     * @param Request             $request
     * @param MessageBusInterface $commandBus
     * @param string              $id
     *
     * @return Response
     *
     * @Route("/post/{id}.{_format}", methods="PUT", requirements={"_format": "json"})
     */
    public function updateAction(Request $request, MessageBusInterface $commandBus, string $id): Response
    {
        $payload = json_decode($request->getContent(), true);
        $commandBus->dispatch(UpdatePostCommand::fromData($id, $payload));

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param MessageBusInterface $commandBus
     * @param string              $id
     *
     * @return Response
     *
     * @Route("/post/{id}.{_format}", methods="DELETE", requirements={"_format": "json"})
     */
    public function deleteAction(MessageBusInterface $commandBus, string $id): Response
    {
        $commandBus->dispatch(DeletePostCommand::withId($id));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
