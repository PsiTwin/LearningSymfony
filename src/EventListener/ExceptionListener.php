<?php

namespace App\EventListener;

use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ExceptionListener
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ExceptionEvent $event
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $data = ['message' => $exception->getMessage()];

        if ($exception instanceof ValidationException) {
            $violations = $exception->getViolations();
            $errors = ['message' => $exception->getMessage()];
            foreach ($violations as $violation) {
                $errors['errors'][] = ['property' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()];
            }
            $data = $errors;
        }

        $response = new JsonResponse();
        $response->setContent($this->serializer->serialize($data, JsonEncoder::FORMAT));
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $event->setResponse($response);
    }
}