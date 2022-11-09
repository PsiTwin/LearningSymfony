<?php

namespace App\Service\Author;

use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class AuthorSearch
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;

    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param AuthorSearch $authorSearch
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAuthorsList(AuthorSearch $authorSearch, SerializerInterface $serializer): JsonResponse
    {
        $models = $this->authorRepository->findAll();
        $data = $serializer->serialize(
            $models, JsonEncoder::FORMAT, [AbstractNormalizer::IGNORED_ATTRIBUTES => ['isBanned']]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}