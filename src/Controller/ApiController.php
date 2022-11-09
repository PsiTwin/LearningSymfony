<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{

    /**
     * @var integer HTTP status code - 200 (OK) by default
     */
    protected int $statusCode = 200;

    protected SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Gets the value of statusCode.
     *
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param integer $statusCode the status code
     *
     * @return self
     */
    protected function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Returns a JSON response
     *
     * @param mixed $data
     * @param array $headers
     * @return JsonResponse
     */
    public function response(mixed $data = null, array $headers = []): JsonResponse
    {
        if ($data == null) {
            $data = [];
        }
        return new JsonResponse($data, $this->getStatusCode(), $headers, true);
    }


    /**
     * Sets an error message and returns a JSON response
     *
     * @param string $errors
     * @param array $headers
     * @return JsonResponse
     */
    public function respondWithErrors(string $errors, array $headers = []): JsonResponse
    {
        return new JsonResponse($errors, $this->getStatusCode(), $headers, true);
    }

    /**
     * Returns a 401 Unauthorized http response
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondUnauthorized(string $message = 'Not authorized!'): JsonResponse
    {
        return $this->setStatusCode(401)->respondWithErrors($message);
    }

    /**
     * Returns a 422 Unprocessable Entity
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondValidationError(string $message = 'Validation errors'): JsonResponse
    {
        return $this->setStatusCode(422)->respondWithErrors($message);
    }

    /**
     * Returns a 404 Not Found
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondNotFound(string $message = 'Not found!'): JsonResponse
    {
        return $this->setStatusCode(404)->respondWithErrors($message);
    }

    /**
     * Returns a 200 Ok
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function respondOk(mixed $data = null): JsonResponse
    {
        return $this->response($data);
    }


    /**
     * Returns a 201 Created
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function respondCreated(mixed $data = null): JsonResponse
    {
        return $this->setStatusCode(201)->response($data);
    }

    /**
     * Returns a 204 Created
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function respondDeleted(mixed $data = null): JsonResponse
    {
        return $this->setStatusCode(204)->response($data);
    }


    protected function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

    /**
     * @param null $groups
     * @param array $data
     * @return string
     * @throws ExceptionInterface
     */
    public function serialize(mixed $data = [], $groups = null): string
    {
        if ($groups) {
            $data = $this->serializer->normalize($data, null, ['groups' => $groups]);
        }
        return $this->serializer->serialize($data, JsonEncoder::FORMAT);
    }
}